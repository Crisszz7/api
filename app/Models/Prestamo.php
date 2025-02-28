<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id','identificacion' ,'herramienta_id','ambiente_id', 'codigo_herramienta', 'codigo_ambiente',
    'cantidad', 'estado_prestamo','observaciones', 'usuariosede_id'];

    public $timestamps = true;

    public function usuario():BelongsTo{
        return $this->belongsTo(Usuario::class);//un prestamo pertene a un solo usuario
    }

    public function herramientas():BelongsToMany{
        return $this->belongsToMany(Herramienta::class, 'herramienta_prestamo')->withPivot('cantidad');//una herramienta puede estar en muchos prestamos
    }

    public function ambiente():BelongsTo{
        return $this->belongsTo(Ambiente::class);//un ambiente solo puede estar en un prestamo a la vez
    }

    public function historial():HasOne{
        return $this->hasOne(Historial::class);//un prestamo esta relacionado a un historial
    }
    public function usuarioSede():BelongsTo{
        return $this->belongsTo(UsuarioSede::class, 'usuariosede_id');
    }
}
