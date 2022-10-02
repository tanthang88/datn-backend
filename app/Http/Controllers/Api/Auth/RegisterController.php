<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * __construct
     *
     * @param  RegisterService $registerService
     */
    public function __construct(private RegisterService $registerService)
    {
    }

    /**
     * registerClient
     *
     * @param  RegisterUserRequest $request
     * @return Json
     */
    public function registerClient(RegisterUserRequest $request)
    {
        try {
            $res = $this->registerService->register($request);
            return $this->responseSuccess(['data' => $res],Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            Log::error("Register failed:" . $th);
            return $this->responseError(
                array(trans('alert.register.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
