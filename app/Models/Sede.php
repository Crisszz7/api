<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sede extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_sede', 'numero_sede'];
    public $timestamps = false;

        public function usuarioSedes()
    {
        return $this->hasMany(UsuarioSede::class, 'sede_id');
    }

    public function usuarioSede():BelongsTo{
        return $this->belongsTo(UsuarioSede::class, 'usuariosede_id');
    }


}
