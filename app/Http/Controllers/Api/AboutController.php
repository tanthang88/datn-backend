<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AboutService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\AboutResource;
use App\Http\Resources\AboutDetailResource;
use App\Models\About;

class AboutController extends Controller
{
    public function __construct(protected AboutService $aboutService)
    {
    }
    //listAbout
    public function listAbouts()
    {
        try {
            $data = $this->aboutService->getListAbout();
            $listData = AboutResource::collection($data);
            return $this->responseSuccess(['data' => $listData]);
        } catch (\Throwable $th) {
            Log::error("get list about ", $th);
            return $this->responseError(
                array(trans('alert.about.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    //listAboutByType
    public function listAboutsByType(Request $request)
    {
        try {
            $abouts = $this->aboutService->getListAboutByType($request);
            $listData = AboutResource::collection($abouts);
            $abouts->data = $listData;
            return $this->responseSuccess(['data' => $abouts]);
        } catch (\Throwable $th) {
            Log::error("get about ", $th);
            return $this->responseError(
                array(trans('alert.about.get_list.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    //show about
    public function show(About $about)
    {
        try {
            $data = $this->aboutService->getAbout($about);
            return $this->responseSuccess(['data' => AboutDetailResource::make($data)]);
        } catch (\Throwable $th) {
            Log::error("get about ", $th);
            return $this->responseError(
                array(trans('alert.about.get_detail.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
