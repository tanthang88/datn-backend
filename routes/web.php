<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoriesProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DiscountCodeController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostCategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StaffController;

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
    Route::get('login', [LoginAdminController::class, 'index']);
    Route::post('login', [LoginAdminController::class, 'Login'])->name('login');
    Route::get('logout', [LoginAdminController::class, 'Logout'])->name('logout');
    Route::get('', function () {
        return view('pages.home');
    })->middleware(['auth']);
    Route::group(['prefix' => 'Supplier'], function () {
        Route::get('/Add', [SupplierController::class, 'getAdd'])->middleware(['auth'])->name('supplier.add');
        Route::post('/Add', [SupplierController::class, 'postAdd']);
        Route::get('/Update/{id}', [SupplierController::class, 'getUpdate'])->middleware(['auth'])->name('supplier.update');
        Route::post('/Update/{id}', [SupplierController::class, 'postUpdate']);
        Route::get('/List', [SupplierController::class, 'getList'])->middleware(['auth'])->name('supplier.list');
        Route::get('/Delete/{id}', [SupplierController::class, 'getDelete']);
    });
    #Categories Product
    Route::group(['prefix' => 'CategoriesProduct'], function () {
        Route::get('/Add', [CategoriesProductController::class, 'getAdd'])->middleware(['auth'])->name('categoryProduct.add');
        Route::post('/Add', [CategoriesProductController::class, 'postAdd']);
        Route::get('/Update/{id}', [CategoriesProductController::class, 'getUpdate'])->middleware(['auth'])->name('categoryProduct.update');
        Route::post('/Update/{id}', [CategoriesProductController::class, 'postUpdate']);
        Route::get('/List', [CategoriesProductController::class, 'getList'])->middleware(['auth'])->name('categoryProduct.list');
        Route::get('/Delete/{id}', [CategoriesProductController::class, 'getDelete']);
    });
    #Product
    Route::group(['prefix' => 'product'], function () {
        Route::get('/add', [ProductController::class, 'getAdd']);
        Route::post('/add', [ProductController::class, 'postAdd']);
        Route::get('/addVariant/{id}', [ProductController::class, 'getAddVariant']);
        Route::post('/addVariant/{id}', [ProductController::class, 'postAddVariant']);
        Route::get('/updateVariant/{id}', [ProductController::class, 'getUpdateVariant']);
        Route::get('/update/{id}', [ProductController::class, 'getUpdate'])->middleware(['auth'])->name('product.update');
        Route::post('/update/{id}', [ProductController::class, 'postUpdate']);
        Route::get('/list', [ProductController::class, 'getList'])->middleware(['auth'])->name('product.list');
        Route::get('delete/{id}', [ProductController::class, 'delete']);
        Route::get('deletePropertie/{id}', [ProductController::class, 'deletePropertie']);
    });
    #About
    Route::group(['prefix' => 'about'], function () {
        Route::get('/add', [AboutController::class, 'getAdd']);
        Route::post('/add', [AboutController::class, 'postAdd']);
        Route::get('/update/{id}', [AboutController::class, 'getUpdate']);
        Route::post('/update/{id}', [AboutController::class, 'postUpdate']);
        Route::get('/list', [AboutController::class, 'getList'])->middleware(['auth'])->name('about.list');
        Route::get('delete/{id}', [AboutController::class, 'delete']);
    });
    #User
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->middleware(['auth'])->name('user.list');
        Route::get('data', [UserController::class, 'dataUser'])->middleware(['auth'])->name('dataUser');
        Route::get('/{user}', [UserController::class, 'show'])->middleware(['auth'])->name('user.show');
        Route::post('/{user}', [UserController::class, 'update'])->name('user.update');
        Route::get('/delete/{user}', [UserController::class, 'delete']);
    });
    #Role
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->middleware(['auth'])->name('role.list');
        Route::get('data', [RoleController::class, 'dataRoles'])->middleware(['auth'])->name('dataRoles');
        Route::get('/add', [RoleController::class, 'create'])->middleware(['auth'])->name('role.add');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/{role}', [RoleController::class, 'show'])->middleware(['auth'])->name('role.edit');
        Route::post('/{role}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/delete/{role}', [RoleController::class, 'delete'])->name('role.delete');
    });
    #Staff
    Route::group(['prefix' => 'staff'], function () {
        Route::get('/', [StaffController::class, 'index'])->middleware(['auth'])->name('staff.list');
        Route::get('data', [StaffController::class, 'dataStaffs'])->middleware(['auth'])->name('dataStaffs');
        Route::get('/add', [StaffController::class, 'create'])->middleware(['auth'])->name('staff.add');
        Route::post('/add', [StaffController::class, 'store'])->name('staff.store');
        Route::post('/{staff}', [StaffController::class, 'update'])->name('staff.update');
        Route::get('/{staff}', [StaffController::class, 'show'])->middleware(['auth'])->name('staff.show');
        Route::get('/delete/{staff}', [StaffController::class, 'delete'])->name('staff.delete');
    });
    #postCategory
    Route::group(['prefix' => 'PostCategories'], function () {
        Route::get('/Add', [PostCategoriesController::class, 'getAdd'])->middleware(['auth'])->name('postCategory.add');
        Route::post('/Add', [PostCategoriesController::class, 'postAdd']);
        Route::get('/Update/{id}', [PostCategoriesController::class, 'getUpdate']);
        Route::post('/Update/{id}', [PostCategoriesController::class, 'postUpdate']);
        Route::get('/List', [PostCategoriesController::class, 'getList'])->middleware(['auth'])->name('postCategory.list');
        Route::get('/Delete/{id}', [PostCategoriesController::class, 'getDelete']);
    });
    #post
    Route::group(['prefix' => 'Post'], function () {
        Route::get('/Add', [PostController::class, 'getAdd'])->middleware(['auth'])->name('post.add');
        Route::post('/Add', [PostController::class, 'postAdd']);
        Route::get('/Update/{id}', [PostController::class, 'getUpdate']);
        Route::post('/Update/{id}', [PostController::class, 'postUpdate']);
        Route::get('/List', [PostController::class, 'getList'])->middleware(['auth'])->name('post.list');
        Route::get('/Delete/{id}', [PostController::class, 'getDelete']);
    });
    #promotion
    Route::group(['prefix' => 'promotion'], function () {
        Route::group(['prefix' => 'discount-code'], function () {
            Route::get('/', [DiscountCodeController::class, 'index'])->name('promotion.discount-code.list');
            Route::get('data', [DiscountCodeController::class, 'dataDiscountCodes'])->name('dataDiscountCodes');
            Route::get('dataend', [DiscountCodeController::class, 'dataDiscountCodesEnd'])->name('dataDiscountCodesEnd');
            Route::get('datanotstart', [DiscountCodeController::class, 'dataDiscountCodesNotStart'])->name('dataDiscountCodesNotStart');
            Route::get('/add', [DiscountCodeController::class, 'getAdd'])->name('promotion.discount-code.add');
            Route::post('/add', [DiscountCodeController::class, 'store'])->name('promotion.discount-code.store');
            Route::post('/{discountcode}', [DiscountCodeController::class, 'update'])->name('promotion.discount-code.update');
            Route::get('/{discountcode}', [DiscountCodeController::class, 'show'])->name('promotion.discount-code.show');
            Route::get('/delete/{id}', [DiscountCodeController::class, 'delete'])->name('promotion.discount-code.delete');
            Route::get('/end/{id}', [DiscountCodeController::class, 'end'])->name('promotion.discount-code.end');
        });
    });
});
