<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\AddRoleRequest;
use App\Models\AdminPermission;
use App\Models\AdminRole;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct(
        protected AdminRole $role,
        protected AdminPermission $permission
    ) {
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('pages.role.list');
    }

    /**
     * dataRoles get all data for show table
     *
     * @return Array
     */
    public function dataRoles()
    {
        $data['data'] = AdminRole::all();
        return $data;
    }

    /**
     * create
     *
     * @return view
     */
    public function create()
    {
        $permissions = $this->permission->where('parent_id', 0)->get();
        return view('pages.role.add', compact('permissions'));
    }

    /**
     * store
     *
     * @param  AddRoleRequest $request
     * @return void
     */
    public function store(AddRoleRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $dataCreateRole = $this->role->create([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);
            if ($dataCreateRole) {
                $dataCreateRole->rolePermissions()->attach($request->permission_id);
            }
            return redirect(route('role.list'))->with('success', trans('alert.add.success'));
        });
    }

    /**
     * show
     *
     * @param  AdminRole $role
     * @return void
     */
    public function show(AdminRole $role)
    {
        $permissions = $this->permission->where('parent_id', 0)->get();
        $rolePerOld = $role->rolePermissions;
        return view('pages.role.edit', compact('permissions', 'role', 'rolePerOld'));
    }

    /**
     * update
     *
     * @param  AdminRole $role
     * @param  AddRoleRequest $request
     * @return void
     */
    public function update(AdminRole $role, AddRoleRequest $request)
    {
        return DB::transaction(function () use ($request, $role) {
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->rolePermissions()->sync($request->permission_id);
            $role->save();
            return back()->with('success', trans('alert.update.success'));
        });
    }

    /**
     * delete
     *
     * @param  AdminRole $role
     * @return void
     */
    public function delete(AdminRole $role)
    {
        return DB::transaction(function () use ($role) {
            $role->rolePermissions()->detach();
            $role->delete();
        });
    }
}
