<?php

namespace App\Http\Controllers\admin\data_pembelian;

use App\Http\Controllers\Controller;
use App\Models\M_Akun;
use App\Models\M_Jurnal;
use Illuminate\Http\Request;

class C_AddPembelian extends Controller
{
    // Tambah Data Debit
    function FormAddPembelian()
    {
        $title = 'Tambah Debit | Admin';

        $reff_debit = "JU/" . date('y/m') . '/';

        $options = M_Akun::all();

        return view('admin/data_pembelian/V_AddPembelian', compact('title', 'options', 'reff_debit'));
    }

    function SaveAddPembelian(Request $request)
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

        // Data Debit
        M_Jurnal::create([
            'tanggal_jurnal'    => $request->tanggal_debit,
            'nama_akun'         => $request->nama_akun,
            'reff_jurnal'       => $request->reff_debit,
            'nominal_jurnal'    => $request->nominal_debit,
            'note_jurnal'       => $request->note_debit,
            'status_jurnal'     => 'Debit',
            'rincian_jurnal'    => 'Pembelian'
        ]);

        // Data Kredit
        M_Jurnal::create([
            'tanggal_jurnal'    => $request->tanggal_debit,
            'nama_akun'         => 'Kas',
            'reff_jurnal'       => $request->reff_debit,
            'nominal_jurnal'    => $request->nominal_debit,
            'note_jurnal'       => $request->note_debit,
            'status_jurnal'     => 'Kredit',
            'rincian_jurnal'    => 'Pembelian'
        ]);

        return redirect()->route('pembelian.datapembelian')->with('alert-success', 'Data berhasil ditambahkan');
    }
}
