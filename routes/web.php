<?php

use App\Http\Controllers\admin\buku_besar\C_BukuBesar;
use App\Http\Controllers\admin\C_DashboardAdmin;
use App\Http\Controllers\admin\data_akun\C_DataAkun;
use App\Http\Controllers\admin\data_jurnal\C_DataJurnal;
use App\Http\Controllers\admin\data_pembelian\C_AddPembelian;
use App\Http\Controllers\admin\data_pembelian\C_EditPembelian;
use App\Http\Controllers\admin\data_pembelian\C_ExportExcelPembelian;
use App\Http\Controllers\admin\data_pembelian\C_Pembelian;
use App\Http\Controllers\admin\data_pembelian\C_PostingBukuBesarPembelian;
use App\Http\Controllers\C_Login;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [C_Login::class, 'index']);
    Route::post('/', [C_Login::class, 'login']);
});

Route::post('/logout', [C_Login::class, 'logout'])->name('logout');

// Apabila dia sudah login tidak bisa kembali ke login
Route::get('/home', function () {
    return redirect('/admin/dashboard');
});

// Apabila belum login dia tidak bisa masuk
Route::get('/login', [C_Login::class, 'index'])->name('login');
Route::post('/login', [C_Login::class, 'login']);

Route::middleware(['auth', 'loginAkses:admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [C_DashboardAdmin::class, 'index'])->name('admin.dashboard');

    // Data Akun
    Route::get('/akun/dataakun', [C_DataAkun::class, 'index'])->name('akun.dataakun');
    // Tambah Akun
    Route::get('/akun/formtambahakun', [C_DataAkun::class, 'formtambahakun'])->name('akun.formtambahakun');
    Route::post('/akun/simpantambahakun', [C_DataAkun::class, 'simpantambahakun'])->name('akun.simpantambahakun');
    // Edit Akun
    Route::get('/akun/formeditakun/{id_akun}', [C_DataAkun::class, 'formeditakun'])->name('akun.formeditakun');
    Route::post('/akun/simpaneditakun/{id_akun}', [C_DataAkun::class, 'simpaneditakun'])->name('akun.simpaneditakun');
    // Delete Akun
    Route::get('/akun/deleteakun/{id_akun}', [C_DataAkun::class, 'deletedata'])->name('akun.deleteakun');
    // Export To Excel
    Route::get('/akun/exporttoexcel', [C_DataAkun::class, 'exporttoexcel'])->name('akun.exporttoexcel');

    // Data Jurnal
    Route::get('/jurnal/datajurnal', [C_DataJurnal::class, 'index'])->name('jurnal.datajurnal');
    // Tambah Debit Di Jurnal
    Route::get('/jurnal/formtambahdebit', [C_DataJurnal::class, 'formtambahdebit'])->name('jurnal.formtambahdebit');
    Route::post('/jurnal/simpantambahdebit', [C_DataJurnal::class, 'simpantambahdebit'])->name('jurnal.simpantambahdebit');
    // Tambah Kredit Di Jurnal
    Route::get('/jurnal/formtambahkredit', [C_DataJurnal::class, 'formtambahkredit'])->name('jurnal.formtambahkredit');
    Route::post('/jurnal/simpantambahkredit', [C_DataJurnal::class, 'simpantambahkredit'])->name('jurnal.simpantambahkredit');
    // Export To Excel
    Route::get('/jurnal/exporttoexcel', [C_DataJurnal::class, 'exporttoexcel'])->name('jurnal.exporttoexcel');
    // Posting Data Jurnal Ke Buku Besar
    Route::get('/jurnal/postingjurnal', [C_DataJurnal::class, 'postingjurnalkebukubesar'])->name('jurnal.postingjurnal');
    // Edit Data Jurnal
    Route::get('/jurnal/formeditjurnal/{id_jurnal}', [C_DataJurnal::class, 'formeditjurnal'])->name('jurnal.formeditjurnal');
    Route::post('/jurnal/simpaneditjurnal/{id_jurnal}', [C_DataJurnal::class, 'simpaneditjurnal'])->name('jurnal.simpaneditjurnal');
    // Delete Data Jurnal
    Route::get('/jurnal/deletejurnal/{id_jurnal}', [C_DataJurnal::class, 'deletedata'])->name('jurnal.deletejurnal');

    // Buku Besar
    Route::get('/bukubesar/bukubesar', [C_BukuBesar::class, 'index'])->name('bukubesar.bukubesar');
    // Export To Excel
    Route::get('/bukubesar/exporttoexcel', [C_BukuBesar::class, 'exporttoexcel'])->name('bukubesar.exporttoexcel');

    // Data Pembelian
    Route::get('/pembelian/datapembelian', [C_Pembelian::class, 'index'])->name('pembelian.datapembelian');
    // Tambah Pembelian
    Route::get('/pembelian/formaddpembelian', [C_AddPembelian::class, 'formaddpembelian'])->name('pembelian.formaddpembelian');
    Route::post('/pembelian/saveaddpembelian', [C_AddPembelian::class, 'saveaddpembelian'])->name('pembelian.saveaddpembelian');
    // Edit Pembelian
    Route::get('/pembelian/formedit/{id_jurnal}', [C_EditPembelian::class, 'formedit'])->name('pembelian.formedit');
    Route::post('/pembelian/saveedit/{id_jurnal}', [C_EditPembelian::class, 'saveedit'])->name('pembelian.saveedit');
    // Delete Pembelian
    Route::get('/pembelian/deletepembelian/{id_jurnal}', [C_Pembelian::class, 'deletedata'])->name('pembelian.deletepembelian');

    // Export To Excel
    Route::get('/pembelian/exporttoexcel', [C_ExportExcelPembelian::class, 'exporttoexcel'])->name('pembelian.exporttoexcel');
    // Postin Pembelian To Buku Besar
    Route::get('/pembelian/postingpembelian', [C_PostingBukuBesarPembelian::class, 'postingbukubesar'])->name('pembelian.postingbukubesar');
});
