<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('client')->group(function () {
    Route::post('login', [LoginController::class, 'loginClient']);
    Route::post('register', [RegisterController::class, 'registerClient']);
    Route::middleware(['auth:user'])->group(function () {
        Route::post('logout', [LoginController::class, 'logoutClient']);
    });
});
