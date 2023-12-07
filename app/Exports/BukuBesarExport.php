<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class BukuBesarExport implements FromCollection, ShouldAutoSize, WithEvents, WithCustomStartCell, WithStyles, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function startCell(): string
    {
        return 'A5';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                // Judul Excel
                $event->sheet->setCellValue('A1', 'PT. URBAN TEKNOLOGI NUSANTARA');
                $event->sheet->setCellValue('A2', 'DATA BUKU BESAR');

                // Judul Table
                $event->sheet->setCellValue('A4', 'Tanggal Jurnal');
                $event->sheet->setCellValue('B4', 'Nama Akun');
                $event->sheet->setCellValue('C4', 'Reff Jurnal');
                $event->sheet->setCellValue('D4', 'Nominal Debit');
                $event->sheet->setCellValue('E4', 'Nominal Kredit');
                $event->sheet->setCellValue('F4', 'Note Jurnal');

                // Panjang
                $highestRow         = $event->sheet->getDelegate()->getHighestRow();
                $highestColumn      = $event->sheet->getDelegate()->getHighestColumn();

                $cellRangeHeader    = 'A4:F4';

                // Ukuran Text
                $event->sheet->getDelegate()->getStyle($cellRangeHeader)->getFont()->setSize(13);
                // Text Bold
                $event->sheet->getDelegate()->getStyle($cellRangeHeader)->getFont()->setBold(true);

                $cellRange = 'A4:' . $highestColumn . $highestRow;

                // Border
                $event->sheet->getDelegate()->getStyle($cellRange)->getBorders()->getAllBorders()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                // merge cell
                $event->sheet->mergeCells('A1:F1');
                $event->sheet->mergeCells('A2:F2');
            },
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true);

        return [
            // Style the first row as bold text.
            1    => [
                'font'  => ['bold' => true],
                'font'  => ['size' => 16]
            ],
            2    => [
                'font'  => ['bold' => true],
                'font'  => ['size' => 12]
            ],
        ];
    }
}
