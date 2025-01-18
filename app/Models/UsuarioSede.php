<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsuarioSede extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuario_sedes';

    protected $fillable = [
        'username',
        'contrasena',
        'sede_id',
    ];

    protected $hidden = [
        'contrasena', 
        'remember_token',
    ];


    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }


}



