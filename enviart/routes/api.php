<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\RecordController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('App/signin', [AuthController::class, 'signin']);
// Route::post('App/otpVerification', [AuthController::class, 'otp_verification']);
// Route::post('App/forget', [AuthController::class, 'forget']);
// Route::post('App/resetPassword', [AuthController::class, 'change_password']);
Route::post('App/forget', [ForgotPasswordController::class, 'forgot']);
Route::get('App/reset', [ForgotPasswordController::class, 'sendReset'])->name('password.reset');

Route::get('App/profiledata/{id}', [AuthController::class, 'profiledata']);
Route::post('App/profile/update', [AuthController::class, 'update_profile']);
Route::post('App/storeCall', [AuthController::class, 'store_call_recording']);

Route::get('App/fatchnumber/{id}', [RecordController::class, 'fatchnumber']);

Route::post('App/forget', [ForgotPasswordController::class, 'forgot']);
Route::get('App/reset', [ForgotPasswordController::class, 'sendReset'])->name('password.reset');

Route::get('App/logout', [AuthController::class, 'logout']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
