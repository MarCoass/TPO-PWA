<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaPoomsae extends Model
{
    use HasFactory;
    
    protected $table = 'categoriapoomsae';

    protected $primaryKey = 'idCategoriaPoomsae';

    protected $fillable = ['idCategoria ','idPoomsae '];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'idCategoria', 'idCategoria');
    }

    public function poomsae()
    {
        return $this->belongsTo(Poomsae::class, 'idPoomsae ', 'idPoomsae ');
    }
}
