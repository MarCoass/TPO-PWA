<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competidor extends Model
{
    
    protected $table = 'competidores'; // Nombre de la tabla asociada al modelo

    protected $primaryKey = 'idCompetidor'; // Nombre del id de la tabla (importante)

    protected $fillable = ['gal', 'apellido', 'nombre', 'du', 'fechaNacimiento', 'ranking', 'graduacion', 'email', 'genero', 'idEstado', 'idPais', 'idUser' ]; // Atributos

    //protected $hidden = ['clave']; // Atributos ocultos al serializar el modelo
 
    // Relación con la clase Rol y clave foránea
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'idPais', 'idPais');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'idEstado', 'idEstado');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
    

}
