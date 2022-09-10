<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AdminRole extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'admin_roles';

     /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'created_at'
    ];
        
    /**
     * rolePermissions
     *
     * @return Collection
     */
    public function rolePermissions()
    {
        return $this->belongsToMany(
            AdminPermission::class,
            'admin_role_permission',
            'role_id',
            'permission_id'
        );
    }

}
