<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    use HasFactory;

    protected $table = 'competencias';

    protected $primaryKey = 'idCompetencia';

    protected $fillable = ['nombre','fecha', 'flyer', 'bases', 'invitacion'];
}
