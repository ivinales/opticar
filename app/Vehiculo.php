<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehiculo extends Model
{
    protected $table = 'vehiculo';
    protected $fillable = ['marca','modeloVehiculo','patente','anio','kilometraje','aceite'];
    protected $primaryKey = 'id';
}
