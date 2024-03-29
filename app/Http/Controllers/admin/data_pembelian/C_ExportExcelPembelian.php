<?php

namespace App\Http\Controllers\admin\data_pembelian;

use App\Exports\Export_Pembelian;
use App\Http\Controllers\Controller;
use App\Models\M_Jurnal;
use Maatwebsite\Excel\Facades\Excel;

class C_ExportExcelPembelian extends Controller
{
    // download excel
    public function ExportToExcel()
    {
        $data = M_Jurnal::select([
            'tanggal_jurnal',
            'nama_akun',
            'reff_jurnal',
            'nominal_jurnal',
            'note_jurnal',
            'status_jurnal',
            'posting_bukubesar'
        ])
            ->whereBetween('tanggal_jurnal', [session('start_date'), session('end_date')])
            ->where('rincian_jurnal', 'Pembelian')
            ->orderBy('reff_jurnal')
            ->orderBy('status_jurnal')
            ->get();


        // Export the data using the JurnalExport export class
        return Excel::download(new Export_Pembelian($data), 'DataPembelian.xlsx');
    }
}
