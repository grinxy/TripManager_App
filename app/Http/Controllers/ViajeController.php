<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use Illuminate\Http\Request;

class ViajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viajes = Viaje::all()->sortBy(['fecha_salida', 'desc']);
        return view('viajes.index', ['viajes' => $viajes]);

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
