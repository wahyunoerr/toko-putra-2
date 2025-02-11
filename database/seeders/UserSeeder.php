<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
        ]);
        $admin->assignRole('admin');

        $kasir = User::create([
            'name' => 'Kasir User',
            'email' => 'kasir@example.com',
            'password' => bcrypt('kasir123'),
        ]);
        $kasir->assignRole('kasir');
    }
}
