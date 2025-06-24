<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarPoliController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\MemeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\RiwayatPeriksaController;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', function () {
    return view('layout.landingpage');
});

// Pasien routes
Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    // Obat routes
    Route::prefix('obat')->group(function () {
        Route::get('/', [ObatController::class, "index"]);
        Route::get('/create', [ObatController::class, "create"]);
        Route::post('/', [ObatController::class, "store"]);
        Route::get('/{id}/edit', [ObatController::class, "edit"]);
        Route::put('/{id}', [ObatController::class, "update"]);
        Route::delete('/{id}', [ObatController::class, "destroy"]);
    });

    // Dokter routes
    Route::prefix('dokter')->group(function () {
        Route::get('/', [DokterController::class, "index"]);
        Route::get('/create', [DokterController::class, "create"]);
        Route::post('/', [DokterController::class, "store"]);
        Route::get('/{id}/edit', [DokterController::class, "edit"]);
        Route::put('/{id}', [DokterController::class, "update"]);
        Route::delete('/{id}', [DokterController::class, "destroy"]);
    });

    // Poli routes
    Route::prefix('poli')->name('admin.poli.')->group(function () {
        Route::get('/', [PoliController::class, "index"])->name('index');
        Route::get('/create', [PoliController::class, "create"])->name('create');
        Route::post('/', [PoliController::class, "store"])->name('store');
        Route::get('/{poli}/edit', [PoliController::class, "edit"])->name('edit');
        Route::put('/{poli}', [PoliController::class, "update"])->name('update');
        Route::delete('/{poli}', [PoliController::class, "destroy"])->name('destroy');
    });

    // Pasien routes
    Route::prefix('pasien')->name('admin.pasien.')->group(function () {
        Route::get('/', [PasienController::class, "index"])->name('index');
        Route::get('/create', [PasienController::class, "create"])->name('create');
        Route::post('/', [PasienController::class, "store"])->name('store');
        Route::get('/{pasien}/edit', [PasienController::class, "edit"])->name('edit');
        Route::put('/{pasien}', [PasienController::class, "update"])->name('update');
        Route::delete('/{pasien}', [PasienController::class, "destroy"])->name('destroy');
    });
    
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

    // Profile routes
    Route::get('/profile/edit', [DokterController::class, "editProfile"])->name('dokter.profile.edit');
    Route::put('/profile', [DokterController::class, "updateProfile"])->name('dokter.profile.update');

    // Jadwal Periksa routes
    Route::prefix('jadwal-periksa')->name('dokter.jadwalPeriksa.')->group(function () {
        Route::get('/', [JadwalPeriksaController::class, "index"])->name('index');
        Route::get('/create', [JadwalPeriksaController::class, "create"])->name('create');
        Route::post('/', [JadwalPeriksaController::class, "store"])->name('store');
        Route::put('/{id}', [JadwalPeriksaController::class, "update"])->name('update');
    });

    // Memeriksa routes
    Route::prefix('memeriksa')->name('dokter.memeriksa.')->group(function () {
        Route::get('/', [MemeriksaController::class, "index"])->name('index');
        Route::get('/{id}/create', [MemeriksaController::class, "create"])->name('create');
        Route::post('/', [MemeriksaController::class, "store"])->name('store');
        Route::get('/history', [MemeriksaController::class, "history"])->name('history');
        Route::get('/{id}/detail', [MemeriksaController::class, "detail"])->name('detail');
    });
});

// Pasien routes
Route::prefix('pasien')->middleware('role:pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.index');
    })->name('pasien.dashboard');

    // Daftar Poli / Janji Periksa routes
    Route::prefix('daftar-poli')->name('pasien.daftar-poli.')->group(function () {
        Route::get('/', [DaftarPoliController::class, "index"])->name('index');
        Route::post('/', [DaftarPoliController::class, "store"])->name('store');
    });

    // Riwayat Periksa routes
    Route::prefix('riwayat-periksa')->name('pasien.riwayat-periksa.')->group(function () {
        Route::get('/', [RiwayatPeriksaController::class, "index"])->name('index');
        Route::get('/{id}/detail', [RiwayatPeriksaController::class, "detail"])->name('detail');
        Route::get('/{id}/riwayat', [RiwayatPeriksaController::class, "riwayat"])->name('riwayat');
    });
});