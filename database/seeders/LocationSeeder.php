<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Master\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'location_name' => 'Warehouse 1',
            'location_code' => 'Warehouse 1',
            'company_id' => 1,
            'contact_person' => 'John Doe',
            'contact_no' => '09178945612',
            'email' => 'email1@website.com',
            'address' => '123 New York St., MetroCity Cavite',
            'notes' => null,
        ]);

        Location::create([
            'location_name' => 'Warehouse 2',
            'location_code' => 'Warehouse 2',
            'company_id' => 1,
            'contact_person' => 'John Doe',
            'contact_no' => '09178945612',
            'email' => 'email2@website.com',
            'address' => '123 New York St., MetroCity Cavite',
            'notes' => null,
        ]);
    }
}
