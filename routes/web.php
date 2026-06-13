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

/*
|--------------------------------------------------------------------------
| Route Setelah Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

});

Route::middleware(['auth', 'role:panitia'])->group(function () {

    Route::get('/panitia/dashboard', [PanitiaDashboardController::class, 'index'])
        ->name('panitia.dashboard');

    Route::resource('events', EventController::class);

});

Route::middleware(['auth', 'role:perusahaan'])->group(function () {

    Route::get('/perusahaan/dashboard', [PerusahaanDashboardController::class, 'index'])
        ->name('perusahaan.dashboard');

});

require __DIR__.'/auth.php';