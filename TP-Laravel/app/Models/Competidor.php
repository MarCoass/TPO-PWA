<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competidor extends Model
{

    protected $table = 'competidores'; // Nombre de la tabla asociada al modelo

    protected $primaryKey = 'idCompetidor'; // Nombre del id de la tabla (importante)

    protected $fillable = ['gal', 'apellido', 'nombre', 'du', 'fechaNacimiento', 'ranking', 'idGraduacion', 'email', 'genero', 'idEstado', 'idPais', 'idUser', 'estado' ]; // Atributos

    //protected $hidden = ['clave']; // Atributos ocultos al serializar el modelo

    // Relación con la clase Rol y clave foránea
    public function graduacion()
    {
        return $this->belongsTo(Graduacion::class, 'idGraduacion', 'idGraduacion');
    }
    
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
