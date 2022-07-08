<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Master\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::Create([
            'company_name' => 'Zwell Philippines Realty Development Corp.',
            'company_code' => 'ZWELL',
            'contact_person' => 'John Doe',
            'contact_no' => '09061234567',
            'email' => 'email@website.com',
            'address' => 'Pag-asa Village, Cavite City'
        ]);

        Company::Create([
            'company_name' => 'LyfHomes Development Corp.',
            'company_code' => 'LYFHOMES',
            'contact_person' => 'Sarah Lee',
            'contact_no' => '09061234567',
            'email' => 'email@website.com',
            'address' => 'Pag-Ibig Village, Navotas City'
        ]);
    }
}
