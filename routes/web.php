<?php

use App\Http\Controllers\ApprovalController;
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
    // Reports
    Route::get('/reports', [DashboardController::class, 'reports'])->name('admin.reports');
    // Logs
    Route::get('/logs', [DashboardController::class, 'logs'])->name('admin.logs');

    // Orders
    Route::get('/orders', [VehicleOrderController::class, 'index'])->name('admin.orders');
    Route::get('/orders/new', [VehicleOrderController::class, 'create'])->name('admin.orders.create');
    Route::post('/orders/new', [VehicleOrderController::class, 'store'])->name('admin.orders.store');
    Route::get('/orders/{id}', [VehicleOrderController::class, 'show'])->name('admin.orders.show');
    // Route::get('/orders/{id}/edit', [VehicleOrderController::class, 'edit'])->name('admin.orders.edit');

    // Drivers
    Route::get('/drivers', [DriverController::class, 'index'])->name('admin.drivers');
    Route::get('/drivers/new', [DriverController::class, 'create'])->name('admin.drivers.create');
    Route::post('/drivers', [DriverController::class, 'store'])->name('admin.drivers.store');

    // Vehicles
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('admin.vehicles');
    Route::get('/vehicles/new', [VehicleController::class, 'create'])->name('admin.vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('admin.vehicles.store');

    // Approver
    Route::get('/pending-approver', [ApprovalController::class, 'pendingApprovals'])->name('approver.pending');
    Route::get('/history-approver', [ApprovalController::class, 'historyApprovals'])->name('approver.history');
    Route::post('/approval-approve/{approval}', [ApprovalController::class, 'approve'])
        ->name('approval.approve');

    Route::post('/approval-reject/{approval}', [ApprovalController::class, 'reject'])
        ->name('approval.reject');
});
