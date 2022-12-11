<?php

namespace App\Services;

use App\Http\Requests\AccountRequest;
use App\Models\User;
use App\Traits\storageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountService
{

    /**
     * updateUser
     *
     * @param  User $user
     * @param  AccountRequest $request
     * @return User $user
     */
    use storageImageTrait;

    public function updateUser(User $user, AccountRequest $request)
    {
        if (Auth::id() !== $user->id) {
            return false;
        }

        if (
            !empty($request->password)
            && Hash::check($request->password, $user->password)
        ) {
            $user->password = Hash::make($request->password);
        }
        if (!empty($request->avatar)) {
            $user->avatar = $request->avatar;
        }
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->tel = $request->tel;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->city_id = $request->city_id;
        $user->dist_id = $request->dist_id;
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'avatar', 'user_img');

        if ($dataUploadFeatureImage) {
            $user->avatar = $dataUploadFeatureImage['file_path'];
        }

        $user->save();

        return $user;
    }
}
