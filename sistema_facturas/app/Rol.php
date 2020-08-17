<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['rol', 'descripcion', 'condicion'];

    public function users(){
        return $this.hasMany('App\User');
    }
}
