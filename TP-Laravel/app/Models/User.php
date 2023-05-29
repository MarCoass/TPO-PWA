<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Rol;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
/*     protected $fillable = ['nombre', 'apellido', 'usuario', 'correo', 'clave', 'idRol']; // Atributos
 */
    protected $fillable = ['id', 'nombre', 'apellido', 'usuario', 'correo', 'password', 'idRol', 'estado']; // Atributos

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    // Relación con la clase Rol y clave foránea
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function tieneRol($rol)
    {
        return $this->rol && $this->rol->nombreRol === $rol;
    }

    // Relación con la clase Competidor
    public function competidor()
    {
    return $this->hasMany(Competidor::class, 'id', 'idUser');
    }


}
