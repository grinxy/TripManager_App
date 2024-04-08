<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $viajes = [
            [
                'id' => 1,
                'nombre' => 'Colores de Barcelona',
                'fecha_salida' => '2024-07-15',
                'fecha_regreso' => '2024-07-20',
                'destino' => 'Barcelona',
                'precio_persona' => 150,
                'num_pax' => 12,
                'estado' => 'no confirmado',
                'imagen' => 'https://www.spain.info/.content/imagenes/cabeceras-grandes/cataluna/park-guell-barcelona-s-305364611.jpg',

            ],
            [
                'id' => 2,
                'nombre' => 'Asturias gastronómica',
                'fecha_salida' => '2024-04-15',
                'fecha_regreso' => '2024-04-23',
                'destino' => 'Asturias',
                'precio_persona' => 2500,
                'num_pax' => 12,
                'estado' => 'no confirmado',
                'imagen' => 'https://www.civitatis.com/blog/wp-content/uploads/2022/10/asturias-fin-semana.jpg',
            ],
            [
                'id' => 3,
                'nombre' => 'Maravillas de Madrid',
                'fecha_salida' => '2024-05-10',
                'fecha_regreso' => '2024-05-20',
                'destino' => 'Madrid',
                'precio_persona' => 1800,
                'num_pax' => 12,
                'estado' => 'no confirmado',
                'imagen' => 'https://www.spain.info/.content/imagenes/cabeceras-grandes/madrid/calle-gran-via-madrid-s333961043.jpg',
            ],
            [
                'id' => 4,
                'nombre' => 'Descubre Sevilla',
                'fecha_salida' => '2024-08-05',
                'fecha_regreso' => '2024-08-10',
                'destino' => 'Sevilla',
                'precio_persona' => 1200,
                'num_pax' => 12,
                'estado' => 'no confirmado',
                'imagen' => 'https://cdn.getyourguide.com/img/tour/b203ad7fded51715.jpeg/146.jpg',
            ],
            [
                'id' => 5,
                'nombre' => 'Costa del Sol',
                'fecha_salida' => '2024-09-10',
                'fecha_regreso' => '2024-09-20',
                'destino' => 'Málaga',
                'precio_persona' => 1600,
                'num_pax' => 12,
                'estado' => 'no confirmado',
                'imagen' => 'https://media-cdn.tripadvisor.com/media/photo-s/19/5e/68/d9/the-costadelsol-is-a.jpg',
            ],
        ];

        foreach ($viajes as $viaje) {
            DB::table('viajes')->insert([
                'id' => $viaje['id'],
                'nombre' => $viaje['nombre'],
                'fecha_salida' => $viaje['fecha_salida'],
                'fecha_regreso' => $viaje['fecha_regreso'],
                'destino' => $viaje['destino'],
                'precio_persona' => $viaje['precio_persona'],
                'num_pax' => $viaje['num_pax'],
                'estado' => $viaje['estado'],
                'imagen' => $viaje['imagen'],
            ]);
        }
    }
}
