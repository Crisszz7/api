<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ambiente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_ambiente', 'codigo', 'disponible', 'usuariosede_id'];
    protected $casts = ['disponible' => 'boolean'];
    public $timestamps = false;

    public function prestamo():HasOne
    {
        return $this->hasOne(Prestamo::class);
    }

    public function usuarioSede():BelongsTo{
        return $this->belongsTo(UsuarioSede::class, 'usuariosede_id');
    }

}
