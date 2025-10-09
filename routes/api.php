<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\BookingTransactionController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\HospitalSpecialistController;


// Route::get('/user', function (Request $request) { // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
//     return $request->user();
// })->middleware('auth:sanctum');

// aouth end poin
Route::post('token-login', [AuthController::class, 'tokenLogin']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// menu user dan logout berlaku untuk seluruh role
Route::middleware('auth:sanctum')->group(function () { // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('user', [AuthController::class, 'user']);
});

// 
Route::middleware('auth:sanctum', 'role:manager')->group(function () { // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
    // crud specialist
    Route::apiResource('specialists', SpecialistController::class);
    // crud dokter
    Route::apiResource('doctors', DoctorController::class);
    // crud rs
    Route::apiResource('hospitals', HospitalController::class);


    // tambah lepas spesialis ke rs
    Route::post('hospitals/{hospital}/specialists', [HospitalSpecialistController::class, 'attach']);
    Route::delete('hospitals/{hospital}/specialists/{specialist}', [HospitalSpecialistController::class, 'detach']);

    // lihat semua transaksi dan detail transaksi
    Route::apiResource('transactions', BookingTransactionController::class);
    // put = edit sebagaian besar data bahkans eluruh data pada tabel tertentu
    // Route::put('/transactions/{id}/status', [BookingTransactionController::class, 'updateStatus']);
    // patch = edit sebagaian kecil field mungkin 1 field seperti perubahan status
    // ubah status transaksi
    Route::patch('/transactions/{id}/status', [BookingTransactionController::class, 'updateStatus']);
});


// bisa diakses baik pelanggan maupun manager
Route::middleware(['auth:sanctum', 'role:customer|manager'])->group(function () {
    // bisa lihat daftar sepcialist beserta detailnya
    Route::get('specialists', [SpecialistController::class, 'index']);
    Route::get('specialists/{specialist}', [SpecialistController::class, 'show']);

    // bisa lihat daftar rs beserta detailnya
    Route::get('hospitals', [HospitalController::class, 'index']);
    Route::get('hospitals/{hospital}', [HospitalController::class, 'show']);

    // bisa lihat daftar dokter beserta detailnya
    Route::get('doctors', [DoctorController::class, 'index']);
    Route::get('doctors/{doctor}', [DoctorController::class, 'show']);
});


// hanya bisa diakses oleh pelanggan
Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
    // cari dokter by spesialis dan rs
    Route::get('/doctors-filter', [DoctorController::class, 'filterBySpecialistAndHospital']);
    // melihat daftar konsultasi dokter yg kosong
    Route::get('/doctors/{doctorId}/available-slots', [DoctorController::class, 'availableSlots']);

    // bisa meliha daftar pesanan, memesan dan melihat detail pesanan
    Route::get('my-orders', [MyOrderController::class, 'index']);
    Route::post('my-orders', [MyOrderController::class, 'store']);
    Route::get('my-orders/{id}', [MyOrderController::class, 'show']);
});