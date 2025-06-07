<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Web\ReviewController;
use App\Http\Controllers\Admin\ArtisanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\Ecommerce\ProductController;
use App\Http\Controllers\Artisan\ArtisanDashboardController;
use App\Http\Controllers\Admin\Ecommerce\ProductSizeController;
use App\Http\Controllers\Admin\Ecommerce\ProductImageController;
use App\Http\Controllers\Admin\Ecommerce\ProductCategoryController;

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
    return redirect()->route('auth.admin.login');
});
Route::get('/login', [AuthController::class, 'loginView'])->name('auth.admin.login');
Route::post('/login/save', [AuthController::class, 'login'])->name('auth.admin.login.save');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::group(['prefix' => 'dashboard', 'middleware' => 'admin'], function () {
    Route::get('/index', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Product Routes
     Route::resource('products', ProductController::class);
     Route::resource('categories', ProductCategoryController::class);
     Route::resource('sizes', ProductSizeController::class);
     Route::resource('product-images', ProductImageController::class);

});






// Route::middleware('role:admin')->group(function () {
//     // Routes only accessible to admins
// });
