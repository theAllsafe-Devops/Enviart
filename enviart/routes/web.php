<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SReportController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Api\ForgotPasswordController;
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
Route::get('/', [AdminLoginController::class, 'login'])->name('login');
Route::post('makelogin', [AdminLoginController::class, 'makelogin']);
Route::get('reset/response', [ForgotPasswordController::class, 'sendResetResponse']);

Route::group(['middleware' => 'auth'], function(){
    Route::get('admin/dashboard', [AdminLoginController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::get('admin/profile', [AdminLoginController::class, 'profile'])->name('admin.profile');
    Route::post('admin/updateprofile', [AdminLoginController::class, 'updateprofile'])->name('admin.updateprofile');
    Route::post('admin/changepassword', [AdminLoginController::class, 'changepassword'])->name('admin.changepassword');
    Route::get('admin/forgot', [AdminLoginController::class, 'forgot'])->name('admin.forgot');
    Route::post('admin/forgot/password', [AdminLoginController::class, 'forgetpassword'])->name('admin.forgot.forgetpassword');
    Route::get('admin/settings', [AdminLoginController::class, 'settings'])->name('admin.settings');
    Route::post('admin/updateSettings', [AdminLoginController::class, 'updateSettings'])->name('admin.updateSettings');
    
    Route::get('admin/product', [ProductController::class, 'index']);
    Route::get('admin/getproduct', [ProductController::class, 'getproduct']);
    Route::get('admin/product/create', [ProductController::class, 'create']);
    Route::post('admin/product/store', [ProductController::class, 'store']);
    Route::get('admin/product/edit/{id}', [ProductController::class, 'edit']);
    Route::put('admin/product/update/{id}', [ProductController::class, 'update']);
    Route::get('admin/product/destroy/{id}', [ProductController::class, 'destroy']);
    Route::post('admin/product/status', [ProductController::class, 'status']);
    
    Route::get('admin/bill', [BillController::class, 'index'])->name('admin.bill');
    Route::get('admin/bill/create', [BillController::class, 'create']);
    Route::post('admin/bill/store', [BillController::class, 'store']);
    Route::get('admin/bill/edit/{id}', [BillController::class, 'edit']);
    Route::put('admin/bill/update/{id}', [BillController::class, 'update']);
    Route::get('admin/bill/destroy/{id}', [BillController::class, 'destroy']);
    Route::get('admin/bill/getDesignation', [BillController::class, 'getDesignation']);
    Route::get('admin/bill/getDesignation1', [BillController::class, 'getDesignation1']);
    
    Route::get('admin/customer', [CustomerController::class, 'index']);
    Route::get('admin/customer/create', [CustomerController::class, 'create']);
    Route::post('admin/customer/store', [CustomerController::class, 'store']);
    Route::get('admin/customer/edit/{id}', [CustomerController::class, 'edit']);
    Route::put('admin/customer/update/{id}', [CustomerController::class, 'update']);
    Route::get('admin/customer/destroy/{id}', [CustomerController::class, 'destroy']);
    
    Route::get('admin/tax', [TaxController::class, 'index']);
    Route::get('admin/tax/create', [TaxController::class, 'create']);
    Route::post('admin/tax/store', [TaxController::class, 'store']);
    Route::get('admin/tax/edit/{id}', [TaxController::class, 'edit']);
    Route::put('admin/tax/update/{id}', [TaxController::class, 'update']);
    Route::get('admin/tax/destroy/{id}', [TaxController::class, 'destroy']);
    
    Route::get('admin/report', [ReportController::class, 'index']);
    Route::get('admin/sreport', [SReportController::class, 'index']);

    Route::get('admin/user', [AdminLoginController::class, 'index']);
    Route::get('admin/user/create', [AdminLoginController::class, 'create']);
    Route::post('admin/user/store', [AdminLoginController::class, 'store']);
    Route::get('admin/user/edit/{id}', [AdminLoginController::class, 'edit']);
    Route::put('admin/user/update/{id}', [AdminLoginController::class, 'update']);
    Route::get('admin/user/destroy/{id}', [AdminLoginController::class, 'destroy']);
});
Route::get('admin/invoice/{id}', [BillController::class, 'invoice']);
Route::get('admin/bill/{id}', [BillController::class, 'bill']);
Route::get('admin/gstreport', [ReportController::class, 'report']);
Route::get('admin/salereport', [SReportController::class, 'report']);