<?php

use App\Http\Controllers\admin\C_DashboardAdmin;
use App\Http\Controllers\admin\data_akun\C_DataAkun;
use App\Http\Controllers\admin\data_jurnal\C_DataJurnal;
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
});
