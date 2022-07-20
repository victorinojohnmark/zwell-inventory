<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'company-view', 'title' => 'View Company'],
            ['name' => 'company-create', 'title' => 'Create Company'],
            ['name' => 'company-save', 'title' => 'Save/Update Company'],

            ['name' => 'contractor-view', 'title' => 'View Contractor'],
            ['name' => 'contractor-create', 'title' => 'Create Contractor'],
            ['name' => 'contractor-save', 'title' => 'Save/Update Contractor'],

            ['name' => 'item-view', 'title' => 'View Item'],
            ['name' => 'item-create', 'title' => 'Create Item'],
            ['name' => 'item-save', 'title' => 'Save/Update Item'],

            ['name' => 'location-view', 'title' => 'View Location'],
            ['name' => 'location-create', 'title' => 'Create Location'],
            ['name' => 'location-save', 'title' => 'Save/Update Location'],

            ['name' => 'supplier-view', 'title' => 'View Supplier'],
            ['name' => 'supplier-create', 'title' => 'Create Supplier'],
            ['name' => 'supplier-save', 'title' => 'Save/Update Supplier'],
         ];
 
 
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission['name'], 'title' => $permission['title']]);
         }
    }
}
