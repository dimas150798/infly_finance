<?php

namespace App\Http\Controllers\admin\data_pendapatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M_BukuBesar;
use App\Models\M_Jurnal;

class C_PostingBukuBesarPendapatan extends Controller
{
    function PostingBukuBesar()
    {
        // Ambil data dari tabel 'jurnal' dan hitung total nominal per nama akun dan reff_jurnal
        $dataJurnal = M_Jurnal::select('*')
            ->whereBetween('tanggal_jurnal', [session('start_date'), session('end_date')])
            ->where('posting_bukubesar', NULL)
            ->get();

        foreach ($dataJurnal as $jurnal) {
            $id_jurnal          = $jurnal->id_jurnal;
            $tanggal_jurnal     = $jurnal->tanggal_jurnal;
            $nama_akun          = $jurnal->nama_akun;
            $reff_jurnal        = $jurnal->reff_jurnal;
            $nominal_jurnal     = $jurnal->nominal_jurnal;
            $note_jurnal        = $jurnal->note_jurnal;
            $status_jurnal      = $jurnal->status_jurnal;

            // Update Jurnal Pembelian (ALL Selain KAS)
            $jurnalstatus_potingbukubesar = M_Jurnal::where('id_jurnal', $id_jurnal)
                ->where('reff_jurnal', $reff_jurnal)
                ->first();

            $jurnalstatus_potingbukubesar->update([
                'posting_bukubesar'     => 'Done'
            ]);

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
                }
            }
        }

        return redirect()->route('pendapatan.datapendapatan')->with('alert-success', 'Posting Berhasil ');
    }
}
