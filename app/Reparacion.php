<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
    protected $table = 'reparacion';
    protected $fillable = ['rut_cliente','monto_total','patente_vehiculo'];
    protected $primaryKey = 'id';
}
