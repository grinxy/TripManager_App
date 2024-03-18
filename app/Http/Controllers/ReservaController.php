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
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
