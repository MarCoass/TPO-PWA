<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaGraduacion extends Model
{
    use HasFactory;
    
    protected $table = 'categoriagraduacion';

    protected $primaryKey = 'idCategoriaGraduacion';

    protected $fillable = ['idCategoria ','idGraduacion'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'idCategoria', 'idCategoria');
    }

    public function graduacion()
    {
        return $this->belongsTo(Graduacion::class, 'idGraduacion', 'idGraduacion');
    }
}
