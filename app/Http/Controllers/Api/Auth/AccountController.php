<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Models\User;
use App\Services\AccountService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function __construct(private AccountService $accountService)
    {
    }

    /**
     * show
     *
     * @param  User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user){
        try {
            return $this->responseSuccess(['data' => $user]);
        } catch (\Throwable $th) {
            Log::error("get Account failed:" . $th);
            return $this->responseError(
                array(trans('alert.account.get_detail.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    
    /**
     * update
     *
     * @param  User $user
     * @param  AccountRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, AccountRequest $request)
    {
        try {
            $data = $this->accountService->updateUser($user, $request);
            return $this->responseSuccess(['data' => $data]);
        } catch (\Throwable $th) {
            Log::error("update Account failed:" . $th);
            return $this->responseError(
                array(trans('alert.account.update.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
