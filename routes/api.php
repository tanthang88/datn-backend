<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistController;
use App\Http\Controllers\Api\PostController;
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

Route::prefix('information')->group(function () {
    Route::get('/city', [CityController::class, 'city']);
    Route::get('/dist/{city}', [DistController::class, 'dist']);
});

Route::prefix('client')->group(function () {
    Route::post('login', [LoginController::class, 'loginClient']);
    Route::post('register', [RegisterController::class, 'registerClient']);
    Route::middleware(['auth:user'])->group(function () {
        Route::post('logout', [LoginController::class, 'logoutClient']);
    });
});

Route::group(['prefix' => 'post'], function () {
    Route::get('/categories', [PostController::class, 'listCategories']);
    Route::get('/categories/{category}', [PostController::class, 'listPosts']);
    Route::get('/{post}', [PostController::class, 'show']);
});
