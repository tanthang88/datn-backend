<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ProductDetailResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Services\ProductService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    /**
     * listCategories
     *
     * @return JsonResponse
     */
    public function listCategories()
    {
        try {
            $data = $this->productService->getListCategory();
            $listData = ProductCategoryResource::collection($data);
            return $this->responseSuccess(['data' => $listData]);
        } catch (\Throwable $th) {
            Log::error("get list product ", $th);
            return $this->responseError(
                array(trans('alert.product.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    /**
     * listProducts
     *
     * @return JsonResponse
     */
    public function listProducts()
    {
        try {
            $data = $this->productService->getListProduct();
            $listData = ProductResource::collection($data);
            $data->data = $listData;
            return $this->responseSuccess(['data' => $data]);
        } catch (\Throwable $th) {
            Log::error("get list product " . $th);
            return $this->responseError(
                array(trans('alert.product.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * listProductsByCategory
     *
     * @param  ProductCategories $category
     * @return \Illuminate\Http\Response
     */
    public function listProductsByIdCategory(ProductCategories $category)
    {
        try {
            $products = $this->productService->getListProductByCategory($category);
            $listData = ProductResource::collection($products);
            $products->data = $listData;
            return $this->responseSuccess(['data' => $products]);
        } catch (\Throwable $th) {
            Log::error("get product " . $th);
            return $this->responseError(
                array(trans('alert.product.get_list.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * show
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        try {
            $data = $this->productService->getProduct($product);
            return $this->responseSuccess(['data' => ProductDetailResource::make($data)]);
        } catch (\Throwable $th) {
            Log::error("get product " . $th);
            return $this->responseError(
                array(trans('alert.product.get_detail.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * listProductsRelated
     *
     * @param  Product $product
     * @return Response
     */
    public function listProductsRelated(Product $product)
    {
        try {
            $product = $this->productService->getListProductsRelated($product);
            return $this->responseSuccess(['data' => ProductResource::collection($product)]);
        } catch (\Throwable $th) {
            Log::error("get product " . $th);
            return $this->responseError(
                array(trans('alert.product.get_list.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
