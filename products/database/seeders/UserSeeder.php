<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'estuph',
            'email' => 'estuph1413@gmail.com',
            'password' => bcrypt ('password'), 
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir User',
            'email' => 'Kasir@gmail.com',
            'password' => bcrypt('kasir123'),
            'role' => 'kasir',
        ]);
    }
}
