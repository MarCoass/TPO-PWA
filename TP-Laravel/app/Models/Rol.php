<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles'; // Nombre de la tabla asociada al modelo

    protected $primaryKey = 'idRol';

    protected $fillable = ['nombreRol']; // Atributos

    // Relación con la clase Usuario
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'idRol');
    }
}
