<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DiscountCodeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\DiscountCodeResource;
use App\Http\Resources\CheckDiscountCodeResource;
use App\Models\Promotion;
use App\Models\PromotionProduct;

class DiscountCodeController extends Controller
{
    public function __construct(protected DiscountCodeService $discountCodeService)
    {
    }
    //listDiscountCodes
    public function listDiscountCodes()
    {
        try {
            $data = $this->discountCodeService->getListDiscountCode();
            $listData = DiscountCodeResource::collection($data);
            return $this->responseSuccess(['data' => $listData]);
        } catch (\Throwable $th) {
            Log::error("get list discountcode ", $th);
            return $this->responseError(
                array(trans('alert.discountcode.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    /**
     * Check if the customer has used it
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function verification(Request $request)
    {
        try {

            $data = $this->discountCodeService->verification($request);
            if ($data == '' || $data == null || empty($data) || count($data) == 0) {
                return [
                    'success' => false,
                    'message' => trans('alert.discountcode.verification.error'),
                ];
            } else {
                $listData = CheckDiscountCodeResource::collection($data);
                return $this->responseSuccess($listData); //
            }
        } catch (\Throwable $th) {
            Log::error("Discount code" . $th);
            return [
                'success' => false,
                'message' => trans('alert.discountcode.verification.error'),
            ];
        }
    }
}
