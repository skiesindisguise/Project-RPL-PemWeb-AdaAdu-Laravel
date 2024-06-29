<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->middleware(['auth', 'user', 'can:isUser', 'verified'])->name('user.dashboard');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth', 'admin', 'can:isAdmin', 'verified'])->name('admin.dashboard');

Route::get('/admin/reportdetails/{id}', [AdminDashboardController::class, 'show'])->middleware(['auth', 'admin', 'can:isAdmin', 'verified'])->name('report.details');

Route::post('/admin/reportdetails/update/{id}', [AdminDashboardController::class, 'update'])->middleware(['auth', 'admin', 'can:isAdmin', 'verified'])->name('report.update');

Route::get('/admin/reportdetails-umum/{id}', [AdminDashboardController::class, 'showUmum'])->middleware(['auth', 'admin', 'can:isAdmin', 'verified'])->name('report.details.umum');

Route::resource('/reports', ReportController::class);

// Tambahkan route ini di web.php
Route::get('/admin/viewreport', function () {
    $reports = \App\Models\Report::all(); // Sesuaikan dengan logika untuk mendapatkan laporan
    return view('admin/view-report', compact('reports'));
})->middleware(['auth', 'admin', 'can:isAdmin', 'verified'])->name('admin.viewreport');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';