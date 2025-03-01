<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'identificacion', 'celular', 'ficha_id', 'rol_id'];
    public $timestamps = true;

    public function ficha(): BelongsTo{
        return $this->belongsTo(Ficha::class);//un usuario pertenece a una ficha
    }

    public function rol():BelongsTo{//Relacion uno a uno con rol
        return $this->belongsTo(Rol::class);//un usuario tiene un rol
    }

    public function prestamos():HasMany{
        return $this->hasMany(Prestamo::class, 'usuario_id');//un usuario puede tener varios prestamos 
    }

    public function historials():HasMany{
        return $this->hasMany(Historial::class);
    }

}
