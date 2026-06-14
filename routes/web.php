<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Panitia\DashboardController as PanitiaDashboardController;
use App\Http\Controllers\Perusahaan\DashboardController as PerusahaanDashboardController;
use App\Http\Controllers\Perusahaan\CompanyController;
use App\Http\Controllers\Perusahaan\EventController as PerusahaanEventController;
use App\Http\Controllers\Perusahaan\SponsorshipController as PerusahaanSponsorshipController;
use App\Http\Controllers\Panitia\EventController;
use App\Http\Controllers\Panitia\CompanyController as PanitiaCompanyController;
use App\Http\Controllers\Panitia\SponsorshipController as PanitiaSponsorshipController;
use App\Http\Controllers\Panitia\MessageController as PanitiaMessageController;
use App\Http\Controllers\Perusahaan\MessageController as PerusahaanMessageController;
use App\Http\Controllers\NotificationController;

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

    Route::get('/notifications', [NotificationController::class, 'unread'])->name('notifications.unread');

});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    Route::prefix('users')->name('users.')->group(function () {

        Route::get('/', [AdminUserController::class, 'index'])
            ->name('index');

        Route::get('/create', [AdminUserController::class, 'create'])
            ->name('create');

        Route::post('/', [AdminUserController::class, 'store'])
            ->name('store');

        Route::get('/{user}/edit', [AdminUserController::class, 'edit'])
            ->name('edit');

        Route::put('/{user}', [AdminUserController::class, 'update'])
            ->name('update');

        Route::delete('/{user}', [AdminUserController::class, 'destroy'])
            ->name('destroy');

    });

    Route::prefix('events')->name('events.')->group(function () {

        Route::get('/', [AdminEventController::class, 'index'])
            ->name('index');

        Route::get('/{event}', [AdminEventController::class, 'show'])
            ->name('show');

        Route::patch('/{event}/approve', [AdminEventController::class, 'approve'])
            ->name('approve');

        Route::patch('/{event}/reject', [AdminEventController::class, 'reject'])
            ->name('reject');

        Route::delete('/{event}', [AdminEventController::class, 'destroy'])
            ->name('destroy');

    });

});

Route::middleware(['role:panitia'])->group(function () {

    Route::get('/panitia/dashboard', [PanitiaDashboardController::class, 'index'])
        ->name('panitia.dashboard');

    Route::resource('events', EventController::class);

    Route::prefix('panitia/companies')->name('panitia.companies.')->group(function () {

        Route::get('/', [PanitiaCompanyController::class, 'index'])
            ->name('index');

        Route::get('/{company}', [PanitiaCompanyController::class, 'show'])
            ->name('show');

    });

    Route::prefix('panitia/sponsorships')->name('panitia.sponsorships.')->group(function () {

        Route::get('/', [PanitiaSponsorshipController::class, 'index'])
            ->name('index');

        Route::post('/{company}', [PanitiaSponsorshipController::class, 'store'])
            ->name('store');

    });

    Route::prefix('panitia/messages')->name('panitia.messages.')->group(function () {

        Route::get('/', [PanitiaMessageController::class, 'index'])
            ->name('index');

        Route::get('/{sponsorship}/poll', [PanitiaMessageController::class, 'poll'])
            ->name('poll');

        Route::get('/{sponsorship}', [PanitiaMessageController::class, 'show'])
            ->name('show');

        Route::post('/{sponsorship}', [PanitiaMessageController::class, 'store'])
            ->name('store');

    });

});

Route::middleware(['role:perusahaan'])->group(function () {

    Route::get('/perusahaan/dashboard', [PerusahaanDashboardController::class, 'index'])
        ->name('perusahaan.dashboard');

    Route::prefix('perusahaan/company')->name('perusahaan.company.')->group(function () {

        Route::get('/', [CompanyController::class, 'index'])
            ->name('index');

        Route::get('/create', [CompanyController::class, 'create'])
            ->name('create');

        Route::post('/', [CompanyController::class, 'store'])
            ->name('store');

        Route::get('/edit', [CompanyController::class, 'edit'])
            ->name('edit');

        Route::put('/', [CompanyController::class, 'update'])
            ->name('update');

    });

    Route::get('/perusahaan/events/{event}', [PerusahaanEventController::class, 'show'])
        ->name('perusahaan.events.show');

    Route::prefix('perusahaan/sponsorships')->name('perusahaan.sponsorships.')->group(function () {

        Route::get('/', [PerusahaanSponsorshipController::class, 'index'])
            ->name('index');

        Route::patch('/{sponsorship}/approve', [PerusahaanSponsorshipController::class, 'approve'])
            ->name('approve');

        Route::patch('/{sponsorship}/reject', [PerusahaanSponsorshipController::class, 'reject'])
            ->name('reject');

    });

    Route::prefix('perusahaan/messages')->name('perusahaan.messages.')->group(function () {

        Route::get('/', [PerusahaanMessageController::class, 'index'])
            ->name('index');

        Route::get('/{sponsorship}/poll', [PerusahaanMessageController::class, 'poll'])
            ->name('poll');

        Route::get('/{sponsorship}', [PerusahaanMessageController::class, 'show'])
            ->name('show');

        Route::post('/{sponsorship}', [PerusahaanMessageController::class, 'store'])
            ->name('store');

    });

});

require __DIR__.'/auth.php';
