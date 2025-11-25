<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Registration;
use App\Services\BarcodeService;

class UpdateRegistrationNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registrations:update-numbers {--force : Force update even if registration number exists}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update registration numbers to new format (DNL5001, DNL5002, etc.)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $force = $this->option('force');
        
        // Get all registrations that need updating
        // Either no registration number, or old format (DNL2025xxxxx)
        $query = Registration::query();
        
        if (!$force) {
            $query->where(function($q) {
                $q->whereNull('registration_number')
                  ->orWhere('registration_number', 'like', 'DNL2025%')
                  ->orWhere('registration_number', 'like', 'DNL2024%')
                  ->orWhere('registration_number', 'not like', 'DNL5%');
            });
        }
        
        $registrations = $query->orderBy('created_at')->get();
        
        if ($registrations->isEmpty()) {
            $this->info('No registrations need updating.');
            return 0;
        }
        
        $this->info("Found {$registrations->count()} registrations to update.");
        
        if (!$this->confirm('Do you want to proceed with updating registration numbers?')) {
            $this->info('Update cancelled.');
            return 0;
        }
        
        $this->info('Updating registration numbers...');
        
        $bar = $this->output->createProgressBar($registrations->count());
        $bar->start();
        
        $successCount = 0;
        $errorCount = 0;
        $barcodeService = new BarcodeService();
        
        foreach ($registrations as $registration) {
            try {
                // Generate new registration number
                $newNumber = Registration::generateRegistrationNumber();
                
                // Update registration number
                $oldNumber = $registration->registration_number;
                $registration->registration_number = $newNumber;
                
                // Regenerate barcode if exists
                if ($registration->barcode) {
                    try {
                        $newBarcodePath = $barcodeService->generateBarcode($newNumber);
                        $registration->barcode = $newBarcodePath;
                    } catch (\Exception $e) {
                        $this->warn("\nFailed to regenerate barcode for registration {$registration->id}: " . $e->getMessage());
                    }
                }
                
                $registration->save();
                
                $successCount++;
                
                if ($oldNumber) {
                    $this->line("\nUpdated: {$oldNumber} -> {$newNumber}");
                } else {
                    $this->line("\nAssigned: {$newNumber}");
                }
            } catch (\Exception $e) {
                $errorCount++;
                $this->error("\nError updating registration {$registration->id}: " . $e->getMessage());
            }
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine(2);
        $this->info("Successfully updated {$successCount} registration numbers.");
        
        if ($errorCount > 0) {
            $this->warn("Failed to update {$errorCount} registrations.");
        }
        
        return 0;
    }
}
