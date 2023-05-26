<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenciaCompetidor extends Model
{
    use HasFactory;

    protected $table = 'competenciaCompetidor';

    protected $fillable = ['idCompetencia' , 'idCompetidor', 'estado'];

    public function competencia()
    {
        return $this->belongsTo(Pais::class, 'idCompetencia', 'idCompetencia');
    }
    public function competidor()
    {
        return $this->belongsTo(Pais::class, 'idCompetidor', 'idCompetidor');
    }
}
