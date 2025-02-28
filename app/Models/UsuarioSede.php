<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    public function herramientas(): HasMany
    {
        return $this->hasMany(Herramienta::class, 'usuariosede_id');

    }

    public function fichas(): HasMany
    {
        return $this->hasMany(Ficha::class, 'usuariosede_id');

    }
}


