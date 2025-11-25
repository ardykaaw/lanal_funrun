<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'registration_number',
        'barcode',
        'category',
        'first_name',
        'last_name',
        'email',
        'bib_name',
        'phone',
        'birth_date',
        'gender',
        'occupation',
        'id_type',
        'id_number',
        'address',
        'city',
        'province',
        'jersey_size',
        'blood_type',
        'emergency_name',
        'emergency_phone',
        'community',
        'medical_notes',
        'payment_proof_path',
        'payment_status',
        'status',
        'admin_notes',
        'approved_at',
        'rejected_at',
        'race_pack_picked_up',
        'race_pack_picked_up_at',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'race_pack_picked_up' => 'boolean',
        'race_pack_picked_up_at' => 'datetime',
    ];

    /**
     * Generate unique registration number
     * Format: DNL5001, DNL5002, etc.
     */
    public static function generateRegistrationNumber(): string
    {
        // Get the highest existing registration number with new format (DNL5xxx)
        $lastRegistration = self::where('registration_number', 'like', 'DNL5%')
            ->whereRaw('LENGTH(registration_number) >= 7') // At least DNL5001 (7 chars)
            ->orderByRaw('CAST(SUBSTRING(registration_number, 4) AS UNSIGNED) DESC')
            ->first();
        
        if ($lastRegistration && preg_match('/^DNL5(\d+)$/', $lastRegistration->registration_number, $matches)) {
            $lastNumber = (int) $matches[1];
            // Ensure we start from at least 5001
            $nextNumber = max(5001, $lastNumber + 1);
        } else {
            // No existing new format, start from 5001
            $nextNumber = 5001;
        }
        
        $number = 'DNL' . $nextNumber;
        
        // Double check to ensure uniqueness
        while (self::where('registration_number', $number)->exists()) {
            $nextNumber++;
            $number = 'DNL' . $nextNumber;
        }
        
        return $number;
    }

    /**
     * Get full name
     */
    public function getFullNameAttribute(): string
    {
        $first = trim((string) $this->first_name);
        $last = trim((string) $this->last_name);
        $full = trim(trim($first . ' ' . $last));

        if ($full === '') {
            $full = trim((string) $this->bib_name);
        }

        return $full !== '' ? $full : 'Peserta';
    }
}
