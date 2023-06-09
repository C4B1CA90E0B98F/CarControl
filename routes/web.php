<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:Approver')->group(function () {
        Route::get('/{id}/edit', [DashboardController::class, 'edit'])->name('approval.edit');
        Route::post('/{id}/edit', [DashboardController::class, 'update'])->name('approval.update');

        Route::get('/{id}/approve', [DashboardController::class, 'approve'])->name('approval.approve');
        Route::get('/{id}/reject', [DashboardController::class, 'reject'])->name('approval.reject');
    });

    Route::middleware('role:Admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', function () {
                return redirect()->route('dashboard');
            });

            Route::prefix('user')->as('user.')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');

                Route::get('/create', [UserController::class, 'create'])->name('create');
                Route::post('/create', [UserController::class, 'store'])->name('store');

                Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
                Route::post('/{id}/edit', [UserController::class, 'update'])->name('update');

                Route::get('/{id}/delete', [UserController::class, 'destroy'])->name('destroy');

                Route::prefix('driver')->as('driver.')->group(function () {
                    Route::get('/', [DriverController::class, 'index'])->name('index');

                    Route::get('/create', [DriverController::class, 'create'])->name('create');
                    Route::post('/create', [DriverController::class, 'store'])->name('store');

                    Route::get('/{id}/edit', [DriverController::class, 'edit'])->name('edit');
                    Route::post('/{id}/edit', [DriverController::class, 'update'])->name('update');

                    Route::get('/{id}/delete', [DriverController::class, 'destroy'])->name('destroy');
                });
            });

            Route::prefix('kendaraan')->as('kendaraan.')->group(function () {
                Route::get('/', [VehicleController::class, 'index'])->name('index');
                Route::get('/{id}/show', [VehicleController::class, 'show'])->name('show');

                Route::get('/create', [VehicleController::class, 'create'])->name('create');
                Route::post('/create', [VehicleController::class, 'store'])->name('store');

                Route::get('/{id}/edit', [VehicleController::class, 'edit'])->name('edit');
                Route::post('/{id}/edit', [VehicleController::class, 'update'])->name('update');

                Route::get('/{id}/delete', [VehicleController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('lokasi')->as('lokasi.')->group(function () {
                Route::get('/', [LocationController::class, 'index'])->name('index');

                Route::get('/create', [LocationController::class, 'create'])->name('create');
                Route::post('/create', [LocationController::class, 'store'])->name('store');

                Route::get('/{id}/edit', [LocationController::class, 'edit'])->name('edit');
                Route::post('/{id}/edit', [LocationController::class, 'update'])->name('update');

                Route::get('/{id}/delete', [LocationController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('pesanan')->as('pesanan.')->group(function () {
                Route::get('/', [BookingController::class, 'index'])->name('index');
                Route::get('/export', [BookingController::class, 'export'])->name('export');

                Route::get('/create', [BookingController::class, 'create'])->name('create');
                Route::post('/create', [BookingController::class, 'store'])->name('store');

                Route::get('/{id}/edit', [BookingController::class, 'edit'])->name('edit');
                Route::post('/{id}/edit', [BookingController::class, 'update'])->name('update');

                Route::get('/{id}/delete', [BookingController::class, 'destroy'])->name('destroy');
            });
        });
    });
});
