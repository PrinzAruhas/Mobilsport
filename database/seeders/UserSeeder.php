<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        $admin = User::create([
            'name' => 'Karina',
            'email' => 'katarinabluu@gmail.com',
            'password' => Hash::make('mybini'),
            'role_id' => $adminRole->id, // <- WAJIB
        ]);
    }
}

           
