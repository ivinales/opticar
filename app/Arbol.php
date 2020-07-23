<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arbol extends Model
{
    protected $table='Arbol';
    protected $fillable=['pregunta','resultado','nleft','nright','tipo'];
    public $timestamps=false;
}
