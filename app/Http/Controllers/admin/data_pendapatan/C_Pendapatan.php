<?php

namespace App\Http\Controllers\admin\data_pendapatan;


use App\Http\Controllers\Controller;
use App\Models\M_BukuBesar;
use Illuminate\Http\Request;
use App\Models\M_Jurnal;
use Carbon\Carbon;
use DataTables;

class C_Pendapatan extends Controller
{
    public function index(Request $request)
    {
        $title = 'Pendapatan | Admin';

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
                ->where('rincian_jurnal', 'Pendapatan')
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

        $start_date = $month;
        $end_date = session('end_date', now()->toDateString());

        return view('admin/data_pendapatan/V_Pendapatan', compact('title', 'start_date', 'end_date'));
    }
}
