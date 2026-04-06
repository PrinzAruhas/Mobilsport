<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole   = Role::where('name', 'admin')->first();
        $teknisiRole = Role::where('name', 'teknisi')->first();

        $allMenus = Menu::pluck('id')->toArray();
        $limitedMenus = Menu::where('name', 'Dashboard')->pluck('id')->toArray();

        $adminRole->menus()->sync($allMenus);
        $teknisiRole->menus()->sync($limitedMenus);
    }
}
