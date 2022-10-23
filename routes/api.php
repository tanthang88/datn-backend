<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ProductCommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

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
        Route::group(['prefix' => 'bills'], function () {
            Route::get('/', [BillController::class, 'index']);
            Route::get('/{bill}', [BillController::class, 'show']);
            Route::post('/add_to_bill', [BillController::class, 'create']);
        });
    });
});

Route::group(['prefix' => 'post'], function () {
    Route::get('/categories', [PostController::class, 'listCategories']);
    Route::get('/categories/{category}', [PostController::class, 'listPosts']);
    Route::get('/{post}', [PostController::class, 'show']);
});

 Route::get('/company', [CompanyController::class, 'company']);

 Route::group(['prefix' => 'about'], function () {
    Route::get('/', [AboutController::class, 'listAbouts']);
    Route::get('/types/{type}', [AboutController::class, 'listAboutsByType']);
    Route::get('/{about}', [AboutController::class, 'show']);
});
Route::group(['prefix' => 'product'], function () {
    Route::get('/categories', [ProductController::class, 'listCategories']);
    Route::get('/', [ProductController::class, 'listProducts']);
    Route::get('/categories/{category}', [ProductController::class, 'listProductsByIdCategory']);
    Route::get('/{product}', [ProductController::class, 'show']);
    Route::get('/{product}/list_comments', [ProductCommentController::class, 'listComments']);
    Route::post('/{product}/comment', [ProductCommentController::class, 'store']);
});
