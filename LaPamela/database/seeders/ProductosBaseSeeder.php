<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductosBaseSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
                'id' => 1,
                'nombre' => 'Vela Procesional',
                'descripcion' => 'Vela blanca de cera pura para procesiones.',
                'precio' => 15.00,
                'imagen' => 'https://s10.s3c.es/imag/_v0/1600x873/a/a/c/ceraruso.jpeg'
            ],
            [
                'id' => 2,
                'nombre' => 'Incienso Premium',
                'descripcion' => 'Incienso tradicional de Semana Santa.',
                'precio' => 9.99,
                'imagen' => 'https://palaciodeincienso.com/cdn/shop/files/PACKSEMANASANTAENSEVILLA.jpg?v=1694464327'
            ],
            [
                'id' => 3,
                'nombre' => 'Mantilla Española',
                'descripcion' => 'Mantilla negra bordada para celebraciones religiosas.',
                'precio' => 89.00,
                'imagen' => 'https://images.ecestaticos.com/FljfWOexuoxoFalhzAaP1-WwBZI=/0x0:2272x1556/1200x900/filters:fill(white):format(jpg)/f.elconfidencial.com%2Foriginal%2F9e0%2F3fb%2F024%2F9e03fb024161f82c8c5a1968fee15558.jpg'
            ]
        ];

        foreach ($productos as $producto) {
            Product::updateOrCreate(
                ['id' => $producto['id']],
                $producto
            );
        }
    }
}
