<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class JurnalExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Akun',
            'Reff',
            'Nominal',
            'Keterangan',
            'Status',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $highestRow = $event->sheet->getDelegate()->getHighestRow();
                $highestColumn = $event->sheet->getDelegate()->getHighestColumn();

                $cellRangeHeader = 'A1:F1';
                // Ukuran Text
                $event->sheet->getDelegate()->getStyle($cellRangeHeader)->getFont()->setSize(13);
                // Text Bold
                $event->sheet->getDelegate()->getStyle($cellRangeHeader)->getFont()->setBold(true);

                $cellRange = 'A1:' . $highestColumn . $highestRow;

                // Border
                $event->sheet->getDelegate()->getStyle($cellRange)->getBorders()->getAllBorders()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            },
        ];
    }
}
