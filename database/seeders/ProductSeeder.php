<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Demo User',
                'email' => 'demo@gmail.com',
                'password' => bcrypt('12345678'),
            ]);
        }

        Product::create([
            'user_id' => $user->id,
            'title' => 'Taladro eléctrico',
            'description' => 'Taladro potente para trabajos de construcción.',
            'price_per_day' => 10,
            'image_url' => 'https://via.placeholder.com/600x400',
            'is_available' => true
        ]);

        Product::create([
            'user_id' => $user->id,
            'title' => 'Carro Toyota Corolla',
            'description' => 'Vehículo económico para viajes cortos.',
            'price_per_day' => 40,
            'image_url' => 'https://via.placeholder.com/600x400',
            'is_available' => true
        ]);
    }
}