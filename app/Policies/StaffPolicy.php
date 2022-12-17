<?php

namespace App\Policies;

use App\Models\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffPolicy
{
    use HandlesAuthorization;

    public function view(AdminUser $staff)
    {
        return $staff->checkPermissionAccess(config('permissions.access.view-staff'));
    }
}
