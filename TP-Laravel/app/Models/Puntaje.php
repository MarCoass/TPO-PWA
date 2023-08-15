<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntaje extends Model
{
    use HasFactory;
    protected $table='puntajes';

    protected $primaryKey = 'idPuntaje';

    protected $fillable = ['idCompetenciaCompetidor', 'idCompetenciaJuez', 'puntajePresentacion', 'puntajeExactitud', 'pasada', 'overtime', 'estadoPuntaje'];

    public function competenciaCompetidor()
    {
        return $this->belongsTo(CompetenciaCompetidor::class, 'idCompetenciaCompetidor', 'idCompetenciaCompetidor');
    }
    
    public function competenciaJuez()
    {
        return $this->belongsTo(CompetenciaCompetidor::class, 'idCompetenciaJuez', 'idCompetenciaJuez');
    }
}
