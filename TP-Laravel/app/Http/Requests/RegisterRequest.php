<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * toma las validaciones definidas por la funcio rules y lo que no coincida lo retorna
     * en un array, y muestra debajo de cada input lo controlado .
     *
     * @return array
     */
    public function rules()
    {
        /* se especifican las validaciones  */
        return [
            'nombre' => 'required|max:50|string',
            'apellido' => 'required|max:50|string',
            'usuario' => 'required|unique:users,usuario|max:50',
            'correo' => 'required|email:rfc,dns|unique:users,correo',
            'password' => 'required|min:8',
            'confirmacion_clave' => 'required|same:password',
            'idRol' => 'required'
        ];
    }
}
