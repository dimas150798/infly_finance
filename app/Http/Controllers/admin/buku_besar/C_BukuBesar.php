<?php

namespace App\Http\Controllers\admin\buku_besar;

use App\Exports\BukuBesarExport;
use App\Http\Controllers\Controller;
use App\Models\M_Akun;
use App\Models\M_BukuBesar;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class C_BukuBesar extends Controller
{
    public function index(Request $request)
    {
        $title = 'Buku Besar | Admin';
        $options = M_Akun::all();

        if ($request->ajax()) {
            $bulan      = $request->input('bulan');
            $tahun      = $request->input('tahun');
            $nama_akun  = $request->input('nama_akun');

            if (empty($tahun) && empty($bulan) && empty($nama_akun)) {
                $bulan = now()->month;
                $tahun = now()->year;
                $nama_akun = 'kas';

                session(['bulan' => $bulan, 'tahun' => $tahun, 'nama_akun' => $nama_akun]); // Simpan bulan dan tahun dalam sesi
            } else {
                // If not empty, store them in the session
                session(['bulan' => $bulan, 'tahun' => $tahun, 'nama_akun' => $nama_akun]);
            }

            $data = M_BukuBesar::select('*')
                ->orderBy('reff_jurnal', 'desc')
                ->orderBy('status_jurnal', 'asc');

            $data->whereYear('tanggal_jurnal', $tahun)
                ->whereMonth('tanggal_jurnal', $bulan)
                ->where('nama_akun', $nama_akun);
            $count = 1;

            return Datatables::of($data)
                ->addColumn('no', function () use (&$count) {
                    return $count++;
                })
                ->addColumn('action', function ($row) {
                    // $editUrl = route('jurnal.editJurnal', ['id_jurnal' => $row->id_jurnal]);
                    // $deleteUrl = route('jurnal.deleteJurnal', ['id_jurnal' => $row->id_jurnal]);

                    // $actionBtn = '<div class="dropdown">
                    //     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    //         Action
                    //     </button>
                    //     <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    //         <li><a class="dropdown-item edit-alert" href="#"><i class="bi bi-pencil-square"></i> Edit</a></li>
                    //         <li><a class="dropdown-item delete-alert" href="#"><i class="bi bi-trash"></i> Delete</a></li>
                    //     </ul>
                    // </div>';
                    // return $actionBtn;
                })
                ->addColumn('tanggal_jurnal', function ($row) {
                    return Carbon::parse($row->tanggal_jurnal)->format('d F Y');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $bulan      = session('bulan');
        $tahun      = session('tahun');
        $nama_akun  = session('nama_akun');

        return view('admin/buku_besar/V_BukuBesar', compact('title', 'options', 'bulan', 'tahun', 'nama_akun'));
    }

    // download excel
    public function ExportToExcel()
    {
        $data = M_BukuBesar::select([
            'buku_besar.tanggal_jurnal',
            'buku_besar.nama_akun',
            'buku_besar.reff_jurnal',
            'buku_besar.nominal_debit',
            'buku_besar.nominal_kredit',
            'buku_besar.note_jurnal',
            'data_jurnal.nama_area',
            'data_jurnal.status_jurnal',
        ])
            ->leftJoin('data_jurnal', 'buku_besar.id_jurnal', '=', 'data_jurnal.id_jurnal')
            ->whereMonth('buku_besar.tanggal_jurnal', '=', session('bulan'))
            ->whereYear('buku_besar.tanggal_jurnal', '=', session('tahun'))
            ->where('buku_besar.nama_akun', '=', session('nama_akun'))
            ->orderBy('reff_jurnal')
            ->orderBy('status_jurnal')
            ->get();


        // Export the data using the JurnalExport export class
        return Excel::download(new BukuBesarExport($data), 'BukuBesar_' . session('nama_akun') . ' ' . '('  . session('bulan') . '-'  . session('tahun') . ')' . '.xlsx');
    }
}
