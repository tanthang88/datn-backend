<?php
namespace App\Services;

use App\Http\Requests\AccountRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountService
{

    /**
     * updateUser
     *
     * @param  User $user
     * @param  AccountRequest $request
     * @return User $user
     */
    public function updateUser(User $user, AccountRequest $request)
    {
        if (Auth::id() !== $user->id) {
            return false;
        }

        if (!empty($request->password)
            && Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->password);
        }
        if(!empty($request->avatar)) {
            $user->avatar = $request->avatar;
        }
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->tel = $request->tel;
        $user->name = $request->name;
        $user->save();

        return $user;
    }
}
