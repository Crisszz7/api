<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ficha extends Model
{
    use HasFactory;

    protected $fillable =['nombre_ficha', 'numero_ficha', 'usuariosede_id'];

    public $timestamps = true;

    public function usuarios():HasMany
    {
        return $this->hasMany(Usuario::class);  // una ficha tiene varios usuarios
    }

    public function usuarioSede():BelongsTo{
        return $this->belongsTo(UsuarioSede::class, 'usuariosede_id');
    }

}
