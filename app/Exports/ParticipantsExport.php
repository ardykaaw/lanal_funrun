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

class ParticipantsExport
{
    protected $participants;

    public function __construct($participants)
    {
        $this->participants = $participants;
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set page orientation and size
        $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);

        // Header section - Layout horizontal: Logo AL (kiri) - Judul (tengah) - Logo Event (kanan)
        $row = 5;
        
        // Logo AL di kiri (A5:B6)
        try {
            $this->addALLogo($sheet, $row);
        } catch (\Exception $e) {
            Log::warning('Failed to add AL logo: ' . $e->getMessage());
        }
        
        // Judul di tengah (C5:L6)
        $sheet->setCellValue('C' . $row, 'DATA PESERTA TERKONFIRMASI - DANLANAL KENDARI FUN RUN 2025');
        $sheet->mergeCells('C' . $row . ':L' . ($row + 1));
        $sheet->getStyle('C' . $row)->applyFromArray([
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
        
        // Logo Event di kanan (M5:O6) - bersebelahan dengan judul
        try {
            $this->addEventLogo($sheet, $row);
        } catch (\Exception $e) {
            Log::warning('Failed to add Event logo: ' . $e->getMessage());
        }

        // Tanggal Export di baris berikutnya
        $row = 7;
        $sheet->setCellValue('C' . $row, 'Tanggal Export: ' . date('d F Y H:i:s'));
        $sheet->mergeCells('C' . $row . ':L' . $row);
        $sheet->getStyle('C' . $row)->applyFromArray([
            'font' => ['size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        
        // Set row heights
        $sheet->getRowDimension(5)->setRowHeight(30);
        $sheet->getRowDimension(6)->setRowHeight(30);
        $sheet->getRowDimension(7)->setRowHeight(20);

        // Column headers (start from row 8, after header section)
        $row = 8;
        $headers = [
            'No', 'No. Pendaftaran', 'Nama Depan', 'Nama Belakang', 'Nama di BIB',
            'Email', 'Telepon', 'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin',
            'Pekerjaan', 'Jenis Identitas', 'Nomor Identitas', 'Alamat', 'Kota',
            'Ukuran Jersey', 'Golongan Darah', 'Kategori', 'Nama Kontak Darurat',
            'Telepon Kontak Darurat', 'Komunitas', 'Catatan Medis', 'Tanggal Disetujui'
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
        $widths = [5, 15, 15, 15, 12, 25, 15, 15, 12, 12, 15, 12, 15, 30, 15, 10, 10, 15, 20, 15, 20, 30, 18];
        $col = 'A';
        foreach ($widths as $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
            $col++;
        }

        // Data rows
        $row++;
        $no = 1;
        foreach ($this->participants as $participant) {
            $adminNotes = $participant->admin_notes ? json_decode($participant->admin_notes, true) : [];
            $birthPlace = $adminNotes['birth_place'] ?? '-';

            $data = [
                $no++,
                $participant->registration_number ?? '-',
                $participant->first_name,
                $participant->last_name,
                $participant->bib_name,
                $participant->email,
                $participant->phone,
                $birthPlace,
                $participant->birth_date ? $participant->birth_date->format('d/m/Y') : '-',
                $participant->gender,
                $participant->occupation,
                $participant->id_type,
                $participant->id_number,
                $participant->address,
                $participant->city,
                $participant->jersey_size,
                $participant->blood_type,
                $participant->category,
                $participant->emergency_name,
                $participant->emergency_phone,
                $participant->community ?? '-',
                $participant->medical_notes ?? '-',
                $participant->approved_at ? $participant->approved_at->format('d/m/Y H:i') : '-',
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
                $sheet->getStyle('A' . $row . ':W' . $row)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E2F4FF'],
                    ],
                ]);
            }

            $row++;
        }

        // Set row height for header
        $sheet->getRowDimension(8)->setRowHeight(30);

        // Freeze panes (freeze header row)
        $sheet->freezePane('A9');

        return $spreadsheet;
    }

    protected function addALLogo($sheet, $row)
    {
        // Logo AL 2D (IMG_4803.PNG) - Positioned di kiri (A5:B6)
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
                // Merge cells for AL logo area (A5:B6) - di kiri
                $sheet->mergeCells('A' . $row . ':B' . ($row + 1));
                
                // Set column widths for logo area
                $sheet->getColumnDimension('A')->setWidth(15);
                $sheet->getColumnDimension('B')->setWidth(15);
                
                $drawing = new Drawing();
                $drawing->setName('Logo AL');
                $drawing->setDescription('Logo Angkatan Laut 2D');
                $drawing->setPath($logoALPath);
                $drawing->setHeight(60);
                $drawing->setCoordinates('A' . $row);
                $drawing->setOffsetX(5);
                $drawing->setOffsetY(5);
                $drawing->setWorksheet($sheet);
                
                // Center align the merged cells
                $sheet->getStyle('A' . $row . ':B' . ($row + 1))->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);
                
                Log::info('AL logo added successfully: ' . $logoALPath);
            } catch (\Exception $e) {
                Log::warning('Failed to add AL logo: ' . $e->getMessage());
            }
        } else {
            Log::warning('AL logo file not found. Tried multiple paths.');
        }
    }

    protected function addEventLogo($sheet, $row)
    {
        // Logo Event (Logg4.png) - Positioned di kanan (M5:O6) bersebelahan dengan judul
        $logoEventPath = base_path('assets/lanal/logo-event/Logg4.png');
        if (!file_exists($logoEventPath)) {
            // Try alternative path
            $logoEventPath = public_path('assets/lanal/logo-event/Logg4.png');
        }
        
        if (file_exists($logoEventPath)) {
            try {
                // Merge cells for logo area di kanan (M5:O6)
                $sheet->mergeCells('M' . $row . ':O' . ($row + 1));
                
                // Set column widths for logo area
                $sheet->getColumnDimension('M')->setWidth(15);
                $sheet->getColumnDimension('N')->setWidth(15);
                $sheet->getColumnDimension('O')->setWidth(15);
                
                $drawing = new Drawing();
                $drawing->setName('Logo Event');
                $drawing->setDescription('DANLANAL Fun Run Logo');
                $drawing->setPath($logoEventPath);
                $drawing->setHeight(60); // Ukuran yang pas untuk circular logo
                $drawing->setCoordinates('M' . $row);
                $drawing->setOffsetX(5); // Center offset
                $drawing->setOffsetY(5); // Small offset from top
                $drawing->setWorksheet($sheet);
                
                // Center align the merged cells
                $sheet->getStyle('M' . $row . ':O' . ($row + 1))->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);
                
                Log::info('Event logo added successfully: ' . $logoEventPath);
            } catch (\Exception $e) {
                Log::warning('Failed to add event logo: ' . $e->getMessage());
            }
        } else {
            Log::warning('Event logo file not found. Tried: ' . base_path('assets/lanal/logo-event/Logg4.png'));
        }
    }
}

