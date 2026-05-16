<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@demo.com',
                'password' => bcrypt('password')
            ]);
        }

        $categories = Category::all();

        $products = [
            [
                'title' => 'Toyota Corolla 2018',
                'description' => 'Vehículo cómodo y económico ideal para viajes.',
                'price_per_day' => 250,
                'image_url' => 'https://images.unsplash.com/photo-1626072557464-90403d788e8d?q=80&w=764&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Vehículos'
            ],
            [
                'title' => 'Moto Yamaha 150cc',
                'description' => 'Perfecta para movilizarte en la ciudad.',
                'price_per_day' => 120,
                'image_url' => 'https://images.unsplash.com/photo-1664643890508-05223aa7f580?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Vehículos'
            ],
            [
                'title' => 'Bicicleta de montaña',
                'description' => 'Bicicleta ideal para rutas difíciles.',
                'price_per_day' => 45,
                'image_url' => 'https://plus.unsplash.com/premium_photo-1677838847763-0810bff8f40e?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Deportes'
            ],
            [
                'title' => 'Carpa para camping 4 personas',
                'description' => 'Carpa resistente para acampar en montaña o playa.',
                'price_per_day' => 55,
                'image_url' => 'https://images.unsplash.com/photo-1602391833977-358a52198938?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Deportes'
            ],
            [
                'title' => 'Taladro Industrial DeWalt',
                'description' => 'Taladro potente para trabajos de construcción.',
                'price_per_day' => 50,
                'image_url' => 'https://images.unsplash.com/photo-1572981779307-38b8cabb2407?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dGFsYWRyb3xlbnwwfHwwfHx8MA%3D%3D',
                'category' => 'Herramientas'
            ],
            [
                'title' => 'Sierra Eléctrica',
                'description' => 'Ideal para cortar madera y trabajos de carpintería.',
                'price_per_day' => 60,
                'image_url' => 'https://images.unsplash.com/photo-1617571607645-dd7dd3bf7f6b?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Herramientas'
            ],
            [
                'title' => 'PlayStation 5',
                'description' => 'Consola PS5 lista para jugar con control incluido.',
                'price_per_day' => 80,
                'image_url' => 'https://images.unsplash.com/photo-1622297845775-5ff3fef71d13?q=80&w=707&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Electrónica'
            ],
            [
                'title' => 'Laptop HP Core i7',
                'description' => 'Laptop rápida ideal para trabajo o universidad.',
                'price_per_day' => 90,
                'image_url' => 'https://images.unsplash.com/photo-1593642702821-c8da6771f0c6?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Electrónica'
            ],
            [
                'title' => 'Proyector Epson HD',
                'description' => 'Proyector para películas o presentaciones.',
                'price_per_day' => 70,
                'image_url' => 'https://images.unsplash.com/photo-1535016120720-40c646be5580?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Electrónica'
            ],
            [
                'title' => 'Cámara Canon Profesional',
                'description' => 'Cámara ideal para fotografía profesional y eventos.',
                'price_per_day' => 100,
                'image_url' => 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Electrónica'
            ],
            [
                'title' => 'Silla Gamer Ergonómica',
                'description' => 'Silla cómoda para gaming o escritorio.',
                'price_per_day' => 40,
                'image_url' => 'https://images.unsplash.com/photo-1670946839270-cc4febd43b09?q=80&w=688&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Hogar'
            ],
            [
                'title' => 'Juego de comedor (6 sillas)',
                'description' => 'Mesa y sillas para eventos o reuniones familiares.',
                'price_per_day' => 150,
                'image_url' => 'https://plus.unsplash.com/premium_photo-1675744019321-f90d6d719da7?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Hogar'
            ],
            [
                'title' => 'Refrigeradora Whirlpool',
                'description' => 'Refrigeradora grande ideal para casa o eventos.',
                'price_per_day' => 200,
                'image_url' => 'https://images.unsplash.com/photo-1721613877687-c9099b698faa?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Hogar'
            ],
            [
                'title' => 'Vestido elegante para eventos',
                'description' => 'Vestido perfecto para bodas o graduaciones.',
                'price_per_day' => 70,
                'image_url' => 'https://images.unsplash.com/photo-1499939667766-4afceb292d05?q=80&w=1173&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Ropa'
            ],
            [
                'title' => 'Traje formal completo',
                'description' => 'Traje formal para reuniones, bodas o entrevistas.',
                'price_per_day' => 85,
                'image_url' => 'https://images.unsplash.com/photo-1593032465175-481ac7f401a0?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Ropa'
            ],
            [
                'title' => 'Equipo de sonido para fiestas',
                'description' => 'Bocinas y micrófono para eventos y fiestas.',
                'price_per_day' => 180,
                'image_url' => 'https://plus.unsplash.com/premium_photo-1680955436131-52b6d11cf6b8?q=80&w=765&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Electrónica'
            ],
            [
                'title' => 'Mesa de ping pong',
                'description' => 'Mesa ideal para entretenimiento en casa o eventos.',
                'price_per_day' => 110,
                'image_url' => 'https://images.unsplash.com/photo-1708268418738-4863baa9cf72?q=80&w=1214&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Deportes'
            ],
            [
                'title' => 'Scooter eléctrico',
                'description' => 'Scooter moderno y rápido para moverte en la ciudad.',
                'price_per_day' => 95,
                'image_url' => 'https://images.unsplash.com/photo-1597260491619-bab87197869f?q=80&w=626&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Vehículos'
            ],
            [
                'title' => 'Generador eléctrico',
                'description' => 'Ideal para emergencias o eventos al aire libre.',
                'price_per_day' => 160,
                'image_url' => 'https://images.unsplash.com/photo-1658260867231-535a1f7c98b9?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Herramientas'
            ],
            [
                'title' => 'Máquina para hacer waffles',
                'description' => 'Perfecta para desayunos y eventos familiares.',
                'price_per_day' => 30,
                'image_url' => 'https://images.unsplash.com/photo-1572336124661-f84d79b15136?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category' => 'Hogar'
            ],
        ];

        foreach ($products as $p) {

            $category = $categories->where('name', $p['category'])->first();

            Product::create([
                'user_id' => $user->id,
                'category_id' => $category ? $category->id : null,
                'title' => $p['title'],
                'description' => $p['description'],
                'price_per_day' => $p['price_per_day'],
                'image_url' => $p['image_url'],
                'is_available' => true,
                'is_approved' => true
            ]);
        }
    }
}
