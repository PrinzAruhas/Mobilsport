<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['MPV', 'SUV', 'Sedan', 'City Car', 'Luxury', 'Offroad', 'Sport'];

        foreach ($categories as $cat) {
            Category::create([
                'nama_kategori' => $cat,
                'slug' => Str::slug($cat)
            ]);
        }
    }
}