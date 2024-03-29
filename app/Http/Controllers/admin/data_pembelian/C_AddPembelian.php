<?php

namespace App\Http\Controllers\admin\data_pembelian;

use App\Http\Controllers\Controller;
use App\Models\M_Akun;
use App\Models\M_Jurnal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class C_AddPembelian extends Controller
{
    // Tambah Data Debit
    function FormAddPembelian()
    {
        $title = 'Tambah Debit | Admin';

        // $reff_debit = "JU/" . date('y/m') . '/';

        // Ambil nilai terakhir dari database
        $data = M_Jurnal::orderBy('reff_jurnal', 'desc')->first();

        // Inisialisasi nilai untuk angka terakhir
        $nextNumber = 1;

        // Jika ada data di database, ambil angka terakhir dan tambahkan satu
        if ($data && $data->reff_jurnal) {

            // Memisahkan string berdasarkan karakter '/'
            $parts = explode('/', $data->reff_jurnal);

            // Mengambil elemen terakhir dari array
            $nextNumber = (int)end($parts) + 1;
        }

        // Format angka terakhir dengan padding nol di depan
        $kodeIncremented = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Buat kode reff_jurnal
        $reff_jurnal = "JU/23/12/" . $kodeIncremented;

        $options = M_Akun::all();

        return view('admin/data_pembelian/V_AddPembelian', compact('title', 'options', 'reff_jurnal'));
    }

    function SaveAddPembelian(Request $request)
    {
        // Validasi data input
        $request->validate(
            [
                'tanggal_jurnal'        => 'required',
                'nama_akun'             => 'required',
                'reff_jurnal'           => 'required'
            ],
            [
                'tanggal_jurnal.required'   => htmlspecialchars('Tanggal Wajib Di isi !', ENT_QUOTES, 'UTF-8'),
                'nama_akun.required'        => htmlspecialchars('Nama Akun Wajib Di isi !', ENT_QUOTES, 'UTF-8'),
                'reff_jurnal.required'      => htmlspecialchars('Reff Wajib Di isi !', ENT_QUOTES, 'UTF-8')
            ]
        );

        // Data Debit
        M_Jurnal::create([
            'tanggal_jurnal'    => $request->tanggal_jurnal,
            'nama_akun'         => $request->nama_akun,
            'reff_jurnal'       => $request->reff_jurnal,
            'nominal_jurnal'    => $request->nominal_jurnal,
            'note_jurnal'       => $request->note_jurnal,
            'status_jurnal'     => 'Debit',
            'rincian_jurnal'    => 'Pembelian'
        ]);

        // Data Kredit
        M_Jurnal::create([
            'tanggal_jurnal'    => $request->tanggal_jurnal,
            'nama_akun'         => 'Kas',
            'reff_jurnal'       => $request->reff_jurnal,
            'nominal_jurnal'    => $request->nominal_jurnal,
            'note_jurnal'       => $request->note_jurnal,
            'status_jurnal'     => 'Kredit',
            'rincian_jurnal'    => 'Pembelian'
        ]);

        return redirect()->route('pembelian.datapembelian')->with('alert-success', 'Data berhasil ditambahkan');
    }
}
