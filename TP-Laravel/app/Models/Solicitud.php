<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $primaryKey = 'idSolicitud';

    protected $fillable = ['idSolicitud , estadoSolicitud, newEscuela, newGraduacion, idUser, created_at'];


    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }

}
