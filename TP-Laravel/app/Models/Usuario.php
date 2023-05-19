<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios'; // Nombre de la tabla asociada al modelo

    protected $fillable = ['nombre', 'apellido', 'usuario', 'correo', 'clave', 'idRol']; // Atributos

    //protected $hidden = ['clave']; // Atributos ocultos al serializar el modelo

    public function tieneRol($rol)
    {
        return $this->rol && $this->rol->nombreRol === $rol;
    }

    // Relación con la clase Rol y clave foránea
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'idRol');
    }
}
