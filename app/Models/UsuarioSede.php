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
        'contrasena', // Cambia "password" por "contrasena"
        'sede_id',
    ];

    protected $hidden = [
        'contrasena', // Asegúrate de ocultar "contrasena"
        'remember_token',
    ];

    // Relación con la tabla sedes
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }


}



