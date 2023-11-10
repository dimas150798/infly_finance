<?php

namespace App\Http\Controllers\admin\data_akun;

use App\Exports\AkunExport;
use App\Http\Controllers\Controller;
use App\Models\M_Akun;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;

class C_DataAkun extends Controller
{
    public function index(Request $request)
    {
        $title = 'Akun | Admin';

        if ($request->ajax()) {
            $data = M_Akun::select('*');

            $count = 1;

            return Datatables::of($data)
                ->addColumn('no', function () use (&$count) {
                    return $count++;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('akun.formeditakun', ['id_akun' => $row->id_akun]);
                    $deleteUrl = route('akun.deleteakun', ['id_akun' => $row->id_akun]);

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
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin/data_akun/V_DataAkun', compact('title'));
    }

    // Tambah Data
    function FormTambahAkun()
    {
        $title = 'Tambah Akun | Admin';
        return view('admin/data_akun/V_TambahAkun', compact('title'));
    }

    function SimpanTambahAkun(Request $request)
    {
        // Validasi data input
        $request->validate(
            [
                'kode_akun'  => 'required',
                'nama_akun'  => 'required',
                'tipe_akun'  => 'required'
            ],
            [
                'kode_akun.required'        => htmlspecialchars('Kode Akun Wajib Diisi', ENT_QUOTES, 'UTF-8'),
                'nama_akun.required'        => htmlspecialchars('Nama Akun Wajib Diisi', ENT_QUOTES, 'UTF-8'),
                'tipe_akun.required'        => htmlspecialchars('Tipe Akun Wajib Diisi', ENT_QUOTES, 'UTF-8'),
            ]
        );

        // Jika validasi berhasil, simpan data
        M_Akun::create([
            'kode_akun'     => $request->kode_akun,
            'nama_akun'     => $request->nama_akun,
            'tipe_akun'     => $request->tipe_akun,
            'debet_akun'    => 0,
            'kredit_akun'   => 0
        ]);

        return redirect()->route('akun.dataakun')->with('alert-success', 'Data berhasil ditambahkan');
    }

    // Edit Data
    function FormEditAkun($id_akun)
    {
        $title = 'Edit Akun | Admin';

        $akun = M_Akun::find($id_akun);

        if (!$akun) {
            return redirect()->route('akun.dataakun')->with('alert-danger', 'Akun tidak ditemukan');
        }

        return view('admin/data_akun/V_EditAkun', compact('title', 'akun'));
    }

    public function SimpanEditAkun(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_akun' => 'required',
            'nama_akun' => 'required',
            'tipe_akun' => 'required',
        ]);

        $akun = M_Akun::find($id);

        if (!$akun) {
            return redirect()->route('akun.dataakun')->with('alert-gagal', 'Akun tidak ditemukan');
        }

        $akun->kode_akun = $validatedData['kode_akun'];
        $akun->nama_akun = $validatedData['nama_akun'];
        $akun->tipe_akun = $validatedData['tipe_akun'];
        $akun->save();

        return redirect()->route('akun.dataakun')->with('alert-success', 'Data akun berhasil diperbarui');
    }

    // Delete Data
    public function DeleteData($id_akun)
    {
        $akun = M_Akun::find($id_akun);

        if ($akun) {
            try {
                $akun->delete();
                return response()->json(['success' => 'Akun berhasil dihapus']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Gagal menghapus akun: ' . $e->getMessage()], 500);
            }
        }

        return response()->json(['error' => 'Akun tidak ditemukan'], 404);
    }

    // download excel
    public function ExportToExcel()
    {
        $data = M_Akun::select([
            'kode_akun',
            'nama_akun',
            'tipe_akun',
        ])
            ->orderBy('kode_akun', 'ASC')
            ->get();


        // Export the data using the JurnalExport export class
        return Excel::download(new AkunExport($data), 'DataAkun.xlsx');
    }
}
