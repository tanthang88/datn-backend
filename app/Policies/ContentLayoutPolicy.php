<?php

namespace App\Policies;

use App\Models\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentLayoutPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  AdminUser $staff
     * @return boolean
     */
    public function view(AdminUser $staff)
    {
        return $staff->checkPermissionAccess(config('permissions.access.view-content-layout'));
    }
}
