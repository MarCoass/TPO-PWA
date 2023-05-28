<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduacion extends Model
{
    use HasFactory;

    protected $table = 'graduaciones';

    protected $privateKey = 'idGraduacion';

    protected $fillable = ['idGraduacion', 'nombre', 'color' , 'tipo'];

    // Relación con la clase Competidor
    public function competidor()
    {
        return $this->hasMany(Competidor::class, 'idGraduacion');
    }
}
