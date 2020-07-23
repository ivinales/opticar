<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
     
    protected $table = 'clientes';

    protected $fillable=['nombre','apellido','tipo_documento','num_documento','direccion','telefono','email'];
}
