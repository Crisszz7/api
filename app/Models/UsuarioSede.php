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
        'email',
        'password',
        'sede_id',

    ];

    protected $hidden = [
        'password', 
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

    public function ambientes(): HasMany
    {
        return $this->hasMany(Ambiente::class, 'usuariosede_id');
    }

    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class, 'usuariosede_id');
    }
    public function historials(): HasMany
    {
        return $this->hasMany(Historial::class, 'usuariosede_id');
    }
}


