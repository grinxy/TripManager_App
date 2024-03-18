<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
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
		'estado' => 'required',
        'imagen' => 'required',
    ]);

        $viaje = new Viaje();
        $viaje->nombre = $request->input('nombre');
        $viaje->fecha_salida = $request->input('fecha_salida');
        $viaje->fecha_regreso = $request->input('fecha_regreso');
        $viaje->destino = $request->input('destino');
        $viaje->precio_persona = $request->input('precio_persona');
        $viaje->num_pax = $request->input('num_pax');
        $viaje->estado = $request->input('estado');
        $viaje->imagen = $request->input('imagen');

        $viaje->save();
        return view('viajes.message', ['msg'=>"Viaje creado correctamente"]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Viaje $viaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Viaje $viaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Viaje $viaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Viaje $viaje)
    {
        //
    }
}
