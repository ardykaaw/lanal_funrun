<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        // Check if registration is open
        if (!Settings::isRegistrationOpen()) {
            return redirect()->route('archive.register')
                ->withErrors(['registration_closed' => 'Pendaftaran saat ini sudah ditutup.']);
        }

        $validator = Validator::make($request->all(), [
            'category' => 'required|string',
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bibName' => 'required|string|max:16',
            'phone' => 'required|string|max:20',
            'birthPlace' => 'nullable|string|max:255',
            'birthDate' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'occupation' => 'required|string|max:255',
            'idType' => 'required|string',
            'idNumber' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'jerseySize' => 'required|in:XS,S,M,L,XL,XXL',
            'bloodType' => 'required|string',
            'emergencyName' => 'required|string|max:255',
            'emergencyPhone' => 'required|string|max:20',
            'community' => 'nullable|string|max:255',
            'medicalNotes' => 'nullable|string',
            'province' => 'required|string|max:255',
            'paymentProof' => 'required|file|mimes:jpeg,jpg,png,pdf|max:10240', // 10MB
            'consent' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle file upload
        $paymentProofPath = null;
        if ($request->hasFile('paymentProof')) {
            $file = $request->file('paymentProof');
            $paymentProofPath = $file->store('payment-proofs', 'public');
        }

        // Store additional info in admin_notes as JSON
        $additionalInfo = [];
        if ($request->has('birthPlace') && $request->birthPlace) {
            $additionalInfo['birth_place'] = $request->birthPlace;
        }
        $adminNotes = !empty($additionalInfo) ? json_encode($additionalInfo) : null;

        // Split full name into first and last name segments
        [$firstName, $lastName] = $this->splitFullName($request->fullName);

        // Create registration
        $registration = Registration::create([
            'category' => $request->category,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $request->email,
            'bib_name' => $request->bibName,
            'phone' => $request->phone,
            'birth_date' => $request->birthDate,
            'gender' => $request->gender,
            'occupation' => $request->occupation,
            'id_type' => $request->idType,
            'id_number' => $request->idNumber,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'jersey_size' => $request->jerseySize,
            'blood_type' => $request->bloodType,
            'emergency_name' => $request->emergencyName,
            'emergency_phone' => $request->emergencyPhone,
            'community' => $request->community,
            'medical_notes' => $request->medicalNotes,
            'payment_proof_path' => $paymentProofPath,
            'admin_notes' => $adminNotes,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        return redirect()->route('registration.success', ['id' => $registration->id]);
    }

    /**
     * Split a full name into first and last name parts.
     */
    private function splitFullName(string $fullName): array
    {
        $fullName = trim(preg_replace('/\s+/', ' ', $fullName));
        if ($fullName === '') {
            return ['Peserta', 'Run'];
        }

        $parts = explode(' ', $fullName);
        $firstName = array_shift($parts);
        $lastName = !empty($parts) ? implode(' ', $parts) : $firstName;

        return [$firstName, $lastName];
    }

    public function success($id)
    {
        $registration = Registration::findOrFail($id);
        return view('archive.registration-success', compact('registration'));
    }

    public function check(Request $request)
    {
        $registration = null;
        
        if ($request->has('registration_number')) {
            $registration = Registration::where('registration_number', $request->registration_number)
                ->first();
        }

        return view('archive.check-registration', compact('registration'));
    }

    public function show($registrationNumber)
    {
        $registration = Registration::where('registration_number', $registrationNumber)
            ->firstOrFail();
        
        return view('archive.registration-detail', compact('registration'));
    }
}
