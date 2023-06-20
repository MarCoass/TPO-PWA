<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $primaryKey = 'id';

    protected $fillable = ['id, type, notifiable_type, notifiable_id, data, read_at, created_at'];


    public function user()
    {
        return $this->belongsTo(User::class, 'notifiable_id', 'id');
    }

}
