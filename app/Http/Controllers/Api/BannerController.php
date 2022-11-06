<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\BannerService;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\BannerResource;

class BannerController extends Controller
{
    public function __construct(protected BannerService $bannerService)
    {
    }
      //listBanner
      public function listBanners()
      {
          try {
              $data = $this->bannerService->getListBanner();
              $listData = BannerResource::collection($data);
              return $this->responseSuccess(['data' => $listData]);
          } catch (\Throwable $th) {
              Log::error("get list banner ", $th);
              return $this->responseError(
                  array(trans('alert.banner.failed')),
                  Response::HTTP_INTERNAL_SERVER_ERROR
              );
          }
      }
    //listBannerByType
    public function listBannersByType(Request $request)
    {
        try {
            $banners = $this->bannerService->getListBannerByType($request);
            $listData = BannerResource::collection($banners);
            return $this->responseSuccess(['data' => $listData]);
        } catch (\Throwable $th) {
            Log::error("get banners ", $th);
            return $this->responseError(
                array(trans('alert.banner.get_type.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
