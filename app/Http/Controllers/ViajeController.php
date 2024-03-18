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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $viaje = Viaje::find($id);

            return view("viajes.show", ["viaje"=> $viaje]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        {
            $viaje = Viaje::find($id);
            var_dump($viaje);
            return view("viajes.edit", ["viaje"=> $viaje]);
        }
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
