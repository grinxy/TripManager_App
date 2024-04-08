<?php

namespace Database\Seeders;
use App\Models\Reserva;
use App\Models\Viaje;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {



        // Sembrar los viajes y las reservas
        $this->call(ViajeSeeder::class);
        $this->call(ReservaSeeder::class);

        // Actualizar las plazas después de sembrar las reservas
        $viajes = Viaje::all();
        foreach ($viajes as $viaje) {
            $this->updatePlazas($viaje);
        }
    }

    //actualizar plazas disponibles tras insertar reservas
    private function updatePlazas($viaje)
    {


        $plazas_totales = $viaje->num_pax;

        $viaje_id = $viaje->id;
        $viajeros = Reserva::where('id_viaje', $viaje_id)->sum('num_pax');

        $plazas_disponibles = $plazas_totales - $viajeros;

        $viaje->plazas_disponibles = $plazas_disponibles;
        $viaje->save();
    }
}
