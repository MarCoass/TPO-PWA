<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenciaCompetidor extends Model
{
    use HasFactory;

    protected $table = 'competenciacompetidor';

    protected $primaryKey = 'idCompetenciaCompetidor';

    protected $fillable = ['idCompetencia' , 'idCompetidor','idPoomsae', 'estado'];

    public function competencia()
    {
        return $this->belongsTo(Competencia::class, 'idCompetencia', 'idCompetencia');
    }
    public function competidor()
    {
        return $this->belongsTo(Competidor::class, 'idCompetidor', 'idCompetidor');
    }

    public function poomsae()
    {
        return $this->belongsTo(Poomsae::class, 'idPoomsae', 'idPoomsae');
    }
}
