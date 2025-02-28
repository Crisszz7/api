<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Historial extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'prestamo_id', 'estado', 'usuariosede_id',];
    public $timestamps = true;

    public function usuario():BelongsTo{
        return $this->belongsTo(Usuario::class);
    }

    public function prestamo():BelongsTo{
        return $this->belongsTo(Prestamo::class);//un historial pertenece a un prestamo
    }

    public function usuarioSede():BelongsTo{
        return $this->belongsTo(UsuarioSede::class, 'usuariosede_id');
    }


}
