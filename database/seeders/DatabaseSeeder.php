<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'Perros' => [
                ['Croquetas premium para perro', 589, 'Alimento completo para perros adultos.', 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee'],
                ['Correa ajustable', 189, 'Correa resistente para paseos diarios.', 'https://images.unsplash.com/photo-1601758228041-f3b2795255f1'],
                ['Cama acolchada', 749, 'Cama cómoda y lavable para descansar.', 'https://images.unsplash.com/photo-1541599540903-216a46ca1dc0'],
            ],
            'Gatos' => [
                ['Alimento para gato', 429, 'Nutrición balanceada para gatos adultos.', 'https://images.unsplash.com/photo-1573865526739-10659fec78a5'],
                ['Rascador para gato', 899, 'Rascador para juego y cuidado de uñas.', 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba'],
                ['Juguete interactivo', 149, 'Diversión para estimular a tu gato.', 'https://images.unsplash.com/photo-1511044568932-338cba0ad803'],
            ],
            'Accesorios' => [
                ['Plato doble', 219, 'Plato práctico para agua y alimento.', 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee'],
                ['Transportadora', 679, 'Transportadora cómoda para viajes.', 'https://images.unsplash.com/photo-1601758123927-196e2f9e6c1b'],
            ],
        ];

        foreach ($items as $categoryName => $products) {
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($categoryName)],
                ['name' => $categoryName, 'description' => 'Productos para '.$categoryName]
            );
            foreach ($products as $i => $item) {
                Product::updateOrCreate(
                    ['slug' => Str::slug($item[0])],
                    ['category_id' => $category->id, 'name' => $item[0], 'price' => $item[1],
                     'description' => $item[2], 'image_url' => str_replace('一', '1', $item[3]),
                     'stock' => 25, 'featured' => $i < 2, 'active' => true]
                );
            }
        }
    }
}
