<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        User::create([
            'name' => 'John Mark Victorino',
            'username' => 'mark',
            'password' => '$2y$10$8G7kMoARXTWnvgmfRExOe.5xKwhG6lZBYLproRXRtREHMCn9j/ONe', //password
            'email' => 'email@website.com'
        ]);

        User::create([
            'name' => 'Vanz',
            'username' => 'vanz',
            'password' => '$2y$10$8G7kMoARXTWnvgmfRExOe.5xKwhG6lZBYLproRXRtREHMCn9j/ONe', //password
            'email' => 'vanz@website.com'
        ]);
    }
}