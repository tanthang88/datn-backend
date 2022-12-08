<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;

use Illuminate\Http\Request;
use App\Services\LoginService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    /**
     * __construct
     *
     * @param  LoginService $loginService
     */
    public function __construct(private LoginService $loginService)
    {
    }

    /**
     * loginClient
     *
     * @param  LoginUserRequest $request
     * @return Json
     */
    public function loginClient(LoginUserRequest $request)
    {
        try {
            $res = $this->loginService->loginClient($request);
            if (isset($res['error'])) {
                return $this->responseError(
                    $res['message'],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
            return $this->responseSuccess($res);
        } catch (\Throwable $th) {
            Log::error("Login failed:" . $th);
            return $this->responseError(
                array(trans('alert.login.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * logoutClient
     *
     * @return Json
     */
    public function logoutClient()
    {
        try {
            $this->loginService->logout();
            return $this->responseSuccess([], Response::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            Log::error("logout failed:" . $th);
            return $this->responseError(
                array(trans('alert.login.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
