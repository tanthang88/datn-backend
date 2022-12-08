<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\SliderService;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\SliderResource;

class SliderController extends Controller
{
    public function __construct(protected SliderService $sliderService)
    {
    }
    //listSlider
    public function listSliders()
    {
        try {
            $data = $this->sliderService->getListSlider();
            $listData = SliderResource::collection($data);
            return $this->responseSuccess(['data' => $listData]);
        } catch (\Throwable $th) {
            Log::error("get list slider ", $th);
            return $this->responseError(
                array(trans('alert.slider.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    //listSliderByType
    public function listSlidersByType(Request $request)
    {
        try {
            $sliders = $this->sliderService->getListSliderByType($request);
            $listData = SliderResource::collection($sliders);
            return $this->responseSuccess(['data' => $listData]);
        } catch (\Throwable $th) {
            Log::error("get slider ", $th);
            return $this->responseError(
                array(trans('alert.slider.get_type.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
