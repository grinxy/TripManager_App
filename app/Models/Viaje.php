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
}
