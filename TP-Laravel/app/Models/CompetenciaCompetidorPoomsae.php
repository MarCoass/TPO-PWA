<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenciaCompetidorPoomsae extends Model
{
    use HasFactory;

    protected $table = 'competenciacompetidorpoomsae';

    protected $primaryKey = 'idCompetenciaCompetidorPoomsae';

    protected $fillable = ['idCompetenciaCompetidor','idPoomsae','pasadas'];

    public function competencia_competidor()
    {
        return $this->belongsTo(CompetenciaCompetidor::class, 'idCompetenciaCompetidor', 'idCompetenciaCompetidor');
    }
    public function poomsae()
    {
        return $this->belongsTo(Poomsae::class, 'idPoomsae', 'idPoomsae');
    }
    
}
 