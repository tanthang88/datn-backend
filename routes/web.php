<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoriesProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostCategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BannerController;



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
    #Product
    Route::group(['prefix' => 'product'], function () {
        Route::get('/add', [ProductController::class, 'getAdd']);
        Route::post('/add', [ProductController::class, 'postAdd']);

        Route::get('/addVariant/{id}', [ProductController::class, 'getAddVariant']);
        Route::post('/addVariant/{id}', [ProductController::class, 'postAddVariant']);

        Route::get('/updateVariant/{id}', [ProductController::class, 'getUpdateVariant']);

        Route::get('/update/{id}', [ProductController::class, 'getUpdate']);
        Route::post('/update/{id}', [ProductController::class, 'postUpdate']);

        Route::get('/list', [ProductController::class, 'getList']);
        Route::get('delete/{id}', [ProductController::class,'delete']);
        Route::get('deletePropertie/{id}', [ProductController::class,'deletePropertie']);


    });
    #About
    Route::group(['prefix' => 'about'], function () {
        Route::get('/add', [AboutController::class, 'getAdd']);
        Route::post('/add', [AboutController::class, 'postAdd']);

        Route::get('/update/{id}', [AboutController::class, 'getUpdate']);
        Route::post('/update/{id}', [AboutController::class, 'postUpdate']);

        Route::get('/list', [AboutController::class, 'getList']);
        Route::get('delete/{id}', [AboutController::class,'delete']);

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
#slider
Route::group(['prefix' => 'Slider'], function () {
    Route::get('/Add', [SliderController::class, 'getAdd'])->name('slider.add');
    Route::post('/Add', [SliderController::class, 'postAdd'])->name('slider.store');

    Route::get('show/{slider}', [SliderController::class, 'getUpdate'])->name('slider.show');
    Route::post('update/{id}', [SliderController::class, 'postUpdate'])->name('slider.update');

    Route::get('/List', [SliderController::class, 'getList'])->name('slider.list');
    Route::get('/Delete/{id}', [SliderController::class, 'getDelete'])->name('slider.delete');
});
#Banner
Route::group(['prefix' => 'Banner'], function () {
    Route::get('/Add', [BannerController::class, 'getAdd'])->name('banner.add');
    Route::post('/Add', [BannerController::class, 'postAdd'])->name('banner.store');

    Route::get('show/{banner}', [BannerController::class, 'getUpdate'])->name('banner.show');
    Route::post('update/{id}', [BannerController::class, 'postUpdate'])->name('banner.update');

    Route::get('/List', [BannerController::class, 'getList'])->name('banner.list');
    Route::get('/Delete/{id}', [BannerController::class, 'getDelete'])->name('banner.delete');
});
});
