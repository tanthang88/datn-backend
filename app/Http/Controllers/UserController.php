<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Models\City;
use App\Models\Dist;
use App\Models\User;
use App\Services\CityService;
use App\Services\DistService;
use App\Traits\storageImageTrait;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use storageImageTrait;
    public function __construct(
        protected CityService $cityService,
        protected DistService $distService,
    ) {
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('pages.user.list');
    }

    /**
     * get list user ro show in list sort, filter, search
     *
     * @return Array
     */
    public function dataUser()
    {
        $data['data'] = User::all();
        return $data;
    }

    /**
     * show detail user
     *
     * @param  User $user
     * @return void
     */
    public function show(User $user)
    {
        $cities = City::all();
        $dists = $user->city ? $this->distService->getDistByCity($user->city) : [];
        return view('pages.user.edit', compact('user', 'cities', 'dists'));
    }

    /**
     * update user profile
     *
     * @param  User $user
     * @param  mixed $request
     * @return void
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        return DB::transaction(function () use ($request, $user) {
            $user->name = $request->name;
            $user->tel = $request->tel;
            $user->address = $request->address;
            $user->city_id = $request->city_id;
            $user->dist_id = $request->dist_id;
            $user->birthday = $request->birthday;
            $user->gender = $request->gender;

            !empty($request->status)
                ? $user->status = User::STATUS_BLOCK
                : $user->status = User::STATUS_ACTIVE;
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'avatar', 'user_img');

            if (!empty($dataUploadFeatureImage)) {
                $user->avatar = $dataUploadFeatureImage['file_path'];
            }

            $user->save();
            return back()->with('success', trans('alert.update.success'));
        });
    }

    /**
     * delete user
     *
     * @param  mixed $user
     * @return void
     */
    public function delete(User $user)
    {
        return $user->delete();
    }
}
