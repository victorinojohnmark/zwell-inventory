<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Master\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'password' => '$2y$10$8G7kMoARXTWnvgmfRExOe.5xKwhG6lZBYLproRXRtREHMCn9j/ONe', //password
            'email' => 'email@website.com'
        ]);

        $role = Role::create(['name' => 'Super Admin', 'description' => 'Highest Level User']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}