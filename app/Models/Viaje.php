<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'id_viaje', 'id');
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

}
