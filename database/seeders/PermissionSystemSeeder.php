<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionSystemSeeder extends Seeder
{

    public function run()
    {
        $permissions = [
            ['name' => 'fileattachment-upload', 'title' => 'Upload File Attachment'],
            ['name' => 'fileattachment-delete', 'title' => 'Delete File Attachment'],

            ['name' => 'role-view', 'title' => 'View Role'],
            ['name' => 'role-create', 'title' => 'Create Role'],
            ['name' => 'role-save', 'title' => 'Save/Update Role'],

            ['name' => 'user-view', 'title' => 'View User'],
            ['name' => 'user-create', 'title' => 'Create User'],
            ['name' => 'user-save', 'title' => 'Save/Update User'],
            ['name' => 'user-resetpassword', 'title' => 'Reset User Password'],
            
         ];
 
 
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission['name'], 'title' => $permission['title']]);
         }
    }
}
