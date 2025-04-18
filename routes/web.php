<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', function () {
    return view('layout.landingpage');
});

// Auth routes
Route::prefix('auth')->group(function () {
    Route::get('/register', [AuthController::class, "registerPage"]);
    Route::get('/login', [AuthController::class, "loginPage"]);
    Route::post('/register', [AuthController::class, "register"]);
    Route::post('/login', [AuthController::class, "login"]);
    Route::post('/logout', [AuthController::class, "logout"])->middleware('auth');
});

// Dokter routes
Route::prefix('dokter')->middleware('role:dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.index');
    })->name('dokter.dashboard');

    // Obat routes
    Route::prefix('obat')->group(function () {
        Route::get('/', [ObatController::class, "index"]);
        Route::get('/create', [ObatController::class, "create"]);
        Route::post('/', [ObatController::class, "store"]);
        Route::get('/{id}/edit', [ObatController::class, "edit"]);
        Route::put('/{id}', [ObatController::class, "update"]);
        Route::delete('/{id}', [ObatController::class, "destroy"]);
    });

    // Memeriksa routes
    Route::prefix('memeriksa')->group(function () {
        Route::get('/', [MemeriksaController::class, "index"]);
        Route::get('/{id}', [MemeriksaController::class, "memeriksa"]);
        Route::post('/', [MemeriksaController::class, "store"]);
        Route::get('/{id}/edit', [MemeriksaController::class, "edit"]);
        Route::put('/{id}', [MemeriksaController::class, "update"]);
    });
});

// Pasien routes
Route::prefix('pasien')->middleware('role:pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.index');
    })->name('pasien.dashboard');

    // Periksa routes
    Route::prefix('periksa')->group(function () {
        Route::get('/', [PeriksaController::class, "index"]);
        Route::get('/create', [PeriksaController::class, "create"]);
        Route::post('/', [PeriksaController::class, "store"]);
    });
});