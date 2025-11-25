<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Registration;
use App\Services\BarcodeService;

class GenerateBarcodesForApprovedRegistrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registrations:generate-barcodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate barcodes for all approved registrations that don\'t have one yet';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $barcodeService = new BarcodeService();
        
        $registrations = Registration::where('status', 'approved')
            ->whereNull('barcode')
            ->whereNotNull('registration_number')
            ->get();

        if ($registrations->isEmpty()) {
            $this->info('No approved registrations without barcodes found.');
            return 0;
        }

        $this->info("Found {$registrations->count()} approved registrations without barcodes.");
        $this->info('Generating barcodes...');

        $bar = $this->output->createProgressBar($registrations->count());
        $bar->start();

        $successCount = 0;
        $errorCount = 0;

        foreach ($registrations as $registration) {
            try {
                $barcodePath = $barcodeService->generateBarcode($registration->registration_number);
                $registration->update(['barcode' => $barcodePath]);
                $successCount++;
            } catch (\Exception $e) {
                $this->error("\nError generating barcode for registration {$registration->id}: " . $e->getMessage());
                $errorCount++;
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Successfully generated {$successCount} barcodes.");
        
        if ($errorCount > 0) {
            $this->warn("Failed to generate {$errorCount} barcodes.");
        }

        return 0;
    }
}
