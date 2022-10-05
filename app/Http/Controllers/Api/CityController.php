<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CityService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    /**
     * __construct
     *
     * @param  CityService $cityService
     */
    public function __construct(protected CityService $cityService)
    {
    }

    /**
     * city
     *
     * @return Array
     */
    public function city()
    {
        try {
            return $this->ResponseSuccess($this->cityService->getCity());
        } catch (\Throwable $th) {
            Log::error("Get failed:" . $th);
            return $this->responseError(
                array(trans('alert.city.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
