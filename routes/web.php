<?php

use App\Http\Controllers\C_Login;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [Controller_Login::class, 'index']);
    Route::post('/', [Controller_Login::class, 'login']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', [C_Login::class, 'index']);
    Route::post('/', [C_Login::class, 'login']);
});
