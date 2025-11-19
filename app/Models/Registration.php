<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'registration_number',
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
    ];

    protected $casts = [
        'birth_date' => 'date',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    /**
     * Generate unique registration number
     */
    public static function generateRegistrationNumber(): string
    {
        do {
            $number = 'FR' . date('Y') . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        } while (self::where('registration_number', $number)->exists());
        
        return $number;
    }

    /**
     * Get full name
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
