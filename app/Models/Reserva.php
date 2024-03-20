<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';


    public function getEstadoAttribute($value)
{
    return match ($value) {
        'reservada' => 'Reserva hecha',
        'pagada' => 'Pagada',
        default => 'Desconocido',
    };
}
public function viaje()
{
      return $this->belongsTo(\App\Models\Viaje::class, 'id_viaje', 'id');
}

//pastillas color al estado de la reserva
public function estadoColorClass()
{
    switch ($this->estado) {
        case 'Reserva hecha':
            return 'badge badge-pill bg-warning text-white';
        case 'Pagada':
            return 'badge badge-pill bg-success text-white';
        default:
            return 'badge badge-pill bg-danger text-white';
    }
}
}
