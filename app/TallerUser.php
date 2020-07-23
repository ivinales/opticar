<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TallerUser extends Model
{
    protected $table = 'taller_user';
    protected $fillable = ['user_id','taller_id'];
    protected $primaryKey = 'id';
}
