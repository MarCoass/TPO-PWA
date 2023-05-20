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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /* se especifican las validaciones  */
        return [
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'usuario' => 'required|unique:users,usuario',
            'correo' => 'required|email:rfc,dns|unique:users,correo',
            'password' => 'required|min:8',
            'confirmacion_clave' => 'required|same:password'
        ];
    }
}
