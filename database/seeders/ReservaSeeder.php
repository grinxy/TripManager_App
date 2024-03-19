<?php
namespace Database\Seeders;
        use App\Models\Reserva;
        use App\Models\Viaje;
        use Illuminate\Database\Seeder;
        use Illuminate\Support\Facades\DB;
        use Carbon\Carbon;

        class ReservaSeeder extends Seeder
        {
            public function run()
            {
                // Obtener el ID de un viaje existente para asociar las reservas
                $idViaje = DB::table('viajes')->pluck('id')->first();

                // Array de reservas
                $reservas = [
                    [

                        'nombre_cliente' => 'Antonio J.',
                        'num_pax' => 2,
                        'precio_total'=> '300',
                        'fecha_reserva'=> '2024-02-17',
                        'estado' => 'reservada',
                        'id_viaje'=> 9,
                    ],
                    [
                        'nombre_cliente' => 'Maria Luisa',
                        'num_pax' => 1,
                        'precio_total'=> '2500',
                        'fecha_reserva'=> '2024-02-29',
                        'estado' => 'reservada',
                        'id_viaje'=> 10,
                    ],
                    [
                        'nombre_cliente' => 'Juana',
                        'num_pax' => 3,
                        'precio_total'=> '3600',
                        'fecha_reserva'=> '2024-03-12',
                        'estado' => 'pagada',
                        'id_viaje'=> 8,
                    ],
                    [
                        'nombre_cliente' => 'Pedro',
                        'num_pax' => 5,
                        'precio_total'=> '750',
                        'fecha_reserva'=> '2024-03-02',
                        'estado' => 'pagada',
                        'id_viaje'=> 8,
                    ],
                    [
                        'nombre_cliente' => 'Simona',
                        'num_pax' => 2,
                        'precio_total'=> '3000',
                        'fecha_reserva'=> '2024-03-10',
                        'estado' => 'reservada',
                        'id_viaje'=> 11,
                    ],
                    [
                        'nombre_cliente' => 'Diego',
                        'num_pax' => 1,
                        'precio_total'=> '1600',
                        'fecha_reserva'=> '2024-03-14',
                        'estado' => 'pagada',
                        'id_viaje'=> 12,
                    ],
                ];
                foreach ($reservas as $reserva) {
                    DB::table('reservas')->insert([
                        'nombre_cliente' => $reserva['nombre_cliente'],
                        'num_pax' => $reserva['num_pax'],
                        'precio_total' => $reserva['precio_total'],
                        'fecha_reserva' => $reserva['fecha_reserva'],
                        'estado' => $reserva['estado'],
                        'id_viaje' => $reserva['id_viaje'],


                    ]);
                }
   // Actualizar el estado de los viajes después de insertar las reservas
   $this->updateEstadoViajes();
}

// Método para actualizar el estado de los viajes
private function updateEstadoViajes()
{
    // Obtener todos los viajes
    $viajes = Viaje::all();

    // Iterar sobre cada viaje
    foreach ($viajes as $viaje) {
        // Obtener el número total de pasajeros para este viaje
        $viajeros = Reserva::where('id_viaje', $viaje->id)->sum('num_pax');

        // Actualizar el estado del viaje según el número total de pasajeros
        if ($viajeros < 8) {
            $viaje->estado = 'No confirmado';
        } elseif ($viajeros >= 8 && $viajeros < $viaje->num_pax) {
            $viaje->estado = 'Confirmado';
        } elseif ($viajeros == $viaje->num_pax) {
            $viaje->estado = 'Completo';
        }

        // Guardar el estado actualizado del viaje en la base de datos
        $viaje->save();
    }
}
}




