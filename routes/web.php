<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingsController;

// Trang chủ → redirect về quản lý giao dịch
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Trang dashboard (nếu có)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Các route cần login
Route::middleware('auth')->group(function () {
    // Quản lý profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   // Nhập số dư 
Route::get('/products/balance', [SettingsController::class, 'editBalance'])->name('products.balance');
Route::post('/products/balance', [SettingsController::class, 'updateBalance']);
    // Quản lý giao dịch
    Route::resource('products', ProductController::class);

    // Quản lý danh mục
    Route::resource('categories', CategoryController::class)->except(['show']);


});
Route::get('/lang-check', function () {
    return __('auth.failed');
});
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')->name('password.update');


// Auth route (login, register, ...)
require __DIR__.'/auth.php';
