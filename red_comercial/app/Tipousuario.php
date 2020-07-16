<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipousuario extends Model
{
    protected $table = 'tipousuario';
    protected $fillable = ['rol', 'descripcion', 'condicion'];

    public function users(){
        return $this.hasMany('App\User');
    }
}
