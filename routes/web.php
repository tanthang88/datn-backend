<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoriesProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DiscountCodeController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostCategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CompanyController as ControllersCompanyController;
use App\Http\Controllers\DealSockController;
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
    })->middleware(['auth'])->name('home');
    #Supplier
    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/add', [SupplierController::class, 'create'])->middleware(['auth'])->name('supplier.add');
        Route::post('/add', [SupplierController::class, 'store']);
        Route::get('/update/{id}', [SupplierController::class, 'show'])->middleware(['auth'])->name('supplier.update');
        Route::post('/update/{id}', [SupplierController::class, 'update']);
        Route::get('/', [SupplierController::class, 'index'])->middleware(['auth'])->name('supplier.list');
        Route::get('/delete/{id}', [SupplierController::class, 'delete'])->middleware(['auth'])->name('supplier.delete');
    });
    #Categories Product
    Route::group(['prefix' => 'categoriesProduct'], function () {
        Route::get('/add', [CategoriesProductController::class, 'create'])->middleware(['auth'])->name('categoryProduct.add');
        Route::post('/add', [CategoriesProductController::class, 'store']);
        Route::get('/update/{id}', [CategoriesProductController::class, 'show'])->middleware(['auth'])->name('categoryProduct.update');
        Route::post('/update/{id}', [CategoriesProductController::class, 'update']);
        Route::get('/', [CategoriesProductController::class, 'index'])->middleware(['auth'])->name('categoryProduct.list');
        Route::get('/delete/{id}', [CategoriesProductController::class, 'delete']);
    });
    #Product
    Route::group(['prefix' => 'product'], function () {
        Route::get('/add', [ProductController::class, 'create'])->middleware(['auth'])->name('product.add');
        Route::post('/add', [ProductController::class, 'store']);
        Route::get('/update/{id}', [ProductController::class, 'show'])->middleware(['auth'])->name('product.update');
        Route::post('/update/{id}', [ProductController::class, 'update']);
        Route::get('/', [ProductController::class, 'index'])->middleware(['auth'])->name('product.list');
        Route::get('/addVariant/{id}', [ProductController::class, 'createVariant'])->middleware(['auth'])->name('variant.add');
        Route::post('/addVariant/{id}', [ProductController::class, 'storeVariant']);
        Route::get('/updateVariant/{id}', [ProductController::class, 'showVariant'])->middleware(['auth'])->name('variant.update');
        Route::post('/updateVariant/{id}', [ProductController::class, 'updateVariant'])->middleware(['auth'])->name('variant.update');
        Route::get('delete/{id}', [ProductController::class, 'delete']);
        Route::get('deletePropertie/{id}/{product_id}', [ProductController::class, 'deletePropertie']);
        Route::get('deleteVariant/{id}', [ProductController::class, 'deleteVariant']);
    });
    #About
    Route::group(['prefix' => 'about'], function () {
        Route::get('/add', [AboutController::class, 'create'])->middleware(['auth'])->name('about.add');
        Route::post('/add', [AboutController::class, 'store']);
        Route::get('/update/{id}', [AboutController::class, 'show'])->middleware(['auth'])->name('about.update');
        Route::post('/update/{id}', [AboutController::class, 'update']);
        Route::get('/', [AboutController::class, 'index'])->middleware(['auth'])->name('about.list');
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
    Route::group(['prefix' => 'postCategories'], function () {
        Route::get('/add', [PostCategoriesController::class, 'create'])->middleware(['auth'])->name('postCategory.add');
        Route::post('/add', [PostCategoriesController::class, 'store']);
        Route::get('/update/{id}', [PostCategoriesController::class, 'show'])->middleware(['auth'])->name('postCategory.update');
        Route::post('/update/{id}', [PostCategoriesController::class, 'update']);
        Route::get('/', [PostCategoriesController::class, 'index'])->middleware(['auth'])->name('postCategory.list');
        Route::get('/delete/{id}', [PostCategoriesController::class, 'delete'])->middleware(['auth'])->name('postCategory.delete');
    });
    #post
    Route::group(['prefix' => 'post'], function () {
        Route::get('/add', [PostController::class, 'create'])->middleware(['auth'])->name('post.add');
        Route::post('/add', [PostController::class, 'store']);
        Route::get('/update/{id}', [PostController::class, 'show'])->name('post.update');
        Route::post('/update/{id}', [PostController::class, 'update']);
        Route::get('/', [PostController::class, 'index'])->middleware(['auth'])->name('post.list');
        Route::get('/delete/{id}', [PostController::class, 'delete'])->middleware(['auth'])->name('post.delete');
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
        //discount
        Route::group(['prefix' => 'discount'], function () {
            Route::get('/', [DiscountController::class, 'index'])->name('promotion.discount.list');
            Route::get('dataSession', [DiscountController::class, 'dataSession'])->name('promotion.discount.dataSession');
            Route::get('dataProductAll', [DiscountController::class, 'dataProductAll'])->name('promotion.discountdataProductAll');
            Route::post('addDataSession', [DiscountController::class, 'addDataSession'])->name('promotion.discount.addDataSession');
            Route::get('/delete-dataSession/{product}', [DiscountController::class, 'deleteDataSession'])->name('promotion.discount.deleteDataSession');
            Route::get('/add', [DiscountController::class, 'getAdd'])->name('promotion.discount.add');
            Route::get('/changeMoney', [DiscountController::class, 'changeMoney'])->name('promotion.discount.changeMoney');
            Route::post('/add', [DiscountController::class, 'store'])->name('promotion.discount.store');
            Route::post('/{discount}', [DiscountController::class, 'update'])->name('promotion.discount.update');
            Route::get('/{discount}', [DiscountController::class, 'show'])->name('promotion.discount.show');
            Route::get('/delete/{id}', [DiscountController::class, 'delete'])->name('promotion.discount.delete');
            Route::get('/end/{id}', [DiscountController::class, 'end'])->name('promotion.discount.end');
        });
        //discount
        Route::group(['prefix' => 'dealsock'], function () {
            Route::get('/', [DealSockController::class, 'index'])->name('promotion.dealsock.list');
            Route::get('dataSession', [DealSockController::class, 'dataSession'])->name('promotion.dealsock.dataSession');
            Route::get('dataSessionCombo', [DealSockController::class, 'dataSessionCombo'])->name('promotion.dealsock.dataSessionCombo');
            Route::get('dataProductAll', [DealSockController::class, 'dataProductAll'])->name('promotion.dealSockDataProductAll');
            Route::get('dataProductAllCombo', [DealSockController::class, 'dataProductAllCombo'])->name('promotion.dealSockDataProductAllCombo');
            Route::post('addDataSession', [DealSockController::class, 'addDataSession'])->name('promotion.dealsock.addDataSession');
            Route::post('addDataSessionCombo', [DealSockController::class, 'addDataSessionCombo'])->name('promotion.dealsock.addDataSessionCombo');
            Route::get('/delete-dataSession/{product}', [DealSockController::class, 'deleteDataSession'])->name('promotion.dealsock.deleteDataSession');
            Route::get('/delete-dataSessionCombo/{product}', [DealSockController::class, 'deleteDataSessionCombo'])->name('promotion.dealsock.deleteDataSessionCombo');
            Route::get('/add', [DealSockController::class, 'getAdd'])->name('promotion.dealsock.add');
            Route::post('/add', [DealSockController::class, 'store'])->name('promotion.dealsock.store');
            Route::post('/{dealsock}', [DealSockController::class, 'update'])->name('promotion.dealsock.update');
            Route::get('/{dealsock}', [DealSockController::class, 'show'])->name('promotion.dealsock.show');
            Route::get('/delete/{id}', [DealSockController::class, 'delete'])->name('promotion.dealsock.delete');
            Route::get('/end/{id}', [DealSockController::class, 'end'])->name('promotion.dealsock.end');
        });
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
    Route::group(['prefix' => 'shop'], function () {
        Route::group(['prefix' => 'info'], function () {
            Route::get('/', [CompanyController::class, 'show'])->name('info.edit');
            Route::post('/update', [CompanyController::class, 'update'])->name('info.update');
        });
        Route::group(['prefix' => 'feeship'], function () {
            Route::get('/', [AboutController::class, 'listFeeShip'])->name('feeship.list');
            Route::get('/add', [AboutController::class, 'getAddFeeShip'])->name('feeship.add');
            Route::post('/add', [AboutController::class, 'storeAddFeeShip'])->name('feeship.store');
            Route::get('/data', [AboutController::class, 'dataFeeShip'])->name('feeship.data');
            Route::get('/{id}', [AboutController::class, 'showFeeShip'])->name('feeship.edit');
            Route::get('/delete/{id}', [AboutController::class, 'deleteFeeShip'])->name('feeship.delete');
            Route::post('/update/{id}', [AboutController::class, 'updateFeeShip'])->name('feeship.update');
        });
    });
});
