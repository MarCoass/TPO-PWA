<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RolPermiso;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permisos'; // Nombre de la tabla asociada al modelo

    protected $primaryKey = 'idPermiso'; // Nombre del id de la tabla (Importante)

    protected $fillable = ['idPermiso', 'nombrePermiso', 'rutaPermiso']; // Atributos

    public function rolpermiso(){
        return $this->hasMany(RolPermiso::class, 'idPermiso', 'idPermiso');
    }
}
