<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poomsae extends Model
{

    protected $table = 'poomsae'; // Nombre de la tabla asociada al modelo

    protected $primaryKey = 'idPoomsae'; // Nombre del id de la tabla (Importante)

    protected $fillable = ['nombre']; // Atributos

}
