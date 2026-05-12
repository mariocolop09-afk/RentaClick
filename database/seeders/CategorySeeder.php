<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Vehículos',
            'Herramientas',
            'Electrónica',
            'Hogar',
            'Ropa',
            'Deportes',
        ];

        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }
    }
}
