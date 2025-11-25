<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class BarcodeScanController extends Controller
{
    /**
     * Show the barcode scanner page
     */
    public function index()
    {
        // Get list of participants who have picked up race pack
        $pickedUpRegistrations = Registration::where('race_pack_picked_up', true)
            ->orderBy('race_pack_picked_up_at', 'desc')
            ->limit(50) // Show last 50 pickups
            ->get()
            ->map(function ($reg) {
                return [
                    'id' => $reg->id,
                    'registration_number' => $reg->registration_number,
                    'full_name' => $reg->full_name,
                    'category' => $reg->category,
                    'picked_up_at' => $reg->race_pack_picked_up_at?->setTimezone('Asia/Makassar')->format('d F Y H:i') . ' WITA',
                ];
            });

        return view('admin.barcode-scan.index', compact('pickedUpRegistrations'));
    }

    /**
     * Lookup registration by barcode/registration number
     */
    public function lookup(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code = trim($request->input('code'));

        // Find by registration number (barcode contains registration number)
        $registration = Registration::where('registration_number', $code)
            ->orWhere('barcode', 'like', "%{$code}%")
            ->first();

        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'Pendaftaran tidak ditemukan dengan kode tersebut.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'registration' => [
                'id' => $registration->id,
                'registration_number' => $registration->registration_number,
                'full_name' => $registration->full_name,
                'email' => $registration->email,
                'phone' => $registration->phone,
                'category' => $registration->category,
                'bib_name' => $registration->bib_name,
                'jersey_size' => $registration->jersey_size,
                'status' => $registration->status,
                'race_pack_picked_up' => $registration->race_pack_picked_up,
                'race_pack_picked_up_at' => $registration->race_pack_picked_up_at?->setTimezone('Asia/Makassar')->format('d F Y H:i') . ' WITA',
            ],
        ]);
    }

    /**
     * Confirm race pack pickup
     */
    public function confirmPickup(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        if ($registration->race_pack_picked_up) {
            return response()->json([
                'success' => false,
                'message' => 'Race pack sudah diambil sebelumnya pada ' . $registration->race_pack_picked_up_at?->setTimezone('Asia/Makassar')->format('d F Y H:i') . ' WITA',
            ], 400);
        }

        $registration->update([
            'race_pack_picked_up' => true,
            'race_pack_picked_up_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Race pack berhasil dikonfirmasi telah diambil.',
            'registration' => [
                'id' => $registration->id,
                'race_pack_picked_up' => true,
                'race_pack_picked_up_at' => $registration->race_pack_picked_up_at->setTimezone('Asia/Makassar')->format('d F Y H:i') . ' WITA',
            ],
        ]);
    }
}
