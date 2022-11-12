<?php

namespace App\Http\Controllers;

use App\Http\Requests\Staff\AddStaffRequest;
use App\Http\Requests\Staff\UpdateStaffRequest;
use App\Models\AdminRole;
use App\Models\AdminUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('pages.staff.list');
    }

    /**
     * dataStaffs for dataTables
     *
     * @return Array
     */
    public function dataStaffs()
    {
        $data['data'] = AdminUser::with('AdminRolesUser')->get();
        return $data;
    }

    /**
     * show detailed staff
     *
     * @param  AdminUser $staff
     * @return void
     */
    public function show(AdminUser $staff)
    {
        $roles = AdminRole::all();
        return view('pages.staff.edit', compact('staff', 'roles'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $roles = AdminRole::all();
        return view('pages.staff.add', compact('roles'));
    }

    /**
     * store
     *
     * @param  AddStaffRequest $request
     * @return void
     */
    public function store(AddStaffRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $staffData = [
                'tel' => $request->tel,
                'gender' => number_format($request->gender),
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'birthday' => $request->birthday,
            ];
            $adminUser = AdminUser::create($staffData);
            DB::table('admin_role_user')->insert([
                'role_id' => $request->role[0],
                'user_id' => $adminUser->id
            ]);

            return redirect(route('staff.list'))->with('success', trans('alert.add.success'));
        });
    }

    /**
     * update
     *
     * @param  AdminUser $staff
     * @param  UpdateStaffRequest $request
     * @return void
     */
    public function update(AdminUser $staff, UpdateStaffRequest $request)
    {
        return DB::transaction(function () use ($request, $staff) {
            $staff->name = $request->name;
            $staff->tel = $request->tel;
            $staff->birthday = $request->birthday;
            $staff->gender = $request->gender;
            if (!empty($request->password)) {
                $staff->password = Hash::make($request->password);
            }
            $staff->AdminRolesUser()->sync($request->role);
            $staff->save();
            
            return back()->with('success', trans('alert.update.success'));
        });
    }

    /**
     * delete
     *
     * @param  AdminUser $staff
     * @return void
     */
    public function delete(AdminUser $staff)
    {
        return $staff->delete();
    }
}
