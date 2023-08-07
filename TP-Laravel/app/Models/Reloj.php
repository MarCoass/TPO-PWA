<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reloj extends Model
{

    protected $table = 'reloj'; // Nombre de la tabla asociada al modelo

    protected $primaryKey = 'idReloj'; // Nombre del id de la tabla (Importante)

    protected $fillable = ['idReloj','idCompetencia','idCategoria','idCompetenciaCompetidor','cantJueces','overtime','estado']; // Atributos
    
    public function competencia()
    {
        return $this->belongsTo(Competencia::class, 'idCompetencia', 'idCompetencia');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'idCategoria', 'idCategoria');
    }

    public function competenciaCompetidor()
    {
        return $this->belongsTo(CompetenciaCompetidor::class, 'idCompetenciaCompetidor', 'idCompetenciaCompetidor');
    }
}
