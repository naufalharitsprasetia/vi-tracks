<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleOrderController;
use Illuminate\Support\Facades\Route;

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate')->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Orders
    Route::get('/orders', [VehicleOrderController::class, 'index'])->name('admin.orders');
    Route::get('/orders/new', [VehicleOrderController::class, 'create'])->name('admin.orders.create');
    Route::post('/orders/new', [VehicleOrderController::class, 'store'])->name('admin.orders.store');
    // Route::get('/orders/{id}', [VehicleOrderController::class, 'show'])->name('admin.orders.show');
    // Route::get('/orders/{id}/edit', [VehicleOrderController::class, 'edit'])->name('admin.orders.edit');

    // Reports
    Route::view('/reports', 'admin.reports')->name('admin.reports');

    // Drivers
    Route::get('/drivers', [DriverController::class, 'index'])->name('admin.drivers');
    Route::get('/drivers/new', [DriverController::class, 'create'])->name('admin.drivers.create');
    Route::post('/drivers', [DriverController::class, 'store'])->name('admin.drivers.store');

    // Vehicles
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('admin.vehicles');
    Route::get('/vehicles/new', [VehicleController::class, 'create'])->name('admin.vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('admin.vehicles.store');

    // Approver
    Route::view('/history-approver', 'approver.history')->name('approver.history');
    Route::view('/pending-approver', 'approver.pending')->name('approver.pending');
});
