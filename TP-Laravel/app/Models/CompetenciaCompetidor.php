<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenciaCompetidor extends Model
{
    use HasFactory;

    protected $table = 'competenciacompetidor';

    protected $primaryKey = 'idCompetenciaCompetidor';

    protected $fillable = ['idCompetencia' , 'idCompetidor','idCategoria', 'estado','puntaje'];

    public function competencia()
    {
        return $this->belongsTo(Competencia::class, 'idCompetencia', 'idCompetencia');
    }
    public function competidor()
    {
        return $this->belongsTo(Competidor::class, 'idCompetidor', 'idCompetidor');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'idCategoria', 'idCategoria');
    }

    public function puntajes()
    {
        return $this->hasMany(Puntaje::class,  'idPuntaje', 'idPuntaje');
    }
    
}
