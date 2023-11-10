<?php

use App\Http\Controllers\admin\C_DashboardAdmin;
use App\Http\Controllers\admin\data_akun\C_DataAkun;
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
});
