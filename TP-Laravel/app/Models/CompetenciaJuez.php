<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenciaJuez extends Model
{
    use HasFactory;
    protected $table = 'competenciajueces';
    protected $primaryKey = 'idCompetenciaJuez';
    protected $fillable = ['idCompetencia', 'estado', 'idJuez'];

    public function competencia()
    {
        return $this->belongsTo(Competencia::class, 'idCompetencia', 'idCompetencia');
    }
    public function juez()
    {
        return $this->belongsTo(User::class, 'idJuez', 'id');
    }
}
