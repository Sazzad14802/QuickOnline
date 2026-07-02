<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PackageController;

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
});

Route::middleware('auth')->group(function(){
    Route::get('admin/dashboard', function () {return view('admin.dashboard');})->name('admin.dashboard');
    Route::get('admin/packages', [PackageController::class, 'index'])->name('admin.packages.index');
    Route::get('admin/packages/create', [PackageController::class, 'create'])->name('admin.packages.create');
    Route::post('admin/packages', [PackageController::class, 'store'])->name('admin.packages.store');
    Route::get('admin/packages/{id}/edit', [PackageController::class, 'edit'])->name('admin.packages.edit');
    Route::put('admin/packages/{id}', [PackageController::class, 'update'])->name('admin.packages.update');
    Route::delete('admin/packages/{id}', [PackageController::class, 'destroy'])->name('admin.packages.destroy');
});

require __DIR__.'/auth.php';
