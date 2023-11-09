<?php

use App\Http\Controllers\admin\C_DashboardAdmin;
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

Route::middleware(['auth', 'loginAkses:admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [C_DashboardAdmin::class, 'index'])->name('admin.dashboard');
});
