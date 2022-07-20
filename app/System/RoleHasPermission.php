<?php

namespace App\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\System\Role;
use App\System\Permission;

class RoleHasPermission extends Model
{
    use HasFactory;

    public function roles() {
        return $this->belongsTo(Role::class);
    }

    public function permission() {
        return $this->belongsTo(Permission::class);
    }
}
