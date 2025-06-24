<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'role:super admin'])->group(function () {
    Route::get('/superadmin/dashboard', fn() => view('superadmin.dashboard'))->name('superadmin.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
});

Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', fn() => view('doctor.dashboard'))->name('doctor.dashboard');
});


Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', fn() => view('patient.dashboard'))->name('patient.dashboard');
});

Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', fn() => view('staff.dashboard'))->name('staff.dashboard');
});


require __DIR__.'/auth.php';
