<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

    protected $table = 'estados'; // Nombre de la tabla asociada al modelo

    protected $primaryKey = 'idEstado'; // Nombre del id de la tabla (Importante)

    protected $fillable = ['nombreEstado']; // Atributos

    //protected $hidden = ['clave']; // Atributos ocultos al serializar el modelo

    // Relación con la clase Usuario
    public function competidor()
    {
        return $this->hasMany(Competidor::class, 'idEstado');
    }

}
