<?php

namespace Database\Seeders;

use App\Master\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Supplier::create([
            'supplier_name' => 'JCL Hardware',
            'supplier_code' => 'JCL Hardware',
            'contact_person' => 'John C. Lapuz',
            'contact_no' => '09112233445',
            'email' => 'jcl@gmail.com',
            'address' => 'General Trias Cavite',
            'notes' => 'supplier for the month of may'
        ]);

        Supplier::create([
            'supplier_name' => 'Santiago Hardware',
            'supplier_code' => 'Santiago Hardware',
            'contact_person' => 'Robert Santiago',
            'contact_no' => '09212233446',
            'email' => 'santiago@gmail.com',
            'address' => 'Trece Marteres Cavite',
            'notes' => 'supplier for the month of june'
        ]);

    }
}
