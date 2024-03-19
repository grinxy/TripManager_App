<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $viajes = Viaje::all();

        return view('reservas.create', ['viajes' => $viajes, 'id_viaje' => $id_viaje]);
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
    Viaje::updateEstado();
    return view('reservas.message', ['msg'=>"Reserva creada correctamente"]);
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
        return view("reservas.edit", ["reserva"=> $reserva, "viajes" => Viaje::all()]);
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

    Viaje::updateEstado();
    $reserva->save();
    return view('reservas.message', ['msg'=>"Reserva modificada correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $reserva = Reserva::find($id);
        $reserva->delete();
        $viaje = Viaje::findOrFail($reserva->id_viaje);

        Viaje::updateEstado();
        return redirect('reservas');
    }
}
