<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Herramienta extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_herramienta', 'codigo', 'stock', 'ubicacion', 'estado_herramienta' , 'detalle_herramienta', 'usuariosede_id'];

    
    public function prestamos():BelongsToMany
    {
        return $this->belongsToMany(Prestamo::class, 'herramienta_prestamo')->withPivot('cantidad');
    }

    public function usuarioSede():BelongsTo{
        return $this->belongsTo(UsuarioSede::class, 'usuariosede_id');
    }

    
}
