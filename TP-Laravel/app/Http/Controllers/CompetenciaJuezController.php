<?php

namespace App\Http\Controllers;
use App\Models\CompetenciaJuez;
use App\Models\Competencia;
use App\Models\User;
use App\Models\Solicitud;
use App\http\Controllers\SolicitudController;
use Illuminate\Http\Request;

/* Necesarios para enviar mails */
use App\Notifications\NotificacionGeneral;
use Illuminate\Support\Facades\Notification;


class CompetenciaJuezController extends Controller
{
    public function store(Request $request){

        $duplicado = CompetenciaJuez::where('idCompetencia','=', $request->input('competencia'))->
        where('idJuez','=', $request->input('juez'))->first();

        if( $duplicado != null){
            return redirect('/')->with('error', "Ya tiene una inscripcion hecha.");
        }

        $competencia_juez = new CompetenciaJuez();
        $competencia_juez->idJuez = $request->input('juez');
        $competencia_juez->idCompetencia = $request->input('competencia');
        $competencia_juez->estado =  0;

        $competencia = Competencia::find($request->input('competencia'));
        $competencia_juez->competencia()->associate($competencia);

        $juez = User::find($request->input('juez'));
        $competencia_juez->juez()->associate($juez);

        /* creo la solicitud */
        $escuela = $request->input('newEscuela');

        if($escuela == 0){
            $seCreoLaSolicitud = false;
        }else{
            $seCreoLaSolicitud = SolicitudController::generarSolicitudSoloEscuela($juez,$escuela);
        }
        
        $competencia_juez->save();

        /* verifico si el juez ya estuvo en otra competencia */
        if($seCreoLaSolicitud){
            $redirigir = [
                'url' => '/',
                'tipo' => 'success',
                'mensaje' => 'Se registró y se pidio cambio de escuela! queda en espera de verificación.'
            ];
        }else{
            $redirigir = [
                'url' => '/',
                'tipo' => 'success',
                'mensaje' => 'Se registró correctamente, queda en espera de verificación.'
            ];
        }

        return redirect($redirigir['url'])->with($redirigir['tipo'],$redirigir['mensaje']);
    }

    public function habilitar($id){
        // Habilitar solo si hay menos que la cantidad definida en competencia
        // Caso contrario msj de error
        // Habría que deshabilitar el botón
        // Hacer que estadoJueces cambie al aceptar al ultimo juez requerido

        // El competenciaJuez actual
        $competencia_juez = CompetenciaJuez::find($id);

        // La lista completa de jueces aceptados para esta competencia
        $juecesAceptados = CompetenciaJuez::
                where('estado', true)
                ->where('idCompetencia', $competencia_juez->idCompetencia)
                ->get();


        $mensaje = [];
        $cantJueces = $competencia_juez->competencia->cantidadJueces;
        $cantJuecesAceptados = count($juecesAceptados);

        if($cantJuecesAceptados + 1 == $cantJueces){
            // Igual carga y cambia estadoJueces
            $competencia_juez->competencia->estadoJueces = true;
            $competencia_juez->competencia->save();
            $competencia_juez->estado = 1;
            $competencia_juez->save();
            $mensaje = ["tipo" => 'success', 'mensaje' => 'Juez habilitado exitosamente. Las inscripciones ya están abiertas a competidores.'];
        }else{
            // Menor o mayor solo carga
            $competencia_juez->estado = 1;
            $competencia_juez->save();
            $mensaje =["tipo" => 'success', 'mensaje' => 'Juez habilitado exitosamente.'];
        }

        $user = User::find($competencia_juez->juez->id);
        $user->notify(new NotificacionGeneral('success','Han aceptado tu inscripcion!.','Ahora estas habilitado para Juzgar en: '.$competencia_juez->competencia->nombre, 'Enhorabuena!'));


        return redirect()->route('tabla_jueces', ['id' => $competencia_juez->idCompetencia])->with($mensaje['tipo'], $mensaje['mensaje']);
    }

    public function listarJuecesPorIdCompetencia($id)
    {

        $competencia_juez = CompetenciaJuez::where('idCompetencia', $id)->get();
        $nombreCompetencia = Competencia::find($id);
        $juecesAceptados = CompetenciaJuez::
                where('estado', true)
                ->where('idCompetencia', $id)
                ->get();

        //usamos el método map para agregar el campo solicitud a cada elemento de la colección
        $competencia_juez->map (function ($item) {
            //buscamos si el juez tiene alguna solicitud pendiente
            $tieneSolicitud = Solicitud::where('idUser', $item->juez->id)->where('estadoSolicitud', 4)->first();
            //si hay una solicitud, asignamos el valor true al campo solicitud
            if ($tieneSolicitud) {
                $item->tieneSolicitud = true;
            } else {
            //si no hay una solicitud, asignamos el valor false al campo solicitud
            $item->tieneSolicitud = false;
            }
        });
        
        

        return view('tablaCompetenciaJueces.index', ['CompetenciaJuez' => $competencia_juez, 'nombreCompetencia' => $nombreCompetencia, 'juecesAceptados' => $juecesAceptados]);
    }

    public function rechazar($id){
        // Habilitar solo si hay menos que la cantidad definida en competencia
        // Caso contrario msj de error
        // Habría que deshabilitar el botón
        // Hacer que estadoJueces cambie al aceptar al ultimo juez requerido

        // El competenciaJuez actual
        $competencia_juez = CompetenciaJuez::find($id);

        $mensaje = [];

            // Menor o mayor solo carga
            $competencia_juez->estado = 2;
            $competencia_juez->save();
            $mensaje =["tipo" => 'success', 'mensaje' => 'Juez rechazado exitosamente.'];

        $user = User::find($competencia_juez->juez->id);
        $user->notify(new NotificacionGeneral('restricted','Han rechazado tu inscripcion.','Por motivos administrativos no puedes Juzgar en '.$competencia_juez->competencia->nombre , 'Disculpe las Molestias.'));


        return redirect()->route('tabla_jueces', ['id' => $competencia_juez->idCompetencia])->with($mensaje['tipo'], $mensaje['mensaje']);
    }

    public function destroy($id){
        $competenciaJuez = CompetenciaJuez::find($id);
        $idCompetencia = $competenciaJuez->idCompetencia;
        $competenciaJuez->delete();

        return redirect()
            ->route('tabla_jueces', ['id' => $idCompetencia])
            ->with('success', 'Juez eliminado exitosamente de la competencia. Ahora puede volver a inscribirse');
    }
}
