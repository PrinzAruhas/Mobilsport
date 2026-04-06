<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
    
        Role::firstOrCreate(
            ['name' => 'admin'],
            ['ket' => 'Administrator']
        );

        Role::firstOrCreate(
            ['name' => 'teknisi'],
            ['ket' => 'Staff Teknis/Maintenance']
        );

        Role::firstOrCreate(
            ['name' => 'peminjam'],
            ['ket' => 'User / Peminjam Barang']
        );
    }
}
