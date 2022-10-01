<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;

use Illuminate\Http\Request;
use App\Services\LoginService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    // /**
    //  * __construct
    //  *
    //  * @param  LoginService $loginService
    //  */
    public function __construct(private LoginService $loginService)
    {
    }

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
}
