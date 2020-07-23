<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCotizacion extends Model
{
    protected $table = 'detalle_cotizacion';
    protected $fillable = ['id_cotizacion','repuesto','mantencion','costo','observacion'];
    protected $primaryKey = 'id';
}
