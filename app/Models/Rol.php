<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $fillable = ['tipo'];
    public $timestamps = false;

    public function usuarios():HasMany
    {
        return $this->hasMany(Usuario::class);  // un rol tiene varios usuarios
    }
}
