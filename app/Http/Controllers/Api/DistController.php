<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Services\DistService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class DistController extends Controller
{
    /**
     * __construct
     *
     * @param  DistService $distService
     */
    public function __construct(protected DistService $distService)
    {
    }

    /**
     * dist
     *
     * @param  City $city
     * @return Array
     */
    public function dist(City $city)
    {
        try {
            return $this->responseSuccess($this->distService->getDistByCity($city));
        } catch (\Throwable $th) {
            Log::error("get Dist ", $th);
            return $this->responseError(
                array(trans('alert.dist.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
