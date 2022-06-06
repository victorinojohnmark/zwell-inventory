<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Master\Contractor;

class ContractorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contractor::create([
            'contractor_name' => 'Admin',
            'contractor_code' => 'Admin',
            'contact_person' => 'John Doe',
            'contact_no' => '09178945612',
            'email' => 'email1@website.com',
            'address' => '123 New York St., MetroCity Cavite',
            'notes' => null,
        ]);

        Contractor::create([
            'contractor_name' => 'ABC Contractor',
            'contractor_code' => 'ABC Contractor',
            'contact_person' => 'John Doe',
            'contact_no' => '09178945612',
            'email' => 'email2@website.com',
            'address' => '123 New York St., MetroCity Cavite',
            'notes' => null,
        ]);
    }
}
