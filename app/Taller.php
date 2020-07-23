<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reserva;
class Taller extends Model
{
    protected $table = 'taller';
    protected $fillable = ['nombre','direccion','color','estado'];
    protected $primaryKey = 'id';
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
