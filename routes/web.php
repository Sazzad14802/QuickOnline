<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Admin\SubscriptionController as AdminSubscriptionController;
use App\Http\Controllers\CustomerDashboardController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth','admin')->group(function(){
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/packages', [PackageController::class, 'index'])->name('admin.packages.index');
    Route::get('admin/packages/create', [PackageController::class, 'create'])->name('admin.packages.create');
    Route::post('admin/packages', [PackageController::class, 'store'])->name('admin.packages.store');
    Route::get('admin/packages/{id}/edit', [PackageController::class, 'edit'])->name('admin.packages.edit');
    Route::put('admin/packages/{id}', [PackageController::class, 'update'])->name('admin.packages.update');
    Route::delete('admin/packages/{id}', [PackageController::class, 'destroy'])->name('admin.packages.destroy');
    Route::get('admin/requests',[RequestController::class, 'index'])->name('admin.requests.index');
    Route::post('admin/requests/{request_id}/approve', [RequestController::class, 'approve'])->name('admin.requests.approve');
    Route::post('admin/requests/{request_id}/reject', [RequestController::class, 'reject'])->name('admin.requests.reject');
    Route::get('admin/subscriptions', [AdminSubscriptionController::class, 'index'])->name('admin.subscriptions.index');
    Route::delete('admin/subscriptions/{subscription_id}', [AdminSubscriptionController::class, 'remove'])->name('admin.subscriptions.remove');
    Route::get('admin/history', [HistoryController::class, 'index'])->name('admin.history.index');
});

Route::middleware('auth')->group(function(){
    Route::get('customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('customer/subscriptions', [SubscriptionController::class, 'index'])->name('customer.subscriptions.index');
    Route::get('customer/subscriptions/create', [SubscriptionController::class, 'create'])->name('customer.subscriptions.create');
    Route::post('customer/subscriptions', [SubscriptionController::class, 'store_new_request'])->name('customer.subscriptions.store_new_request');
    Route::get('customer/subscriptions/{subscription_id}/change', [SubscriptionController::class, 'change'])->name('customer.subscriptions.change');
    Route::post('customer/subscriptions/change', [SubscriptionController::class, 'store_change_request'])->name('customer.subscriptions.store_change_request');
    Route::post('customer/subscriptions/{subscription_id}', [SubscriptionController::class, 'destroy'])->name('customer.subscriptions.destroy');
});

require __DIR__.'/auth.php';
