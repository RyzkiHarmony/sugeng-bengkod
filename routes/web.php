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
Route::get('/dokter/obat/create', [ObatController::class, "create"]);
Route::post('/dokter/obat', [ObatController::class, "store"]);
Route::get('/dokter/obat/{id}/edit', [ObatController::class, "edit"]);
Route::put('/dokter/obat/{id}', [ObatController::class, "update"]);
Route::delete('/dokter/obat/{id}', [ObatController::class, "destroy"]);


Route::get('/dokter/memeriksa', [MemeriksaController::class, "index"]);
Route::get('/dokter/memeriksa/{id}', [MemeriksaController::class, "memeriksa"]);
Route::post('/dokter/memeriksa', [MemeriksaController::class, "store"]);
Route::get('/dokter/memeriksa/{id}/edit', [MemeriksaController::class, "edit"]);
Route::put('/dokter/memeriksa/{id}', [MemeriksaController::class, "update"]);


Route::get('/pasien/dashboard', function () {
    return view('pasien.index');
});

Route::get('/pasien/periksa', [PeriksaController::class, "index"]);
Route::get('/pasien/periksa/create', [PeriksaController::class, "create"]);
Route::post('/pasien/periksa', [PeriksaController::class, "store"]);