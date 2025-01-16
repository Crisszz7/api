<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_sede', 'numero_sede'];
    public $timestamps = false;

    public function usuariosSedes()
{
    return $this->hasMany(UsuarioSede::class, 'sede_id');
}

}
