<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Services\WhatsAppService;
use App\Services\BarcodeService;
use App\Exports\RegistrationsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationApprovedMail;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\File;

class RegistrationController extends Controller
{
    private const PER_PAGE_OPTIONS = [10, 20, 50, 100];

    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 20);
        if (!in_array($perPage, self::PER_PAGE_OPTIONS, true)) {
            $perPage = 20;
        }

        $registrationsQuery = Registration::query();

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $registrationsQuery->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('registration_number', 'like', "%{$search}%")
                    ->orWhere('bib_name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $registrations = $registrationsQuery
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.registrations.index', [
            'registrations' => $registrations,
            'perPageOptions' => self::PER_PAGE_OPTIONS,
            'currentPerPage' => $perPage,
            'searchKeyword' => $request->input('search', ''),
        ]);
    }

    public function show($id)
    {
        $registration = Registration::findOrFail($id);
        return view('admin.registrations.show', compact('registration'));
    }

    public function approve(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);
        
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        // Generate registration number if not exists or if it's old format
        // New format: DNL5001, DNL5002, etc. (DNL5 followed by 3+ digits)
        if (!$registration->registration_number || 
            !preg_match('/^DNL5\d{3,}$/', $registration->registration_number)) {
            // Check if it's old format (DNL2025xxxxx) or doesn't exist
            $registration->registration_number = Registration::generateRegistrationNumber();
        }

        // Generate barcode if not exists
        if (!$registration->barcode) {
            $barcodeService = new BarcodeService();
            $barcodePath = $barcodeService->generateBarcode($registration->registration_number);
            $registration->barcode = $barcodePath;
        }

        $registration->update([
            'status' => 'approved',
            'payment_status' => 'verified',
            'admin_notes' => $request->admin_notes,
            'approved_at' => now(),
            'rejected_at' => null,
            'barcode' => $registration->barcode,
        ]);

        // Send Email notification (automatic)
        try {
            if (!empty($registration->email)) {
                Mail::to($registration->email)->send(new RegistrationApprovedMail($registration));
            }
        } catch (\Throwable $e) {
            Log::error('Failed to send approval email', [
                'registration_id' => $registration->id,
                'error' => $e->getMessage(),
            ]);
        }

        $successMessage = 'Pendaftaran berhasil disetujui. Email konfirmasi telah dikirim.';

        return redirect()->route('admin.registrations.index')
            ->with('success', $successMessage)
            ->with('whatsapp_url', null)
            ->with('whatsapp_sent', false);
    }

    public function reject(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);
        
        $request->validate([
            'admin_notes' => 'required|string|max:1000',
        ]);

        $registration->update([
            'status' => 'rejected',
            'payment_status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'rejected_at' => now(),
            'approved_at' => null,
        ]);

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Pendaftaran telah ditolak.');
    }

    public function export(Request $request)
    {
        $registrationsQuery = Registration::query();

        // Apply same filters as index
        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));
            $registrationsQuery->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('registration_number', 'like', "%{$search}%")
                    ->orWhere('bib_name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $registrations = $registrationsQuery->orderByDesc('created_at')->get();

        $export = new RegistrationsExport($registrations);
        $spreadsheet = $export->export();

        $eventSlug = 'danlanal_kendari_run_2025';
        $filename = 'Data_Peserta_' . $eventSlug . '_' . date('Y-m-d_His') . '.xlsx';

        return new StreamedResponse(function() use ($spreadsheet, $filename) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    private function sendWhatsAppNotification(Registration $registration): array
    {
        $whatsappService = new WhatsAppService();

        $eventName = 'DANLANAL KENDARI RUN 2025';

        $message = "Halo {$registration->first_name},\n\n";
        $message .= "Pendaftaran Anda untuk *{$eventName}* telah dikonfirmasi!\n\n";
        $message .= "📋 *Nomor Pendaftaran:* {$registration->registration_number}\n";
        $message .= "👤 *Nama:* {$registration->full_name}\n";
        $message .= "🏃 *Kategori:* {$registration->category}\n";
        $message .= "📅 *Tanggal Event:* 21 Desember 2025\n\n";
        $message .= "Silahkan cek detail lengkap pendaftaran Anda di:\n";
        $message .= url('/registration/check') . "?registration_number={$registration->registration_number}\n\n";
        $message .= "Terima kasih dan selamat berlari! 🏃‍♂️🏃‍♀️";

        // Send message via WhatsApp service
        return $whatsappService->sendMessage($registration->phone, $message);
    }

    public function paymentProof(Registration $registration)
    {
        abort_if(! $registration->payment_proof_path, 404);

        $path = storage_path('app/public/' . $registration->payment_proof_path);
        if (! File::exists($path)) {
            abort(404);
        }

        $mimeType = File::mimeType($path) ?: 'application/octet-stream';

        return response()->file($path, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
