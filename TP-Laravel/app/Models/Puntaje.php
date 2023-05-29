<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntaje extends Model
{
    use HasFactory;
    protected $table='puntajes';

    protected $primaryKey = 'idPuntaje';

    protected $fillable = ['idCompetenciaCompetidor', 'idCompetenciaJuez', 'puntajePresentacion', 'puntajeExactitud', 'pasada', 'overtime'];

    public function competenciaCompetidor()
    {
        return $this->hasMany(CompetenciaCompetidor::class, 'idCompetenciaCompetidor');
    }

    
    public function competenciaJuez()
    {
        return $this->hasMany(CompetenciaJuez::class, 'idCompetenciaJuez');
    }
}
