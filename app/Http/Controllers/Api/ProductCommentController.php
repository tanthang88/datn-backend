<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCommentResource;
use App\Models\Product;
use App\Services\ProductCommentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProductCommentController extends Controller
{
    public function __construct(protected ProductCommentService $productCommentService)
    {
    }

    /**
     * listComments
     *
     * @param  Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function listComments(Product $product)
    {
        try {
            $data = $this->productCommentService->getListComment($product);
            return $this->responseSuccess(['data' => ProductCommentResource::collection($data)]);
        } catch (\Throwable $th) {
            Log::error("get list comment failed " . $th);
            return $this->responseError(
                array(trans('alert.comment.get_list.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * store
     *
     * @param  Product $product
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, Request $request)
    {
        try {
            $data = $this->productCommentService->createComment($product, $request);
            return $this->responseSuccess(['data' => $data], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            Log::error("comment product failed " . $th);
            return $this->responseError(
                array(trans('alert.comment.create.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
