<?php

namespace App\Policies;

use App\Models\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * view
     *
     * @param  AdminUser $staff
     * @return void
     */
    public function view(AdminUser $staff)
    {
        return $staff->checkPermissionAccess(config('permissions.access.view-post'));
    }
}
