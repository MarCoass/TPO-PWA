<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    
    protected $table = 'paises'; // Nombre de la tabla asociada al modelo

    protected $fillable = ['nombrePais', 'nomenclatura']; // Atributos

    //protected $hidden = ['clave']; // Atributos ocultos al serializar el modelo

    // Relación con la clase Usuario
    public function competidor()
    {
        return $this->hasMany(Competidor::class, 'idPais');
    }

}
