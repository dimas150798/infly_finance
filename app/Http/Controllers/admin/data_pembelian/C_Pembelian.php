<?php

namespace App\Http\Controllers\admin\data_pembelian;

use App\Http\Controllers\Controller;
use App\Models\M_BukuBesar;
use Illuminate\Http\Request;
use App\Models\M_Jurnal;
use Carbon\Carbon;
use DataTables;

class C_Pembelian extends Controller
{
    public function index(Request $request)
    {
        $title = 'Pembelian | Admin';

        if ($request->ajax()) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

            if (empty($start_date) && empty($end_date)) {
                $month = Carbon::now()->startOfMonth()->toDateString();
                $year = Carbon::now()->startOfYear()->toDateString();

                $start_date = $month;
                $end_date = now()->toDateString();

                session(['start_date' => $start_date, 'end_date' => $end_date]);
            } else {
                // If not empty, store them in the session
                session(['start_date' => $start_date, 'end_date' => $end_date]);
            }

            $data = M_Jurnal::select('*')
                ->where('rincian_jurnal', 'Pembelian')
                ->where('status_jurnal', 'Debit')
                ->where('posting_bukubesar', NULL)
                ->orderBy('reff_jurnal', 'desc')
                ->orderBy('status_jurnal', 'asc')
                ->get();

            $data->whereBetween('tanggal_jurnal', [$start_date, $end_date]);
            $count = 1;

            return Datatables::of($data)
                ->addColumn('no', function () use (&$count) {
                    return $count++;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('pembelian.formedit', ['id_jurnal' => $row->id_jurnal]);
                    $deleteUrl = route('pembelian.deletepembelian', ['id_jurnal' => $row->id_jurnal]);

                    $actionBtn = '<div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item edit-alert" href="' . $editUrl . '"><i class="bi bi-pencil-square"></i> Edit</a></li>
                            <li><a class="dropdown-item delete-alert" href="' . $deleteUrl . '"><i class="bi bi-trash"></i> Delete</a></li>
                        </ul>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('tanggal_jurnal', function ($row) {
                    return Carbon::parse($row->tanggal_jurnal)->format('d F Y');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $month = Carbon::now()->startOfMonth()->toDateString();
        $year = Carbon::now()->startOfYear()->toDateString();

        $start_date = session('start_date', now()->toDateString());
        $end_date = session('end_date', now()->toDateString());

        return view('admin/data_pembelian/V_Pembelian', compact('title', 'start_date', 'end_date'));
    }

    // Delete Data
    public function DeleteData($id_jurnal)
    {
        // Delete Jurnal Pembelian (ALL Selain KAS)
        $jurnal = M_Jurnal::where('id_jurnal', $id_jurnal)->first();
        $reff_jurnal = $jurnal->reff_jurnal;

        // Delete Jurnal Pembelian (KAS)
        $jurnal_kas = M_Jurnal::where('nama_akun', 'Kas')
            ->where('reff_jurnal', $reff_jurnal)
            ->first();

        // Update Buku Besar Bebit (ALL Selain KAS)
        $bukubesar = M_BukuBesar::where('id_jurnal', $id_jurnal)->first();

        // Update Buku Besar Kredit (KAS)
        $bukubesar_kas = M_BukuBesar::where('nama_akun', 'Kas')
            ->where('reff_jurnal', $reff_jurnal)
            ->first();


        if ($bukubesar == NULL) {
            // Debit Pembelian
            $jurnal->delete();
            // Kredit Pembelian
            $jurnal_kas->delete();
        } else {
            // Debit Pembelian
            $jurnal->delete();
            // Kredit Pembelian
            $jurnal_kas->delete();

            // Debit Pembelian
            $bukubesar->delete();
            // Kredit Pembelian
            $bukubesar_kas->delete();
        }

        return redirect()->route('pembelian.datapembelian')->with('alert-success', 'Pembelian Berhasil Dihapus');
    }
}
