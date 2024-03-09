<?php

use Illuminate\Http\Request;
use App\Models\FingerprintStatus;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FingerprintModulController;
use App\Http\Controllers\FingerprintStatusController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::controller(FingerprintStatusController::class)->group(function () {
//     Route::post('/fingerprint-status', 'status')->name("fingerprint.status");
//     Route::post('/save-id', 'saveID')->name("fingerprint.save_id");
//     Route::post('/finger-status/update-status', 'updateStatus')->name("fingerprint.update_status");
// });
Route::controller(FingerprintModulController::class)->group(function () {
    Route::post('/fingerprint-status', 'statusFingerprint')->name("fingerprint.status");
    Route::post('/save-id', 'saveID')->name("fingerprint.save_id");
    Route::post('/absen', 'absen')->name("fingerprint.absen");
    Route::post('/deleted-status', 'deletedStatus');
    // Route::post('/finger-status/update-status', 'updateStatus')->name("fingerprint.update_status");
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});