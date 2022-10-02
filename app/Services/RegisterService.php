<?php

namespace App\Services;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * register
     *
     * @param  RegisterUserRequest $request
     * @return Array
     */
    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => User::STATUS_ACTIVE,
            'address' => $request->address,
            'city_id' => $request->city_id,
            'dist_id' => $request->dist_id,
            'tel'   => $request->tel,
            'password' => Hash::make($request->password),
        ]);
        return $user;
    }
}
