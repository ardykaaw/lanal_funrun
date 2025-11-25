<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Exports\ParticipantsExport;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ParticipantController extends Controller
{
    private const PER_PAGE_OPTIONS = [10, 20, 50, 100];

    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 20);
        if (!in_array($perPage, self::PER_PAGE_OPTIONS, true)) {
            $perPage = 20;
        }

        $participantsQuery = Registration::where('status', 'approved');

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));

            $participantsQuery->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('registration_number', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $participants = $participantsQuery
            ->orderByDesc('approved_at')
            ->paginate($perPage)
            ->withQueryString();
        
        return view('admin.participants.index', [
            'participants' => $participants,
            'perPageOptions' => self::PER_PAGE_OPTIONS,
            'currentPerPage' => $perPage,
            'searchKeyword' => $request->input('search', ''),
        ]);
    }

    public function show($id)
    {
        $participant = Registration::where('status', 'approved')
            ->findOrFail($id);
        
        return view('admin.participants.show', compact('participant'));
    }

    public function export(Request $request)
    {
        $participantsQuery = Registration::where('status', 'approved');

        // Apply same filters as index
        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));
            $participantsQuery->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('registration_number', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $participants = $participantsQuery->orderByDesc('approved_at')->get();

        $export = new ParticipantsExport($participants);
        $spreadsheet = $export->export();

        $eventSlug = 'danlanal_kendari_run_2025';
        $filename = 'Peserta_Terkonfirmasi_' . $eventSlug . '_' . date('Y-m-d_His') . '.xlsx';

        return new StreamedResponse(function() use ($spreadsheet, $filename) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }
}

