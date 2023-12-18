<?php

namespace App\Http\Controllers\admin\data_pendapatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M_BukuBesar;
use App\Models\M_Jurnal;

class C_EditPendapatan extends Controller
{
    // Edit Data Jurnal
    function FormEdit($id_jurnal)
    {
        $title = 'Edit Pendapatan | Admin';

        $jurnal = M_Jurnal::select('data_jurnal.*', 'data_akun.*',)
            ->join('data_akun', 'data_jurnal.nama_akun', '=', 'data_akun.nama_akun')
            ->find($id_jurnal);

        if (empty($jurnal)) {
            return redirect()->route('pendapatan.datapendapatan')->with('alert-gagal', 'Akun tidak ditemukan');
        }

        return view('admin/data_pendapatan/V_EditPendapatan', compact('title', 'jurnal'));
    }


    public function SaveEdit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_akun'         => 'required',
            'status_jurnal'     => 'required',
            'tanggal_jurnal'    => 'required',
            'reff_jurnal'       => 'required',
            'nominal_jurnal'    => 'required',
            'note_jurnal'       => 'required'
        ]);

        // Update Jurnal Pembelian (ALL Selain KAS)
        $jurnal     = M_Jurnal::where('id_jurnal', $id)->first();

        // Update Buku Besar Bebit (ALL Selain KAS)
        $bukubesar  = M_BukuBesar::Where('id_jurnal', $id)->first();

        if ($bukubesar == NULL) {
            // Debit Pembelian
            $jurnal->update([
                'tanggal_jurnal'     => $validatedData['tanggal_jurnal'],
                'reff_jurnal'        => $validatedData['reff_jurnal'],
                'nominal_jurnal'     => $validatedData['nominal_jurnal'],
                'note_jurnal'        => $validatedData['note_jurnal'],
            ]);
        } else {
            // Debit Pembelian
            $jurnal->update([
                'tanggal_jurnal'     => $validatedData['tanggal_jurnal'],
                'reff_jurnal'        => $validatedData['reff_jurnal'],
                'nominal_jurnal'     => $validatedData['nominal_jurnal'],
                'note_jurnal'        => $validatedData['note_jurnal'],
            ]);

            // Buku Besar Debit
            $bukubesar->update([
                'tanggal_jurnal'    => $validatedData['tanggal_jurnal'],
                'reff_jurnal'       => $validatedData['reff_jurnal'],
                'nominal_debit'     => $validatedData['nominal_jurnal'],
                'note_jurnal'       => $validatedData['note_jurnal'],
            ]);
        }

        return redirect()->route('pendapatan.datapendapatan')->with('alert-success', 'Data akun berhasil diperbarui');
    }
}
