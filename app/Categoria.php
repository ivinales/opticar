<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = ['nombre','descipcion','condicion'];

    public function producto(){

        return $this->hasMany("App\Producto");
    }
}
