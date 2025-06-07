<?php

use App\Http\Controllers\Vendor\AuthController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\Ecommerce\ProductController;
use App\Http\Controllers\Vendor\Ecommerce\ProductSizeController;
use App\Http\Controllers\Vendor\Ecommerce\ProductImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('auth.vendor.login');
});
Route::get('/login', [AuthController::class, 'loginView'])->name('auth.vendor.login');
Route::get('/register', [AuthController::class, 'registerView'])->name('auth.vendor.register');
// otp screen
Route::get('/otp/verify', [AuthController::class, 'otpView'])->name('auth.vendor.otp');
Route::post('/otp/verify/resend', [AuthController::class, 'resendOtp'])->name('auth.vendor.otp.resend');
Route::post('/otp/verify/save', [AuthController::class, 'verifyOtp'])->name('auth.vendor.otp.save');
Route::post('/login/save', [AuthController::class, 'login'])->name('auth.vendor.login.save');
Route::post('/register/save', [AuthController::class, 'register'])->name('auth.vendor.register.save');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::group(['prefix' => 'vendor', 'middleware' => 'vendor'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('vendor.dashboard');
    // Product Routes
     Route::resource('products', ProductController::class);
     Route::resource('sizes', ProductSizeController::class);
     Route::resource('product-images', ProductImageController::class);

});






// Route::middleware('role:admin')->group(function () {
//     // Routes only accessible to admins
// });
