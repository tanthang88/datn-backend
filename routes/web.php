<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoriesProductController;
use App\Http\Controllers\ProductController;

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
    Route::group(['prefix' => 'product'], function () {
        Route::get('/add', [ProductController::class, 'getAdd']);
        Route::post('/add', [ProductController::class, 'postAdd']);

        Route::get('/update/{id}', [ProductController::class, 'getUpdate']);
        Route::post('/update/{id}', [ProductController::class, 'postUpdate']);

        Route::get('/list', [ProductController::class, 'getList']);
        Route::get('delete/{id}', [ProductController::class,'delete']);

    });

    Route::group(['prefix' => 'laravel-filemanager',], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
