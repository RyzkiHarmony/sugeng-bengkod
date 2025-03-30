<?php

use App\Http\Controllers\MemeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.landingpage');
});

Route::get('/auth/login', function () {
    return view('auth.login');
});

Route::get('/auth/register', function () {
    return view('auth.register');
});


Route::get('/dokter/dashboard', function () {
    return view('dokter.index');
});

Route::get('/dokter/obat', [ObatController::class, "index"]);

Route::get('/dokter/memeriksa', [MemeriksaController::class, "index"]);

Route::get('/pasien/dashboard', function () {
    return view('pasien.index');
});

Route::get('/pasien/periksa', [PeriksaController::class, "index"]);