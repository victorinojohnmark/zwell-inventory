<?php

namespace App\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\System\RoleHasPermission;

class Permission extends Model
{
    use HasFactory;

    public $validationrules = [
        'name' => 'required|unique:roles,name',
        'description' => 'required|max:255',
        'permission' => 'required',
    ];

    public $validationmessages = [
        
    ];

    public static function createRecord($values): self
    {
        return self::create([
            'name' => $values['name'], 
            'description' => $values['description'],
            'permission' => $values['permission'], 
        ]);

    }

    public function roleHasPermission() {
        return $this->hasMany(RoleHasPermission::class);
    }
}
