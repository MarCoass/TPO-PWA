<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelojCompJuez extends Model
{
    use HasFactory;

    protected $table = 'relojcompjuez'; // Nombre de la tabla asociada al modelo

    protected $primaryKey = 'id'; // Nombre del id de la tabla (Importante)

    protected $fillable = ['id', 'idReloj', 'idCompetenciaJuez']; // Atributos

    public function reloj(){
        return $this->belongsTo(Reloj::class, 'idReloj', 'idReloj');
    }

    public function competenciaJuez(){
        return $this->belongsTo(CompetenciaJuez::class, 'idCompetenciaJuez', 'idCompetenciaJuez');
    }
}