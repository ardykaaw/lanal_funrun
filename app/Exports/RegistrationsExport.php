<?php

namespace App\Exports;

use App\Models\Registration;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use Illuminate\Support\Facades\Log;

class RegistrationsExport
{
    protected $registrations;

    public function __construct($registrations)
    {
        $this->registrations = $registrations;
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set page orientation and size
        $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);

        // Add logos in header (try to add, but don't fail if images don't exist)
        try {
            $this->addLogos($sheet);
        } catch (\Exception $e) {
            // Log error but continue
            Log::warning('Failed to add logos to Excel export: ' . $e->getMessage());
        }

        // Header section
        $row = 5;
        $sheet->setCellValue('A' . $row, 'DATA PESERTA DANLANAL KENDARI FUN RUN 2025');
        $sheet->mergeCells('A' . $row . ':P' . $row);
        $sheet->getStyle('A' . $row)->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
                'color' => ['rgb' => '0368C9'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $row++;
        $sheet->setCellValue('A' . $row, 'Tanggal Export: ' . date('d F Y H:i:s'));
        $sheet->mergeCells('A' . $row . ':P' . $row);
        $sheet->getStyle('A' . $row)->applyFromArray([
            'font' => ['size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // Column headers
        $row += 2;
        $headers = [
            'No', 'No. Pendaftaran', 'Nama Depan', 'Nama Belakang', 'Nama di BIB',
            'Email', 'Telepon', 'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin',
            'Pekerjaan', 'Jenis Identitas', 'Nomor Identitas', 'Alamat', 'Kota',
            'Ukuran Jersey', 'Golongan Darah', 'Kategori', 'Status', 'Status Pembayaran',
            'Nama Kontak Darurat', 'Telepon Kontak Darurat', 'Komunitas', 'Catatan Medis', 'Tanggal Daftar'
        ];

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . $row, $header);
            $sheet->getStyle($col . $row)->applyFromArray([
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 10,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0368C9'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                ],
            ]);
            $col++;
        }

        // Set column widths
        $widths = [5, 15, 15, 15, 12, 25, 15, 15, 12, 12, 15, 12, 15, 30, 15, 10, 10, 15, 12, 15, 20, 15, 20, 30, 18];
        $col = 'A';
        foreach ($widths as $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
            $col++;
        }

        // Data rows
        $row++;
        $no = 1;
        foreach ($this->registrations as $registration) {
            $adminNotes = $registration->admin_notes ? json_decode($registration->admin_notes, true) : [];
            $birthPlace = $adminNotes['birth_place'] ?? '-';

            $data = [
                $no++,
                $registration->registration_number ?? '-',
                $registration->first_name,
                $registration->last_name,
                $registration->bib_name,
                $registration->email,
                $registration->phone,
                $birthPlace,
                $registration->birth_date ? $registration->birth_date->format('d/m/Y') : '-',
                $registration->gender,
                $registration->occupation,
                $registration->id_type,
                $registration->id_number,
                $registration->address,
                $registration->city,
                $registration->jersey_size,
                $registration->blood_type,
                $registration->category,
                $this->getStatusText($registration->status),
                $this->getPaymentStatusText($registration->payment_status),
                $registration->emergency_name,
                $registration->emergency_phone,
                $registration->community ?? '-',
                $registration->medical_notes ?? '-',
                $registration->created_at->format('d/m/Y H:i'),
            ];

            $col = 'A';
            foreach ($data as $value) {
                $sheet->setCellValue($col . $row, $value);
                $sheet->getStyle($col . $row)->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_LEFT,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC'],
                        ],
                    ],
                ]);
                $col++;
            }

            // Alternate row colors
            if ($row % 2 == 0) {
                $sheet->getStyle('A' . $row . ':Y' . $row)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E2F4FF'],
                    ],
                ]);
            }

            $row++;
        }

        // Set row height for header
        $sheet->getRowDimension(7)->setRowHeight(30);

        // Freeze panes (freeze header row)
        $sheet->freezePane('A8');

        return $spreadsheet;
    }

    protected function addLogos($sheet)
    {
        // Logo Event (Logg4.png)
        $logoEventPath = base_path('assets/lanal/logo-event/Logg4.png');
        if (!file_exists($logoEventPath)) {
            // Try alternative path
            $logoEventPath = public_path('assets/lanal/logo-event/Logg4.png');
        }
        
        if (file_exists($logoEventPath)) {
            try {
                $drawing = new Drawing();
                $drawing->setName('Logo Event');
                $drawing->setDescription('DANLANAL Fun Run Logo');
                $drawing->setPath($logoEventPath);
                $drawing->setHeight(60);
                $drawing->setCoordinates('A1');
                $drawing->setWorksheet($sheet);
                Log::info('Event logo added successfully: ' . $logoEventPath);
            } catch (\Exception $e) {
                Log::warning('Failed to add event logo: ' . $e->getMessage());
            }
        } else {
            Log::warning('Event logo file not found. Tried: ' . base_path('assets/lanal/logo-event/Logg4.png'));
        }

        // Logo AL 2D (IMG_4803.PNG)
        $logoALPath = base_path('assets/lanal/logo-AL/IMG_4803.PNG');
        if (!file_exists($logoALPath)) {
            // Try alternative paths
            $logoALPath = base_path('assets/lanal/IMG_4803.PNG');
        }
        if (!file_exists($logoALPath)) {
            $logoALPath = public_path('assets/lanal/IMG_4803.PNG');
        }
        if (!file_exists($logoALPath)) {
            $logoALPath = base_path('assets/lanal/img_4803.PNG');
        }
        
        if (file_exists($logoALPath)) {
            try {
                $drawing = new Drawing();
                $drawing->setName('Logo AL');
                $drawing->setDescription('Logo Angkatan Laut 2D');
                $drawing->setPath($logoALPath);
                $drawing->setHeight(60);
                $drawing->setCoordinates('O1');
                $drawing->setWorksheet($sheet);
                Log::info('AL logo added successfully: ' . $logoALPath);
            } catch (\Exception $e) {
                Log::warning('Failed to add AL logo: ' . $e->getMessage());
            }
        } else {
            Log::warning('AL logo file not found. Tried multiple paths.');
        }

        // Set row height for logo row
        $sheet->getRowDimension(1)->setRowHeight(65);
    }

    protected function getStatusText($status)
    {
        return match($status) {
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'pending' => 'Menunggu',
            default => $status,
        };
    }

    protected function getPaymentStatusText($status)
    {
        return match($status) {
            'verified' => 'Terkonfirmasi',
            'rejected' => 'Ditolak',
            'pending' => 'Pending',
            default => $status,
        };
    }
}

