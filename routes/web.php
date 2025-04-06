<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LicenseTemplateController;

Route::get('/', fn () => redirect()->route('dashboard'));
Route::get('/dashbaord/total-imageFx-request-today', [DashboardController::class, 'getTotalImageFxRequestToday'])->middleware('auth')->name('dashboard.total-imageFx-request-today');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::resource('licenses', LicenseController::class)->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('tokens', TokenController::class)->middleware('auth');
Route::resource('license-templates', LicenseTemplateController::class)->middleware('auth');
