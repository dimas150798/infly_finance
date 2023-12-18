<?php

namespace App\Http\Controllers\admin\data_pembelian;

use App\Http\Controllers\Controller;
use App\Models\M_BukuBesar;
use App\Models\M_Jurnal;
use Illuminate\Http\Request;

use App\Exports\JurnalExport;

use App\Models\M_Akun;


use DataTables;
use Maatwebsite\Excel\Facades\Excel;


class C_EditPembelian extends Controller
{
    // Edit Data Jurnal
    function FormEdit($id_jurnal)
    {
        $title = 'Edit Pembelian | Admin';

        $jurnal = M_Jurnal::select('data_jurnal.*', 'data_akun.*',)
            ->join('data_akun', 'data_jurnal.nama_akun', '=', 'data_akun.nama_akun')
            ->find($id_jurnal);

        if (empty($jurnal)) {
            return redirect()->route('pembelian.datapembelian')->with('alert-gagal', 'Akun tidak ditemukan');
        }

        return view('admin/data_pembelian/V_EditPembelian', compact('title', 'jurnal'));
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

        // Update Jurnal Pembelian (KAS)
        $jurnal_kas = M_Jurnal::where('nama_akun', 'Kas')
            ->where('reff_jurnal', $validatedData['reff_jurnal'])
            ->first();

        // Update Buku Besar Bebit (ALL Selain KAS)
        $bukubesar  = M_BukuBesar::Where('id_jurnal', $id)->first();

        // Update Buku Besar Kredit (KAS)
        $bukubesar_kas = M_BukuBesar::where('nama_akun', 'Kas')
            ->where('reff_jurnal', $validatedData['reff_jurnal'])
            ->first();

        if ($bukubesar == NULL) {
            // Debit Pembelian
            $jurnal->update([
                'tanggal_jurnal'     => $validatedData['tanggal_jurnal'],
                'reff_jurnal'        => $validatedData['reff_jurnal'],
                'nominal_jurnal'     => $validatedData['nominal_jurnal'],
                'note_jurnal'        => $validatedData['note_jurnal'],
            ]);

            // Kredit Pembelian
            $jurnal_kas->update([
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

            // Kredit Pembelian
            $jurnal_kas->update([
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

            // Buku Besar Kredit
            $bukubesar_kas->update([
                'tanggal_jurnal'    => $validatedData['tanggal_jurnal'],
                'reff_jurnal'       => $validatedData['reff_jurnal'],
                'nominal_kredit'    => $validatedData['nominal_jurnal'],
                'note_jurnal'       => $validatedData['note_jurnal'],
            ]);
        }

        return redirect()->route('pembelian.datapembelian')->with('alert-success', 'Data akun berhasil diperbarui');
    }
}
