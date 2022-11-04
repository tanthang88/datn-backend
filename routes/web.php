<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoriesProductController;
use App\Http\Controllers\PostCategoriesController;
use App\Http\Controllers\PostController;


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
Route::group(['prefix' => '/'], function () {
    Route::get('', function () {
        return view('pages.home');
    });
    Route::group(['prefix' => 'Supplier'], function () {
        Route::get('/Add', [SupplierController::class, 'getAdd']);
        Route::post('/Add', [SupplierController::class, 'postAdd']);

        Route::get('/Update/{id}', [SupplierController::class, 'getUpdate']);
        Route::post('/Update/{id}', [SupplierController::class, 'postUpdate']);

        Route::get('/List', [SupplierController::class, 'getList']);
        Route::get('/Delete/{id}', [SupplierController::class, 'getDelete']);
    });
 #Categories Product
 Route::group(['prefix' => 'CategoriesProduct'], function () {
    Route::get('/Add', [CategoriesProductController::class, 'getAdd']);
    Route::post('/Add', [CategoriesProductController::class, 'postAdd']);

    Route::get('/Update/{id}', [CategoriesProductController::class, 'getUpdate']);
    Route::post('/Update/{id}', [CategoriesProductController::class, 'postUpdate']);

    Route::get('/List', [CategoriesProductController::class, 'getList']);
    Route::get('/Delete/{id}', [CategoriesProductController::class, 'getDelete']);
});
#postcategory
Route::group(['prefix' => 'PostCategories'], function () {
    Route::get('/Add', [PostCategoriesController::class, 'getAdd']);
    Route::post('/Add', [PostCategoriesController::class, 'postAdd']);

    Route::get('/Update/{id}', [PostCategoriesController::class, 'getUpdate']);
    Route::post('/Update/{id}', [PostCategoriesController::class, 'postUpdate']);

    Route::get('/List', [PostCategoriesController::class, 'getList']);
    Route::get('/Delete/{id}', [PostCategoriesController::class, 'getDelete']);
});
#post
Route::group(['prefix' => 'Post'], function () {
    Route::get('/Add', [PostController::class, 'getAdd']);
    Route::post('/Add', [PostController::class, 'postAdd']);

    Route::get('/Update/{id}', [PostController::class, 'getUpdate']);
    Route::post('/Update/{id}', [PostController::class, 'postUpdate']);

    Route::get('/List', [PostController::class, 'getList']);
    Route::get('/Delete/{id}', [PostController::class, 'getDelete']);
});
});
