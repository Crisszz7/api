<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class UsuarioSede extends Authenticatable 
{
    use HasFactory, HasApiTokens, Notifiable; 

    protected $table = 'usuario_sedes';

    protected $fillable = [
        'username',
        'correo',
        'contrasena',
        'sede_id',

    ];

    protected $hidden = [
        'contrasena', 
        'remember_token',
    ];    

    public function getEmailForPasswordReset()
    {
        return $this->correo;
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }


}



