<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BarcodeService
{
    /**
     * Generate QR Code image and save to storage
     * Returns the storage path
     */
    public function generateBarcode(string $data, string $filename = null): string
    {
        // Generate filename if not provided
        if (!$filename) {
            $filename = 'barcodes/' . $data . '_' . time() . '.png';
        } else {
            $filename = 'barcodes/' . $filename;
        }
        
        // Generate QR Code as PNG
        $qrCodeImage = QrCode::format('png')
            ->size(300)
            ->margin(2)
            ->errorCorrection('H')
            ->generate($data);
        
        // Save to storage
        Storage::disk('public')->put($filename, $qrCodeImage);
        
        return $filename;
    }

    /**
     * Generate QR Code as base64 for inline use (email, etc)
     */
    public function generateBarcodeBase64(string $data): string
    {
        try {
            if (empty($data)) {
                Log::warning('Empty data provided for QR Code generation');
                return '';
            }
            
            $qrCodeImage = QrCode::format('png')
                ->size(300)
                ->margin(2)
                ->errorCorrection('H')
                ->generate($data);
            
            if (empty($qrCodeImage)) {
                Log::error('QR Code generation returned empty result', ['data' => $data]);
                return '';
            }
            
            $base64 = base64_encode($qrCodeImage);
            if (empty($base64)) {
                Log::error('Base64 encoding failed', ['data' => $data]);
                return '';
            }
            
            return 'data:image/png;base64,' . $base64;
        } catch (\Exception $e) {
            Log::error('QR Code generation failed: ' . $e->getMessage(), [
                'data' => $data,
                'trace' => $e->getTraceAsString()
            ]);
            return '';
        }
    }

    /**
     * Static method for use in Blade templates
     */
    public static function generateBarcodeBase64Static(string $data): string
    {
        try {
            $service = new self();
            $result = $service->generateBarcodeBase64($data);
            
            // If empty, try to generate again with error handling
            if (empty($result)) {
                Log::warning('QR Code generation returned empty, retrying...', ['data' => $data]);
                // Try with smaller size
                $qrCodeImage = QrCode::format('png')
                    ->size(250)
                    ->margin(1)
                    ->errorCorrection('M')
                    ->generate($data);
                
                if (!empty($qrCodeImage)) {
                    $result = 'data:image/png;base64,' . base64_encode($qrCodeImage);
                }
            }
            
            return $result;
        } catch (\Exception $e) {
            Log::error('QR Code static generation failed: ' . $e->getMessage(), ['data' => $data]);
            return '';
        }
    }

    /**
     * Get barcode URL for display
     */
    public function getBarcodeUrl(string $storagePath): string
    {
        return Storage::disk('public')->url($storagePath);
    }
}
