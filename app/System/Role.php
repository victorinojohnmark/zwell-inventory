<?php

namespace App\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\System\RoleHasPermission;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $appends = ['permissions'];

    public function roleHasPermissions() {
        return $this->hasMany(RoleHasPermission::class);
    }

    public function getRolePermissionsAttribute()
    {
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$this->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return $rolePermissions;
    }
}
