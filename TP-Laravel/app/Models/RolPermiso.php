<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolPermiso extends Model
{
    use HasFactory;

    protected $table = 'rolpermiso'; // Nombre de la tabla asociada al modelo

    protected $primaryKey = 'id'; // Nombre del id de la tabla (Importante)

    protected $fillable = ['id', 'idRol', 'idPermiso']; // Atributos

    public function rol(){
        return $this->belongsTo(Rol::class, 'idRol', 'id');
    }

    public function permiso(){
        return $this->belongsTo(Permiso::class, 'idPermiso', 'idPermiso');
    }
}