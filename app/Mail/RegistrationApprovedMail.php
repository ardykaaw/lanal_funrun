<?php

namespace App\Mail;

use App\Models\Registration;
use App\Services\BarcodeService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class RegistrationApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Registration $registration;
    public string $qrCodePath;
    public bool $hasQrCode;

    /**
     * Create a new message instance.
     */
    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
        $this->hasQrCode = false;
        $this->qrCodePath = '';
        
        // Generate QR Code and save to storage for email attachment
        if ($registration->registration_number) {
            try {
                $barcodeService = new BarcodeService();
                
                // Generate QR Code and save to storage
                $this->qrCodePath = $barcodeService->generateBarcode($registration->registration_number);
                
                if (!empty($this->qrCodePath)) {
                    $this->hasQrCode = true;
                } else {
                    \Log::warning('QR Code path is empty for registration', [
                        'registration_id' => $registration->id,
                        'registration_number' => $registration->registration_number
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('Failed to generate QR Code in email: ' . $e->getMessage(), [
                    'registration_id' => $registration->id,
                    'registration_number' => $registration->registration_number
                ]);
            }
        }
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this
            ->subject('Konfirmasi Pendaftaran - DANLANAL KENDARI RUN 2025')
            ->view('emails.registration_approved');
    }
    
    /**
     * Get QR Code content for embedding
     */
    public function getQrCodeContent(): ?string
    {
        if ($this->hasQrCode && !empty($this->qrCodePath)) {
            $qrCodeFullPath = Storage::disk('public')->path($this->qrCodePath);
            
            if (file_exists($qrCodeFullPath)) {
                return file_get_contents($qrCodeFullPath);
            }
        }
        
        return null;
    }
}


