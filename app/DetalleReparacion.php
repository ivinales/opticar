<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleReparacion extends Model
{
    protected $table = 'detalle_reparacion';
    protected $fillable = ['id_reparacion','repuesto','mantencion','costo','observacion','estado'];
    protected $primaryKey = 'id';
}
