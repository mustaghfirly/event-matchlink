<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Panitia\DashboardController as PanitiaDashboardController;
use App\Http\Controllers\Perusahaan\DashboardController as PerusahaanDashboardController;
use App\Http\Controllers\Panitia\EventController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Dashboard Panitia
    Route::get('/panitia/dashboard', [PanitiaDashboardController::class, 'index'])
        ->name('panitia.dashboard');

    // Dashboard Perusahaan
    Route::get('/perusahaan/dashboard', [PerusahaanDashboardController::class, 'index'])
        ->name('perusahaan.dashboard');

    Route::resource('events', EventController::class);

});

require __DIR__.'/auth.php';