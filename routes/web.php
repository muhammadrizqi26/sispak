<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangAsetController;
use App\Http\Controllers\NonAlkesController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\Pemeliharaan\PanelListrikController;
use App\Http\Controllers\Pemeliharaan\AparController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\SumberDanaController;
use App\Http\Controllers\StatusProdukController;
use App\Http\Controllers\KondisiController;

// Route Guest (Hanya bisa diakses sebelum login)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

// Route Protected (Wajib Login dulu)
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('alkes', BarangAsetController::class);
    Route::get('alkes-export', [BarangAsetController::class, 'export'])->name('alkes.export');

    Route::resource('non-alkes', NonAlkesController::class);
    Route::get('non-alkes-export', [NonAlkesController::class, 'export'])->name('non-alkes.export');

    Route::get('units', [UnitController::class, 'index'])->name('units.index');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');

    // Route Registrasi Baru
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.post');
}); 


Route::middleware('auth')->group(function () {
    // ... Route sebelumnya ...
    Route::resource('pemeliharaan/panel-listrik', PanelListrikController::class)->names([
        'index' => 'panel-listrik.index',
        'create' => 'panel-listrik.create',
        'store' => 'panel-listrik.store',
    ]);
});

Route::middleware('auth')->group(function () {
    // ... route lain ...
    Route::resource('pemeliharaan/apar', AparController::class)->names([
        'index' => 'apar.index',
        'create' => 'apar.create',
        'store' => 'apar.store',
    ]);
});

Route::get('units', [UnitController::class, 'index'])->name('units.index');

    Route::middleware('auth')->group(function () {
Route::get('ruangs', [RuangController::class, 'index'])->name('ruangs.index');
});

    Route::middleware('auth')->group(function () {
Route::get('sumber-danas', [SumberDanaController::class, 'index'])->name('sumber-danas.index');
});



Route::resource('status-produks', StatusProdukController::class);
Route::resource('kondisis', KondisiController::class);