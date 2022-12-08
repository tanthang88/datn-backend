<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminPermission extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'admin_permissions';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'key_code',
        'created_at',
    ];

    /**
     * getPermissionChild
     *
     * @return void
     */
    public function getPermissionChild()
    {
        return $this->hasMany(AdminPermission::class, 'parent_id');
    }
}
