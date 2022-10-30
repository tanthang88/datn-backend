<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ProductCategories;
use App\Services\ProductFilterService;
use Illuminate\Support\Facades\Log;

class ProductFilterController extends Controller
{
    public function __construct(protected ProductFilterService $productFilterService)
    {
    }
    /**
     * listFilter
     *
     * @return JsonResponse
     */
    public function listFilter()
    {
        try {
            $data = $this->productFilterService->getListFilter();
            return $this->responseSuccess(['data' => $data]);
        } catch (\Throwable $th) {
            Log::error("get list  filter ", $th);
            return $this->responseError(
                array(trans('alert.filter.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
     /**
     * listSort
     *
     * @return JsonResponse
     */
    public function listSort()
    {
        try {
            $data = $this->productFilterService->getListSortBy();
            return $this->responseSuccess(['data' => $data]);
        } catch (\Throwable $th) {
            Log::error("get list  sort ", $th);
            return $this->responseError(
                array(trans('alert.sort.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


     /**
     * listProductFilter
     *
     *
       * @param  Request $request
       *
     * @return \Illuminate\Http\Response
     */
    public function listProductFilter( Request $request)
    {

        try {
            $data = $this->productFilterService->getListProductFilter($request);
            return $this->responseSuccess(['data' => $data]);
        } catch (\Throwable $th) {
            Log::error("get list  filter product", $th);
            return $this->responseError(
                array(trans('alert.filterProduct.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
