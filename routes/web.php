<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.landingpage');
});


Route::get('/auth/register', [AuthController::class, "registerPage"]);
Route::get('/auth/login', [AuthController::class, "loginPage"]);
Route::post('/auth/register', [AuthController::class, "register"]);
Route::post('/auth/login', [AuthController::class, "login"]);
Route::post('/auth/logout', [AuthController::class, "logout"])->middleware('auth');


Route::get('/dokter/dashboard', function () {
    return view('dokter.index');
})->name('dokter.dashboard')->middleware('role:dokter');
Route::get('/dokter/obat', [ObatController::class, "index"])->middleware('role:dokter');
Route::get('/dokter/obat/create', [ObatController::class, "create"])->middleware('role:dokter');
Route::post('/dokter/obat', [ObatController::class, "store"])->middleware('role:dokter');
Route::get('/dokter/obat/{id}/edit', [ObatController::class, "edit"])->middleware('role:dokter');
Route::put('/dokter/obat/{id}', [ObatController::class, "update"])->middleware('role:dokter');
Route::delete('/dokter/obat/{id}', [ObatController::class, "destroy"])->middleware('role:dokter');
Route::get('/dokter/memeriksa', [MemeriksaController::class, "index"])->middleware('role:dokter');
Route::get('/dokter/memeriksa/{id}', [MemeriksaController::class, "memeriksa"])->middleware('role:dokter');
Route::post('/dokter/memeriksa', [MemeriksaController::class, "store"])->middleware('role:dokter');
Route::get('/dokter/memeriksa/{id}/edit', [MemeriksaController::class, "edit"])->middleware('role:dokter');
Route::put('/dokter/memeriksa/{id}', [MemeriksaController::class, "update"])->middleware('role:dokter');


Route::get('/pasien/dashboard', function () {
    return view('pasien.index');
})->name('pasien.dashboard')->middleware('role:pasien');
Route::get('/pasien/periksa', [PeriksaController::class, "index"])->middleware('role:pasien');
Route::get('/pasien/periksa/create', [PeriksaController::class, "create"])->middleware('role:pasien');
Route::post('/pasien/periksa', [PeriksaController::class, "store"])->middleware('role:pasien');