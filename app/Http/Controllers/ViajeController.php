<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ViajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $destino = $request->destino_buscado;
        if ($destino == null) {
            $viajes = Viaje::all()->sortBy(['fecha_salida', 'desc']);
        } else {
            $viajes = Viaje::where('destino', 'LIKE', '%' . $destino . '%')->get()->sortBy(['fecha_salida', 'desc']);
        }

        return view('viajes.index', ['viajes' => $viajes, 'viajes_select' => Viaje::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('viajes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'fecha_salida' => 'required',
            'fecha_regreso' => 'required',
            'destino' => 'required|string',
            'precio_persona' => 'required',
            'num_pax' => 'required',
            'imagen' => 'required',
        ]);

        $viaje = new Viaje();
        $viaje->nombre = $request->input('nombre');
        $viaje->fecha_salida = $request->input('fecha_salida');
        $viaje->fecha_regreso = $request->input('fecha_regreso');
        $viaje->destino = $request->input('destino');
        $viaje->precio_persona = $request->input('precio_persona');
        $viaje->num_pax = $request->input('num_pax');
        $viaje->estado = 'no confirmado';
        $viaje->imagen = $request->input('imagen');


        $viaje->save();
        return view('viajes.message', ['msg' => "Viaje creado correctamente"]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $viaje = Viaje::find($id);
        $reservas = Reserva::where('id_viaje', $id)->get();
        $viajeros = Reserva::where('id_viaje', $id)->sum('num_pax');


        return view("viajes.show", ["viaje" => $viaje, "reservas" => $reservas, "viajeros" => $viajeros]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    { {
            $viaje = Viaje::find($id);

            return view("viajes.edit", ["viaje" => $viaje]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'fecha_salida' => 'required',
            'fecha_regreso' => 'required',
            'destino' => 'required|string',
            'precio_persona' => 'required',
            'num_pax' => 'required',
            'imagen' => 'required',
        ]);

        $viaje = Viaje::find($id);
        $viaje->nombre = $request->input('nombre');
        $viaje->fecha_salida = $request->input('fecha_salida');
        $viaje->fecha_regreso = $request->input('fecha_regreso');
        $viaje->destino = $request->input('destino');
        $viaje->precio_persona = $request->input('precio_persona');
        $viaje->num_pax = $request->input('num_pax');
        $viaje->estado = $this->updateEstado($id);
        $viaje->imagen = $request->input('imagen');

        $viaje->save();
        return view('viajes.message', ['msg' => "Viaje modificado correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $viaje = Viaje::find($id);
        $viaje->delete();

        return view('viajes.message', ['msg' => "Viaje eliminado correctamente"]);
    }

    public function updateEstado($id)
    {
        $viaje = Viaje::find($id);
        $viajeros = Reserva::where('id_viaje', $id)->sum('num_pax');

        if ($viajeros < 8) {
            $viaje->estado = 'No confirmado';
        } elseif ($viajeros < $viaje->num_pax) {
            $viaje->estado = 'Confirmado';
        } elseif ($viajeros == $viaje->num_pax) {
            $viaje->estado = 'Completo';
        }
        return $viaje->estado;
    }
}
