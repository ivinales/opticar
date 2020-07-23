<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = 'cotizacion';
    protected $fillable = ['rut_cliente','monto_total','patente_vehiculo'];
    protected $primaryKey = 'id';

}
