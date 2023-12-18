<?php

namespace App\Http\Controllers\admin\data_pendapatan;

use App\Exports\Export_Pendapatan;
use App\Http\Controllers\Controller;
use App\Models\M_Jurnal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class C_ExportExcelPendapatan extends Controller
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
            'nama_area',
            'status_jurnal',
            'posting_bukubesar'
        ])
            ->whereBetween('tanggal_jurnal', [session('start_date'), session('end_date')])
            ->where('rincian_jurnal', 'Pendapatan')
            ->orderBy('reff_jurnal')
            ->orderBy('status_jurnal')
            ->get();


        // Export the data using the JurnalExport export class
        return Excel::download(new Export_Pendapatan($data), 'DataPendapatan.xlsx');
    }
}
