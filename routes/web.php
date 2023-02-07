<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes();
Route::get('/', [HomeController::class, 'index']);

Route::get('login', [LoginController::class, "showLoginForm"])->name('login');
Route::post('login', [LoginController::class, "login"]);
Route::post('logout', [LoginController::class, "logout"])->name('logout');

Route::get('password/reset', [ForgotPasswordController::class, "showLinkRequestForm"])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, "sendResetLinkEmail"])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, "showResetForm"])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, "reset"])->name('password.update');