<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\Auth\AccountController;
use App\Http\Controllers\Api\ProductCommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductFilterController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\api\ContactController as ApiContactController;
use App\Http\Controllers\Api\DiscountCodeController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\VariantionController;

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
            Route::get('/{bill}/detail', [BillController::class, 'show']);
            Route::post('/add_to_bill', [BillController::class, 'create']);
            Route::post('/{bill}/cancel', [BillController::class, 'cancelBill']);
        });
        Route::group(['prefix' => 'account'], function () {
            Route::get('/{user}', [AccountController::class, 'show']);
            Route::post('/{user}/update', [AccountController::class, 'update']);
        });
    });
    Route::group(['prefix' => 'discountcode'], function () {
        Route::get('/', [DiscountCodeController::class, 'listDiscountCodes']);
        Route::middleware(['auth:user'])->group(function () {
            Route::post('/verification', [DiscountCodeController::class, 'verification']);
        });
    });
    Route::group(['prefix' => 'contact'], function () {
        Route::post('/', [ApiContactController::class, 'store'])->name('contact.store');
    });
});
Route::group(['prefix' => 'post'], function () {
    Route::get('/categories', [PostController::class, 'listCategories']);
    Route::get('/categories/{category}', [PostController::class, 'listPosts']);
    Route::get('/all', [PostController::class, 'showAll']);
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
    Route::get('/{product}/related', [ProductController::class, 'listProductsRelated']);
    Route::get('/{product}/list_comments', [ProductCommentController::class, 'listComments']);
    Route::get('/filter', [ProductFilterController::class, 'listFilter']);
    Route::get('/sort', [ProductFilterController::class, 'listSort']);
    Route::get('/filter/{categories}/{filter}', [ProductFilterController::class, 'listProductFilter']);
    Route::get('/categories/{category}', [ProductController::class, 'listProductsByIdCategory']);
    Route::get('/{product}', [ProductController::class, 'show']);
    Route::post('/{product}/comment', [ProductCommentController::class, 'store']);
    Route::get('/variantion/{product}/{properties}', [VariantionController::class, 'getVariantion']);
    Route::get('/search/{product}', [ProductFilterController::class, 'listProductSearch']);
});
Route::group(['prefix' => 'slider'], function () {
    Route::get('/', [SliderController::class, 'listSliders']);
    Route::get('/types/{type}', [SliderController::class, 'listSlidersByType']);
});
Route::group(['prefix' => 'banner'], function () {
    Route::get('/', [BannerController::class, 'listBanners']);
    Route::get('/types/{type}', [BannerController::class, 'listBannersByType']);
});
Route::group(['prefix' => 'payment'], function () {
    Route::post('/return-payment/{return}', [PaymentController::class, 'return']);
});
