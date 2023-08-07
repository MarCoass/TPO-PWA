<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompetenciaJuez;

class Competencia extends Model
{
    use HasFactory;

    protected $table = 'competencias';

    protected $primaryKey = 'idCompetencia';

    protected $fillable = ['nombre','fecha', 'fechaCierra', 'flyer', 'bases', 'invitacion', 'cantidadJueces','estadoJueces', 'estadoCompetencia', 'estadoInscripcion'];

    public function competenciaJuez(){
        return $this->hasMany(CompetenciaJuez::class,  'idCompetencia', 'idCompetencia');
    }
}
