<?php

/* habria que ver de cambiar el nombre a user, mas que nada por compatibilidad, cambiar lo necesario */

/* modificar campos: clave -> password  */

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use App\Models\Escuela;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('gestionUsuarios.index_usuarios', compact('usuarios'));
    }

    public function create()
    {
        $escuelas = Escuela::all();
        $roles = Rol::all();
        return view('gestionUsuarios.create_usuario', compact('escuelas', 'roles'));
    }

    public function store(Request $request)
    {
        try{
            $request->validate($this->rules());

            $usuario = new User();
            $usuario->nombre = $request->input('nombre');
            $usuario->apellido = $request->input('apellido');
            $usuario->usuario = $request->input('usuario');
            $usuario->correo = $request->input('correo');
            $usuario->password = $request->input('clave');
            $usuario->estado = true;
    
            // Rol
            $rol = Rol::find($request->input('rol'));
            $usuario->rol()->associate($rol);
    
            // Escuela
            $escuela = Escuela::find($request->input('idEscuela'));
            $usuario->escuela()->associate($escuela);
    
            $usuario->save();
    
            return redirect()->route('index_usuarios')->with('success', 'Usuario creado exitosamente.');
        }catch (\Illuminate\Validation\ValidationException $e){
            return redirect()
                    ->route('create_usuario')
                    ->withErrors($e->errors())
                    ->withInput();
        }

       
    }

    public function show($id)
    {
        $usuario = User::find($id);
        return view('gestionUsuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = User::find($id);
        $escuelas = Escuela::all();
        $roles = Rol::all();
        return view('gestionUsuarios.edit_usuario', compact('usuario', 'escuelas', 'roles'));
    }

    public function update(Request $request, $id)
    {
        try{
            $request->validate($this->rulesEditar($id));

            $usuario = User::find($id);
            $usuario->nombre = $request->input('nombre');
            $usuario->apellido = $request->input('apellido');
            $usuario->usuario = $request->input('usuario');
            $usuario->correo = $request->input('correo');
    
            // Rol
            $rol = Rol::find($request->input('rol'));
            $usuario->rol()->associate($rol);
    
            // Si es admin, no tiene escuela
            if($request->input('rol') == 1){
                $usuario->idEscuela = null;
            }else{
                // Escuela
                $escuela = Escuela::find($request->input('idEscuela'));
                $usuario->escuela()->associate($escuela);
            }
    
            $usuario->save();
    
            return redirect()->route('index_usuarios')->with('success', 'Usuario actualizado exitosamente.');
        }catch (\Illuminate\Validation\ValidationException $e){
            return redirect('edit_usuario/' . $id)
                    ->withErrors($e->errors());
        }
        
    }

    public function habilitar($id){
        $usuario = User::find($id);
        $usuario->estado = true;
        $usuario->save();

        return redirect()->route('index_usuarios')->with('success', 'Usuario habilitado exitosamente.');
    }

    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();

        return redirect()->route('index_usuarios')->with('success', 'Usuario eliminado exitosamente.');
    }


    public function actualizarDatosPersonales(Request $request)
    {
        $usuario = User::find($request->input('id'));

    
        if (password_verify($request->input('password'), $usuario->password) ) {
            
        
            $duplicadoUser = User::where('usuario', "=",$request->input('usuario'))->first();
            $duplicadoCorreo = User::where('correo', "=",$request->input('correo'))->first();

            //Verificar que el el noombre de usuario no este registrado en la tabla usuarios y despues verifica si el nombre del usuario
            //actual se puede modificar
            if ($duplicadoUser != null && $usuario->usuario != $request->input('usuario') ) {
        
                $arregloMensaje = [
                    'tipo' => 'restringed',
                    'mensaje' => 'Nombre de usuario ya existe, por favor ingrese otro.'
                ];

                //este hace lo mismo pero con el campo correo
            }elseif ($duplicadoCorreo != null && $usuario->correo != $request->input('correo')) {
                
                $arregloMensaje = [
                    'tipo' => 'restringed',
                    'mensaje' => 'El Correo ya existe, por favor ingrese otro.'
                ];
            }else {
                $usuario->nombre = $request->input('nombre');
                $usuario->apellido = $request->input('apellido');
                $usuario->usuario = $request->input('usuario');
                $usuario->correo = $request->input('correo');
                $usuario->save();
                $arregloMensaje = [
                    'tipo' => 'success',
                    'mensaje' => 'Datos Actualizados Correctamente.'
                ];
            }
               
        }else {
            
            $arregloMensaje = [
                'tipo' => 'restringed',
                'mensaje' => 'Contraseña Incorrecta.'
            ];
        }

        return redirect()->route('verPerfil')->with($arregloMensaje['tipo'], $arregloMensaje['mensaje']);
    }

    public function actualizarPassword(Request $request)
    {
        $usuario = User::find($request->input('id'));

        if($request->input('passwordnueva') == $request->input('passwordnueva2')){
            if(password_verify($request->input('passwordactual'), $usuario->password) ) {
            
                $usuario->password = $request->input('passwordnueva');
                $usuario->save();
    
                $arregloMensaje = [
                    'tipo' => 'success',
                    'mensaje' => 'Tus datos se actualizaron exitosamente.'
                ];
    
            }else {
                $arregloMensaje = [
                    'tipo' => 'restringed',
                    'mensaje' => 'Contraseña Incorrecta.'
                ];
            }
        }else{
            $arregloMensaje = [
                'tipo' => 'restringed',
                'mensaje' => 'Las contraseñas deben coincidir.'
            ];
        }

        return redirect()->route('verPerfil')->with($arregloMensaje['tipo'], $arregloMensaje['mensaje']);
    }

    public function rules(){
        return [
            'nombre' => 'required|max:50|string',
            'apellido' => 'required|max:50|string',
            'usuario' => 'required|unique:users,usuario|max:50',
            'correo' => 'required|email:rfc,dns|unique:users,correo',
            'password' => 'required|min:8',
            'confirmacion_clave' => 'required|same:password',
            'rol' => 'required'
        ];
    }

    
    public function rulesEditar($id){
        return [
            'nombre' => 'required|max:50|string',
            'apellido' => 'required|max:50|string',
            'usuario' => 'required|unique:users,usuario,'. $id .'|max:50',
            'correo' => 'required|email:rfc,dns|unique:users,correo, '. $id,
            'rol' => 'required'
        ];
    }


}
