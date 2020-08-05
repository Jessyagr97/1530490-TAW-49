<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'idrol', 'nombre', 'apellido_p', 'apellido_m', 'telefono', 'email', 'password', 'image_profile', 'condicion',
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rol(){
        return $this.belongsTo('App\Tipousuario');
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
