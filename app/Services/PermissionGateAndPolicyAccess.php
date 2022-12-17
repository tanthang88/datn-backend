<?php

namespace App\Services;

use App\Policies\BillPolicy;
use App\Policies\ContentLayoutPolicy;
use App\Policies\FeeShipPolicy;
use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;
use App\Policies\RolePolicy;
use App\Policies\PostPolicy;
use App\Policies\ProductPolicy;
use App\Policies\PromotionPolicy;
use App\Policies\StaffPolicy;

class PermissionGateAndPolicyAccess
{
    public function setGateAndPolicyAccess()
    {
        $this->defineGatePost();
        $this->defineGateProduct();
        $this->defineGateUser();
        $this->defineGateStaff();
        $this->defineGateRole();
        $this->defineGateContentLayout();
        $this->defineGateBill();
        $this->defineGateFeeShip();
        $this->defineGatePromotion();
    }

    public function defineGatePost()
    {
        Gate::define('view-post', [PostPolicy::class, 'view']);
    }
    public function defineGatePromotion()
    {
        Gate::define('view-promotion', [PromotionPolicy::class, 'view']);
    }
    public function defineGateProduct()
    {
        Gate::define('view-product', [ProductPolicy::class, 'view']);
    }

    public function defineGateStaff()
    {
        Gate::define('view-staff', [StaffPolicy::class, 'view']);
    }

    public function defineGateUser()
    {
        Gate::define('view-user', [UserPolicy::class, 'view']);
    }

    public function defineGateRole()
    {
        Gate::define('view-role', [RolePolicy::class, 'view']);
    }

    public function defineGateContentLayout()
    {
        Gate::define('view-content-layout', [ContentLayoutPolicy::class, 'view']);
    }

    public function defineGateBill()
    {
        Gate::define('view-bill', [BillPolicy::class, 'view']);
    }

    public function defineGateFeeShip()
    {
        Gate::define('view-feeship', [FeeShipPolicy::class, 'view']);
    }
}
