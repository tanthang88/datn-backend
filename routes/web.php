<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoriesProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('user.list');
        Route::get('data', [UserController::class, 'dataUser'])->name('dataUser');
        Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
        Route::post('/{user}', [UserController::class, 'update'])->name('user.update');
        Route::get('/delete/{user}', [UserController::class, 'delete']);
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.list');
        Route::get('data', [RoleController::class, 'dataRoles'])->name('dataRoles');
        Route::get('/add', [RoleController::class, 'create'])->name('role.add');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/{role}', [RoleController::class, 'show'])->name('role.edit');
        Route::post('/{role}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/delete/{role}', [RoleController::class, 'delete'])->name('role.delete');

    });

});
