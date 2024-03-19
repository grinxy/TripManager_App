<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cliente = $request->nombre_cliente;

        // Filtrar las reservas según el nombre del cliente si se proporciona con WHEN de Eloquent
        $reservas = Reserva::when($cliente, function ($peticion, $cliente) {
            return $peticion->where('nombre_cliente', 'LIKE', '%' . $cliente . '%');
        })
            ->orderByDesc('fecha_reserva')
            ->paginate(10);

        // Formatear la fecha de reserva para cada reserva
        $reservas->each(function ($reserva) {
            $reserva->fecha_reserva = Carbon::parse($reserva->fecha_reserva)->format('Y-m-d');
        });

        return view('reservas.index', compact('reservas'));
    }

    /* Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id_viaje = $request->input('id_viaje');

        $viaje = null;
        $plazasMaximas = null;

        if ($id_viaje) {
            $viaje = Viaje::find(($id_viaje));
            $plazasMaximas = $viaje->plazas_disponibles;
        }
        //pasar a select solo viajes no completos
        $viajes_disponibles = Viaje::where('estado', '!=', 'completo')->get();

              // Guardar la URL desde la que se accede al formulario para poder volver tras exito
        Session::put('previous_url', URL::previous());


        return view('reservas.create', ['viajes' => $viajes_disponibles, 'viaje' => $viaje, "plazasMaximas" => $plazasMaximas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required|string',
            'num_pax' => 'required',
            'estado' => 'required',
            'id_viaje' => 'required',
        ]);

        //crear precio total viaje dsd servidor. En vista esta calculo para mostrar precio tambien
        $viaje = Viaje::findOrFail($request->input('id_viaje'));  //findOrFail (Eloquent) --> si no encuentra el viaje lanza excepcion
        $precioPersona = $viaje->precio_persona;
        $precioTotal = $precioPersona * $request->input('num_pax');


        $reserva = new Reserva();
        $reserva->nombre_cliente = $request->input('nombre_cliente');
        $reserva->num_pax = $request->input('num_pax');
        $reserva->precio_total = $precioTotal;
        $reserva->fecha_reserva = Carbon::today();
        $reserva->estado = $request->input('estado');
        $reserva->id_viaje = $request->input('id_viaje');

        $reserva->save();
        $viajeId = $reserva->id_viaje;
        $viaje = Viaje::findOrFail($viajeId);
        $viaje->updateEstado($viajeId);
        $viaje->updatePlazasDisponibles($viajeId);



       // URL anterior a la anterior desde la sesión
       $previousPreviousUrl = Session::get('previous_url');

       // Guardar la URL anterior a la anterior en la sesión
       Session::put('previous_url', $previousPreviousUrl);

        return view('reservas.message', ['msg' => "Reserva creada correctamente"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reserva = Reserva::find($id);
        $viajeId = $reserva->id_viaje;
        $viaje = Viaje::find($viajeId);
        $plazasMaximas =  $reserva->num_pax + $viaje->plazas_disponibles;


          // Guardar la URL desde la que se accede al formulario para poder volver tras exito
        Session::put('previous_url', URL::previous());

        return view("reservas.edit", ["reserva" => $reserva, "viaje" => $viaje, "plazasMaximas" => $plazasMaximas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_cliente' => 'required|string',
            'num_pax' => 'required',
            'estado' => 'required',
            'id_viaje' => 'required',
        ]);

        //crear precio total viaje dsd servidor. En vista esta calculo para mostrar precio tambien
        $viaje = Viaje::findOrFail($request->input('id_viaje'));  //findOrFail (Eloquent) --> si no encuentra el viaje lanza excepcion
        $precioPersona = $viaje->precio_persona;
        $precioTotal = $precioPersona * $request->input('num_pax');



        $reserva = Reserva::find($id);
        $reserva->nombre_cliente = $request->input('nombre_cliente');
        $reserva->num_pax = $request->input('num_pax');
        $reserva->precio_total = $precioTotal;
        $reserva->estado = $request->input('estado');
        $reserva->id_viaje = $request->input('id_viaje');

        $reserva->save();
        $viajeId = $reserva->id_viaje;
        $viaje = Viaje::findOrFail($viajeId);
        $viaje->updateEstado($viajeId);
        $viaje->updatePlazasDisponibles($viajeId);

        // Obtener la URL anterior a la anterior desde la sesión
        $previousPreviousUrl = Session::get('previous_url');

        // Guardar la URL anterior a la anterior en la sesión
        Session::put('previous_url', $previousPreviousUrl);


        return view('reservas.message', ['msg' => "Reserva modificada correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $reserva = Reserva::find($id);
        $reserva->delete();
        $viaje = Viaje::findOrFail($reserva->id_viaje);

        $viaje->updateEstado($reserva->id_viaje);
        $viaje->updatePlazasDisponibles($reserva->id_viaje);
        return redirect()->back();
    }
}
