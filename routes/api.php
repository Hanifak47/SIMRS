<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\BookingTransactionController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\HospitalSpecialistController;


Route::get('/user', function (Request $request) { // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('specialists', SpecialistController::class);
Route::apiResource('doctors', DoctorController::class);
Route::apiResource('hospitals', HospitalController::class);

Route::get('/doctors-filter', [DoctorController::class, 'filterBySpecialistAndHospital']);
Route::get('/doctors/{doctorId}/available-slots', [DoctorController::class, 'availableSlots']);

Route::post('hospitals/{hospital}/specialists', [HospitalSpecialistController::class, 'attach']);
Route::delete('hospitals/{hospital}/specialists/{specialist}', [HospitalSpecialistController::class, 'detach']);


Route::apiResource('transactions', BookingTransactionController::class);
// put = edit sebagaian besar data bahkans eluruh data pada tabel tertentu
// Route::put('/transactions/{id}/status', [BookingTransactionController::class, 'updateStatus']);
// patch = edit sebagaian kecil field mungkin 1 field seperti perubahan status
Route::patch('/transactions/{id}/status', [BookingTransactionController::class, 'updateStatus']);


// periksa data transaksi user
Route::get('my-orders', [MyOrderController::class, 'index']);
Route::post('my-orders', [MyOrderController::class, 'store']);
Route::get('my-orders/{id}', [MyOrderController::class, 'show']);



// Route::get()
// filter dokter yg terseida dari spesialisasinya dan rumah sakit
Route::get('/doctor-filter', [DoctorController::class, 'filterBySpecialistAndHospital']);
Route::get('/doctors/{doctorId}/available-slots', [DoctorController::class, 'availableSlots']);
