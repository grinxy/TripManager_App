<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Viaje extends Model
{

    protected $dateFormat = 'Y-m-d';
    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'id_viaje', 'id');
    }

    public function getImagenUrlAttribute()
    {
        return asset('storage/' . $this->imagen);
    }

    public function estadoColorClass()
{
    switch ($this->estado) {
        case 'no confirmado':
            return 'badge badge-pill bg-warning text-white';
        case 'confirmado':
            return 'badge badge-pill bg-success text-white';
        case 'completo':
            return 'badge badge-pill bg-danger text-white';
    }
}
    public function updatePlazasDisponibles($id)
    {

        $viaje = Viaje::find($id);
        $viajeros = Reserva::where('id_viaje', $id)->sum('num_pax');

        $plazas_disponibles = $this->num_pax - $viajeros;
        $viaje->plazas_disponibles = $plazas_disponibles;
        $viaje -> save();

    return $viaje->plazas_disponibles;

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

    $viaje->save();
    return $viaje->estado;
    }

}
