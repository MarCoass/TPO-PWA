<?php

/* 
La función de `loginRequest.php` es validar los datos de inicio de sesión del usuario. 
Es una clase que extiende la clase `FormRequest` y se utiliza para validar los datos de inicio de sesión 
antes de que se procesen en el controlador. 
*/

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;


/* 
La clase `LoginRequest` se utiliza para la validación. Si necesita personalizar la validación de inicio de sesión, 
puede modificar la clase `LoginRequest`.
*/

class LoginRequest extends FormRequest
{
    /**
     *  determinar si el usuario está autorizado para realizar una solicitud.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * se utiliza para definir las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'usuario' => 'required',
            'password' => 'required'
        ];
    }


    
    /**
     * 
     * se utiliza para obtener las credenciales de autorización necesarias de la solicitud. 
     * En este caso, la función `getCredentials()` se utiliza para obtener las credenciales de inicio de sesión del usuario. 
     * Si el usuario ha ingresado su correo electrónico en lugar de su nombre de usuario,
     * la función devuelve un arreglo que contiene el correo electrónico y la contraseña del usuario. 
     * De lo contrario, devuelve un arreglo que contiene solo el nombre de usuario y la contraseña.
     * 
     * resumen, te podes loguear con usuario o email
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getCredentials()
    {
        
        $usuario = $this->get('usuario');

        if ($this->isEmail($usuario)) {
            return [
                'correo' => $usuario,
                'password' => $this->get('password')
            ];
        }

        return $this->only('usuario', 'password');
    }

    
    /**
     * 
     * valida si el parametro provisto es un correo valido.
     *
     * @param $param
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function isEmail($param)
    {
        $factory = $this->container->make(ValidationFactory::class);

        return ! $factory->make(
            ['usuario' => $param],
            ['usuario' => 'Email']
            /* este campo   ^^^  es un verificador de email, no cambiar */
        )->fails();
    }

}

