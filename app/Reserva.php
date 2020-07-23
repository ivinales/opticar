<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Taller;
class Reserva extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taller()
    {
        return $this->belongsTo(Taller::class);
    }
}

