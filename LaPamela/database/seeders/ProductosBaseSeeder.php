<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductosBaseSeeder extends Seeder
{
    public function run(): void
    {
   $productos = [
            // COSTAL
            [ 'id' => 1, 'nombre' => 'Costal doble trama', 'descripcion' => 'Perfecto para iniciarte en el mundo del costal', 'precio' => 20.00, 'imagen' => '...\public\images\costalTrama.png'],
            [ 'id' => 2, 'nombre' => 'Costal saco de café original', 'descripcion' => 'Costal de un material duradero perfecto para sacar las procesiones', 'precio' => 35.00, 'imagen' => '...\public\images\costalCafe.png'],
            [ 'id' => 3, 'nombre' => 'Faja elástica', 'descripcion' => 'Faja que asegura el cuidado de sus riñones', 'precio' => 10.00, 'imagen' => '...\public\images\faja.png'],
            [ 'id' => 4, 'nombre' => 'Pantalón costalero multibolsillo', 'descripcion' => 'Pantalón homologado para las salidas', 'precio' => 7.00, 'imagen' => '...\public\images\pantalón.png'],
            [ 'id' => 5, 'nombre' => 'Morcilla', 'descripcion' => 'Perfecta para cuidar el cuello en las procesiones', 'precio' => 12.00, 'imagen' => '...\public\images\morcilla.png'],
            [ 'id' => 6, 'nombre' => 'Calcetín', 'descripcion' => 'Calcetín blanco para complementar tu indumentaria', 'precio' => 5.00, 'imagen' => '...\public\images\calcetin.jppngg'],

            // MÚSICA
            [ 'id' => 7, 'nombre' => 'Corneta do/reb', 'descripcion' => 'Corneta en do/reb dorada', 'precio' => 200.00, 'imagen' => '...\public\images\cornetaDo.png'],
            [ 'id' => 8, 'nombre' => 'Corneta sib', 'descripcion' => 'Corneta sib plateada', 'precio' => 200.00, 'imagen' => '...\public\images\cornetaSib.jpg'],
            [ 'id' => 9, 'nombre' => 'Trompeta en Do', 'descripcion' => 'Trompeta en Do plateada', 'precio' => 260.00, 'imagen' => '...\public\images\trompetaDo.png'],
            [ 'id' => 10, 'nombre' => 'Caja Royal', 'descripcion' => 'Caja para agrupación musical.', 'precio' => 320.00, 'imagen' => '...\public\images\caja.jpg'],
            [ 'id' => 11, 'nombre' => 'Tuba', 'descripcion' => 'Tuba dorada para iniciación.', 'precio' => 8000.00, 'imagen' => '...\public\images\tuba.png'],
            [ 'id' => 12, 'nombre' => 'Trombón', 'descripcion' => 'Trombón Yamaha perfecto para el disfrute en las procesiones', 'precio' => 2500.00, 'imagen' => '...\public\images\trombón.jfif'],

            // ACCESORIOS
            [ 'id' => 13, 'nombre' => 'Inciensiario', 'descripcion' => 'Inciensiario cofrade miniatura', 'precio' => 25.00, 'imagen' => '...\public\images\inciensiario.png'],
            [ 'id' => 14, 'nombre' => 'Mantilla', 'descripcion' => 'Mantilla mujer', 'precio' => 180.00, 'imagen' => '...\public\images\mantilla.jpg'],
            [ 'id' => 15, 'nombre' => 'Mantolín corneta banda del Sol', 'descripcion' => 'Mantolín para corneta de la banda de Nuestra Señora del Sol', 'precio' => 110.00, 'imagen' => '...\public\images\descarga.png'],
            [ 'id' => 16, 'nombre' => 'Baquetas ébano', 'descripcion' => 'Baquetas para tambor de ébano', 'precio' => 45.00, 'imagen' => '...\public\images\baquetasEbano.jpg'],
            [ 'id' => 17, 'nombre' => 'Cirio', 'descripcion' => 'Cirio nazareno en miniatura', 'precio' => 10.00, 'imagen' => '...\public\images\cirio.png'],
            [ 'id' => 18, 'nombre' => 'Paso miniatura de "El Cachorro"', 'descripcion' => 'Paso en miniatura escala 1:1', 'precio' => 245.00, 'imagen' => '...\public\images\pasoCachorro.png'],
        ];


        foreach ($productos as $producto) {
            Product::updateOrCreate(
                ['id' => $producto['id']],
                $producto
            );
        }
    }
}
