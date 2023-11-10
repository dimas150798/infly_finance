<?php

namespace App\Http\Controllers\admin\data_jurnal;

use App\Exports\JurnalExport;
use App\Http\Controllers\Controller;
use App\Models\M_Akun;
use App\Models\M_BukuBesar;
use App\Models\M_Jurnal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;

class C_DataJurnal extends Controller
{
    public function index(Request $request)
    {
        $title = 'Jurnal | Admin';

        if ($request->ajax()) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

            if (empty($start_date) && empty($end_date)) {
                $start_date = now()->toDateString();
                $end_date = now()->toDateString();

                session(['start_date' => $start_date, 'end_date' => $end_date]);
            } else {
                // If not empty, store them in the session
                session(['start_date' => $start_date, 'end_date' => $end_date]);
            }

            $data = M_Jurnal::select('*')
                ->orderBy('reff_jurnal', 'asc')
                ->orderBy('status_jurnal', 'asc');

            $data->whereBetween('tanggal_jurnal', [$start_date, $end_date]);
            $count = 1;

            return Datatables::of($data)
                ->addColumn('no', function () use (&$count) {
                    return $count++;
                })
                ->addColumn('action', function ($row) {
                    // $editUrl = route('jurnal.editJurnal', ['id_jurnal' => $row->id_jurnal]);
                    // $deleteUrl = route('jurnal.deleteJurnal', ['id_jurnal' => $row->id_jurnal]);

                    $actionBtn = '<div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item edit-alert" href="#"><i class="bi bi-pencil-square"></i> Edit</a></li>
                            <li><a class="dropdown-item delete-alert" href="#"><i class="bi bi-trash"></i> Delete</a></li>
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

        $start_date = session('start_date', now()->toDateString());
        $end_date = session('end_date', now()->toDateString());

        return view('admin/data_jurnal/V_DataJurnal', compact('title', 'start_date', 'end_date'));
    }

    // Tambah Data Debit
    function FormTambahDebit()
    {
        $title = 'Tambah Debit | Admin';
        $reff_debit = "JU/" . date('y/m') . '/';

        $options = M_Akun::all();

        return view('admin/data_jurnal/V_TambahDebit', compact('title', 'options', 'reff_debit'));
    }

    function SimpanTambahDebit(Request $request)
    {
        // Validasi data input
        $request->validate(
            [
                'tanggal_debit'     => 'required',
                'nama_akun'         => 'required',
                'reff_debit'        => 'required'
            ],
            [
                'tanggal_debit.required'   => htmlspecialchars('Tanggal Wajib Di isi !', ENT_QUOTES, 'UTF-8'),
                'nama_akun.required'       => htmlspecialchars('Nama Akun Wajib Di isi !', ENT_QUOTES, 'UTF-8'),
                'reff_debit.required'      => htmlspecialchars('Reff Wajib Di isi !', ENT_QUOTES, 'UTF-8')
            ]
        );

        M_Jurnal::create([
            'tanggal_jurnal'    => $request->tanggal_debit,
            'nama_akun'         => $request->nama_akun,
            'reff_jurnal'       => $request->reff_debit,
            'nominal_jurnal'    => $request->nominal_debit,
            'note_jurnal'       => $request->note_debit,
            'status_jurnal'     => 'Debit'
        ]);

        return redirect()->route('jurnal.datajurnal')->with('alert-success', 'Data berhasil ditambahkan');
    }

    // Tambah Data Kredit
    function FormTambahKredit()
    {
        $title = 'Tambah Debit | Admin';
        $reff_kredit = "JU/" . date('y/m') . '/';

        $options = M_Akun::all();

        return view('admin/data_jurnal/V_TambahKredit', compact('title', 'options', 'reff_kredit'));
    }

    function SimpanTambahKredit(Request $request)
    {
        // Validasi data input
        $request->validate(
            [
                'tanggal_kredit'     => 'required',
                'nama_akun'         => 'required',
                'reff_kredit'        => 'required'
            ],
            [
                'tanggal_kredit.required'   => htmlspecialchars('Tanggal Wajib Di isi !', ENT_QUOTES, 'UTF-8'),
                'nama_akun.required'        => htmlspecialchars('Nama Akun Wajib Di isi !', ENT_QUOTES, 'UTF-8'),
                'reff_kredit.required'      => htmlspecialchars('Reff Wajib Di isi !', ENT_QUOTES, 'UTF-8')
            ]
        );

        M_Jurnal::create([
            'tanggal_jurnal'    => $request->tanggal_kredit,
            'nama_akun'         => $request->nama_akun,
            'reff_jurnal'       => $request->reff_kredit,
            'nominal_jurnal'    => $request->nominal_kredit,
            'note_jurnal'       => $request->note_kredit,
            'status_jurnal'     => 'Kredit'
        ]);

        return redirect()->route('jurnal.datajurnal')->with('alert-success', 'Data berhasil ditambahkan');
    }

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
        ])
            ->whereBetween('tanggal_jurnal', [session('start_date'), session('end_date')])
            ->orderBy('reff_jurnal')
            ->orderBy('status_jurnal')
            ->get();


        // Export the data using the JurnalExport export class
        return Excel::download(new JurnalExport($data), 'DataJurnal.xlsx');
    }

    // Posting jurnal ke buku besar
    function PostingJurnalKeBukuBesar()
    {
        // Ambil data dari tabel 'jurnal' dan hitung total nominal per nama akun dan reff_jurnal
        $dataJurnal = M_Jurnal::select('*')
            ->whereBetween('tanggal_jurnal', [session('start_date'), session('end_date')])
            ->get();

        foreach ($dataJurnal as $jurnal) {
            $id_jurnal          = $jurnal->id_jurnal;
            $tanggal_jurnal     = $jurnal->tanggal_jurnal;
            $nama_akun          = $jurnal->nama_akun;
            $reff_jurnal        = $jurnal->reff_jurnal;
            $nominal_jurnal     = $jurnal->nominal_jurnal;
            $note_jurnal        = $jurnal->note_jurnal;
            $status_jurnal      = $jurnal->status_jurnal;

            // Memeriksa apakah data dengan 'nama_akun' dan 'reff_jurnal' sudah ada di 'buku_besar'
            $existingBukuBesar = M_BukuBesar::where('nama_akun', $nama_akun)
                ->where('reff_jurnal', $reff_jurnal)
                ->first();

            if (!$existingBukuBesar) {
                // Jika data belum ada di 'buku_besar', tambahkan data baru
                if ($jurnal->status_jurnal == 'Debit') {
                    M_BukuBesar::create([
                        'id_jurnal'         => $id_jurnal,
                        'tanggal_jurnal'    => $tanggal_jurnal,
                        'nama_akun'         => $nama_akun,
                        'reff_jurnal'       => $reff_jurnal,
                        'nominal_debit'     => $nominal_jurnal,
                        'nominal_kredit'    => 0,
                        'note_jurnal'       => $note_jurnal,
                        'status_jurnal'     => $status_jurnal
                    ]);

                    // Add success notification
                    return redirect()->route('jurnal.datajurnal')->with('alert-success', 'Posting Berhasil  ');
                } elseif ($jurnal->status_jurnal == 'Kredit') {
                    M_BukuBesar::create([
                        'id_jurnal'         => $id_jurnal,
                        'tanggal_jurnal'    => $tanggal_jurnal,
                        'nama_akun'         => $nama_akun,
                        'reff_jurnal'       => $reff_jurnal,
                        'nominal_debit'     => 0,
                        'nominal_kredit'    => $nominal_jurnal,
                        'note_jurnal'       => $note_jurnal,
                        'status_jurnal'     => $status_jurnal
                    ]);

                    // Add success notification
                    return redirect()->route('jurnal.datajurnal')->with('alert-success', 'Posting Berhasil  ');
                }
            } else {
                // Jika data sudah ada di 'buku_besar', tambahkan notifikasi
                return redirect()->route('jurnal.datajurnal')->with('alert-gagal', 'Data dengan nama akun dan reff jurnal sudah ada');
            }
        }
    }
}
