<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Nombre de la tabla asociada al modelo

    protected $primaryKey = 'idRol';

    protected $fillable = ['nombreRol']; // Atributos


    public function users()
{
    return $this->hasMany(User::class);
}


}
