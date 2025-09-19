<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    UserController,
    ClinicController,
    PatientController,
    DoctorController,
    AppointmentController,
    AttendanceController,
    PaymentController,
    InvoiceController,
    MedicalRecordController,
    MedicineController,
    MedicineUsageController
};

// Test user
Route::get('/user', fn(Request $request) => $request->user())->middleware('auth:sanctum');

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);

// Users (Admin only)
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('users', UserController::class);
    });

// Clinic Modules
    Route::apiResource('clinics', ClinicController::class);
    Route::apiResource('patients', PatientController::class);
    Route::apiResource('doctors', DoctorController::class);
    Route::apiResource('appointments', AppointmentController::class);
    Route::apiResource('attendances', AttendanceController::class);
    Route::apiResource('payments', PaymentController::class);
    Route::apiResource('invoices', InvoiceController::class);
    Route::apiResource('medical-records', MedicalRecordController::class);
    Route::apiResource('medicines', MedicineController::class);
    Route::apiResource('medicine-usage', MedicineUsageController::class);
});
