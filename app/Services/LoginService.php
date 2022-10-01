<?php

namespace App\Services;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginService
{
    // /**
    //  * __construct
    //  *
    //  * @param  Request $request
    //  * @return void
    //  */
    public function __construct(Request $request)
    {
        $this->_request = $request;
    }

    /**
     *  handle login client
     *
     * @param  Request $request
     * @return json
     */
    public function loginClient(LoginUserRequest $request)
    {
        $params = [
            'grant_type'    => 'password',
            'client_id'     => config('define.auth.passport_personal_access_client_id'),
            'client_secret' => config('define.auth.passport_personal_access_client_secret'),
            'username'      => $request->email,
            'password'      => $request->password,
            'scope'         => '*'
        ];
        $this->_request->request->add($params);

        $tokenRequest = Request::create(
            config('app.url') . '/oauth/token',
            'post'
        );
        $instance = Route::dispatch($tokenRequest);

        $res = json_decode($instance->getContent(), true);
        if (isset($res['error'])) {
            if ($res['error'] === 'invalid_grant') {
                $res['message'] = trans('alert.login.username_or_password_wrong');
            }
            return $res;
        }

        $user = User::firstWhere('email', $request->input('email'));
        if ($user->status == User::STATUS_BLOCK) {
            $res = ['error' => true, 'message' => [trans('alert.login.status_block')]];
            return $res;
        }
        $res['user'] = $user;
        return $res;
    }

    /**
     *  handle logout client
     *
     * @return void
     */
    public function logout()
    {
        // Auth::user()->token()->revoke();
    }
}
