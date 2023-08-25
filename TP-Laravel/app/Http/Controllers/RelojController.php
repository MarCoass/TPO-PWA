<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Reloj;
use Illuminate\Http\Request;
use App\Models\Competencia;
use App\Models\Competidor;
use App\Models\Puntaje;
use App\Models\RelojCompJuez;
use App\Http\Controllers\RelojCompJuezController;
use App\Http\Controllers\CompetenciaCompetidorController;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use App\Models\User;

class RelojController extends Controller
{
    public function index(Request $request)
    {
        $competencias = Competencia::where('estadoInscripcion', 1)->get();
        return view('reloj.index', compact('competencias'));
    }


    //accede al control del cronometro y a la vez crea los puntuadores de los jueces en estadoPuntuacion 0 
    public function controlCronometro($id)
    {
        //tengo el obj reloj
        $reloj = Reloj::find($id);
        $idCompCompetidor = $reloj->idCompetenciaCompetidor;
        $objCompetenciaCompetidor = CompetenciaCompetidor::find($idCompCompetidor);

        $jueces = RelojCompJuez::where('idreloj', $reloj->idReloj)
                ->get();

        //si ya existen los puntajes no se vuelven a crear
        if(!Puntaje::where('idCompetenciaCompetidor', $idCompCompetidor )->exists()){

            //itero la cantidad de jueces y les creo los puntajes en cero
            foreach ( $jueces as $juez ){
    
                $objCompetenciaJuez = competenciaJuez::find($juez->idCompetenciaJuez);
    
                //armo los puntajes para cada juez
                for ($i=1 ; $i <= 2; $i++){
                    
                    $armarPuntajeJuez = new Puntaje();
                    
                    $armarPuntajeJuez->competenciaJuez()->associate($objCompetenciaJuez);
                    $armarPuntajeJuez->competenciaCompetidor()->associate($objCompetenciaCompetidor);
                    $armarPuntajeJuez->puntajePresentacion = 0;
                    $armarPuntajeJuez->puntajeExactitud = 0;
                    $armarPuntajeJuez->overtime = 0;
                    $armarPuntajeJuez->pasada = $i;
                    
                    $armarPuntajeJuez->save();
                }
            }
            $reloj->estado = 1;
            $reloj->save();
        }

        $darEstados = $this->darEstados($reloj->estado);

        $verJueces = Puntaje::all();
        
        return view('reloj.cronometro', compact('reloj', 'verJueces', 'darEstados'));
    }

    private function infoEstados($valorestado){
        $estados = [
            0 => 'Esperando inscripcion Jueces',
            1 => 'Jueces completos',
            2 => 'Por comenzar 1ra pasada',
            3 => 'En primera pasada',
            4 => 'Finaliza primera pasada',
            5 => 'Esperando puntaje 1ra presentacion',
            6 => 'Por comenzar 2da pasada',
            7 => 'En segunda pasada',
            8 => 'Finaliza segunda pasada',
            9 => 'Esperando puntaje 2da presentacion',
            10 => 'Puntuacion Finalizada'
        ];

        foreach ($estados as $indice => $estado) {
            if ($valorestado == $indice) {
                $estadoActual = $estado;
                break;
            }
        }
        
        return $estadoActual;
    }


    private function darEstados($valorestado){

        $estados = [
            0 => 'Reloj creado',
            1 => 'Esperando jueces',
            2 => 'Anunciar 1ra pasada',
            3 => 'En primera pasada',
            4 => 'Termina primera pasada',
            5 => 'puntaje presentacion 1ra',
            6 => 'Anunciar 2da pasada',
            7 => 'En segunda pasada',
            8 => 'Termina segunda pasada',
            9 => 'Puntaje presentacion 2da',
            10 => 'Puntuacion Finalizada',
            11 => '...'
        ];

        foreach ($estados as $indice => $estado) {
            if ($valorestado == $indice) {
                $estadoAnterior = $estados[$indice - 1];
                $estadoActual = $estado;
                $estadoSiguiente = $estados[$indice + 1];
                break;
            }
        }
        $darEstados = [$estadoAnterior, $estadoActual, $estadoSiguiente];

        return $darEstados;
    }

    //Arma el reloj y lo deja en estado 0 para que ingresen jueces
    public function construirRelojCompetidor(Request $request)
    {    
        //$id_competenciaCompetidor = $request->input('competidor');
        $id_competencia = $request->input('idCompetencia');
        $id_categoria = $request->input('categoria');
        $cantJueces = $request->input('cantJueces');

        $obj_competenciaCompetidor = CompetenciaCompetidor::where('idCompetidor', $request->input('competidor'))->first();
        $id_competenciaCompetidor = $obj_competenciaCompetidor->idCompetenciaCompetidor;
        
        $duplicado = Reloj::where('idCompetencia',  $id_competencia)
                    ->where('idCategoria',  $id_categoria)
                    ->where('idCompetenciaCompetidor', $id_competenciaCompetidor)
                    ->first();

        if ($duplicado != null) {
            $mensaje = "<span class='text-danger'><b>El reloj de este competidor ya esta creado</b></span>";
        } else {
            $reloj = new Reloj();
            $reloj->cantJueces = $cantJueces;
            $reloj->estado = 0;
            $reloj->overtime = 0;
            $competencia = Competencia::find($id_competencia);
            $reloj->competencia()->associate($competencia);
    
            $categoria = Categoria::find($id_categoria);
            $reloj->categoria()->associate($categoria);
    
            $competenciaCompetidor = CompetenciaCompetidor::find($id_competenciaCompetidor);
            $reloj->competenciaCompetidor()->associate($competenciaCompetidor);
    
            $reloj->save();

            $mensaje = "<span class='text-success'><b>Reloj creado</b></span>";
        }

        return response()->json($mensaje);
    }

    // Funcion que cambia etapas
    public function siguienteEstado(Request $request)
    {

        $idReloj = $request['idReloj'];
        $mensaje = ['success' => false];

        $reloj = Reloj::find($idReloj);
        if($reloj->estado < 9){
            $reloj->estado++;
            $mensaje = ['success' => true];
        }else{
            if($reloj->estado == 9){ $reloj->estado++; };          

            $mensaje = ['finPuntuacion' => true,
                        'calcularPasada2' => true
                    ];
        }
        
            if($reloj->estado == 6){
                $mensaje = ['calcularPasada1' => true];
            }

        $reloj->save();

        return response()->json($mensaje);
    }

    // Funcion que pertenece a la etapa 2 y 6 que da inicio de las etapas 3 y 7
    public function start(Request $request)
    {

        $idReloj = $request['idReloj'];
        $mensaje = ['success' => false];

        $reloj = Reloj::find($idReloj);
        if($reloj->estado == 6 || $reloj->estado == 2){
            $reloj->estado == 2 ? $reloj->estado = 3 : $reloj->estado = 7;
            $mensaje = ['success' => true];
        }
        $reloj->save();

        return response()->json($mensaje);
    }

    // Funcion que pertenece a la etapa 3 y 7 que da inicio de las etapas 4 y 8
    public function stop(Request $request)
    {
        $overtime = $request->input('overtime');
        $idReloj = $request['idReloj'];
        $mensaje = ['success' => false];
    
        $reloj = Reloj::find($idReloj);
        if($reloj->estado == 7 || $reloj->estado == 3){
            $reloj->estado == 3 ? $reloj->estado = 4 : $reloj->estado = 8;
            $reloj->overtime = $overtime;
            $mensaje = ['success' => true];
        }

        $reloj->save();

        return response()->json($mensaje);
    }


    public function obtener_estado_reloj(Request $request)
    {
        $data = Reloj::find($request->input('id_reloj'));

        return response()->json(['success' => true, 'estado' => $data->estado]);
    }

    // es para el modal de creacion de reloj
    public function obtenerCategoria(Request $request)
    {
        $id_competencia = $request->input('competencia');
        $user = auth()->user();

        if ($user->idRol == 1) {
            $categoria = Competencia::join('competenciaCompetidor', 'competencias.idCompetencia', '=', 'competenciaCompetidor.idCompetencia')
            ->join('categorias', 'competenciaCompetidor.idCategoria', '=', 'categorias.idCategoria')
            ->select('categorias.idCategoria', 'categorias.nombre', 'categorias.genero')
            ->where('competencias.idCompetencia', $id_competencia)
            ->where('competenciaCompetidor.puntaje', 0)
            ->distinct()
            ->get();
        } 
        if (!is_null($categoria) && count($categoria) != 0) {
            return response()->json($categoria);
        } else {
            return response()->json([]);
        }
    }

    // Es para enviar informacion al cronometro del administrado
    public function buscarPuntuacionActual($idReloj){

        //tengo el obj reloj
        $reloj = Reloj::find($idReloj);

        $idCategoria = $reloj->idCategoria;
        $idCompetencia = $reloj->idCompetencia;

        //trae el idCompetenciaCompetidor del ultimo puntaje creado para la categoria y competencia
        $idCompetenciaCompetidor = Puntaje::join('competenciaCompetidor', 'puntajes.idCompetenciaCompetidor', '=', 'competenciaCompetidor.idCompetenciaCompetidor')
            ->where('competenciaCompetidor.idCompetencia', $idCompetencia)
            ->where('competenciaCompetidor.idCategoria', $idCategoria)
            ->latest('puntajes.created_at')
            ->select('competenciaCompetidor.idCompetenciaCompetidor')
            ->first();

        //Busco los ultimos puntaje creado para la categoria actual, para saber cual es el competidor
        if($idCompetenciaCompetidor != null){
            $puntajes = Puntaje::where('idCompetenciaCompetidor', $idCompetenciaCompetidor->idCompetenciaCompetidor)
                    ->orderBy('idCompetenciaJuez', 'desc')
                    ->get();
       
        //los agrupo en arrays segun la pasada
        $puntajesPrimeraPasada = [];
        $puntajesSegundaPasada = [];
        foreach ($puntajes as $puntaje) {
            if ($puntaje->pasada == 1) {
                $puntajesPrimeraPasada[] = $puntaje;
            } elseif ($puntaje->pasada == 2) {
                $puntajesSegundaPasada[] = $puntaje;
            }
        }

        //Busco el nombre del competidor
        //$competenciaCompetidor = CompetenciaCompetidor::find($puntajes[0]->idCompetenciaCompetidor);
        //$competidor = Competidor::find($competenciaCompetidor->idCompetidor);

        $competidor = $reloj->competenciacompetidor->competidor;

        $nombreCompetidor = $competidor->nombre . " " . $competidor->apellido;

        $idDelCompetidor = $competidor->idCompetidor;

        //Busco los nombres de los jueces
        $nombresJueces = [];
        foreach ($puntajesPrimeraPasada as $puntaje) {
            $competenciaJuez = CompetenciaJuez::where('idCompetenciaJuez', $puntaje->idCompetenciaJuez)->first();
            $juez = User::find($competenciaJuez->idJuez);
            $nombresJueces[] = $juez->nombre . " " . $juez->apellido;
        }

        $darEstados = $this->darEstados($reloj->estado);
        $siguiente = $this->siguientePasoHab($reloj->estado,$puntajesPrimeraPasada,$puntajesSegundaPasada);


        $puntajeFinal = "";
        if($reloj->estado == 10){
            $puntajeFinal = CompetenciaCompetidorController::puntajeFinal($competidor->idCompetidor);     
        }

        $response = [
            'primeraPasada' => $puntajesPrimeraPasada,
            'segundaPasada' => $puntajesSegundaPasada,
            'competidor' => $nombreCompetidor,
            'jueces' => $nombresJueces,
            'categoriaTerminada' => $this->categoriaTerminada($idCategoria),
            'success' => 1,
            'cantJueces' => $reloj->cantJueces,
            'estados' => $darEstados,
            'habBoton' => $siguiente,
            'estadoReloj' => $reloj->estado,
            'puntajeFinal' => $puntajeFinal,
            'deb' => $idDelCompetidor
        ];


    }else{
        $response = ['success' => 0];
    }
        return response()->json($response);
    }

    // es para habilitar el boton de siguiente
    private function siguientePasoHab($estado, $primeraPasada, $segundaPasada){
        $habBoton = false;

        if ($estado == 1){
            //esperando que entren jueces
            $habBoton = true;
        }
        if ($estado == 4 || $estado == 8){
            $habBoton = true;
        }
        if ($estado == 5){
            // se habilita el boton cuando primera pasada esta completa
            $habBoton = true;
            $esCierto = 0;
            foreach ($primeraPasada as $pasada){
                if(intval($pasada['estadoPuntaje']) == 0){
                    $esCierto = 1;
                    break;
                }
            }
            if($esCierto == 1){
                $habBoton = false;
            }
        }
        if ($estado == 9){
            // se habilita el boton cuando segunda pasada esta completa
            $habBoton = true;
            $esCierto = 0;
            foreach ($segundaPasada as $pasada){
                if(intval($pasada['estadoPuntaje']) == 0){
                    $esCierto = 1;
                    break;
                }
            }
            if($esCierto == 1){
                $habBoton = false;
            }
        }
        return $habBoton;
    }

    //Esta funcion se fija si quedan competidores de la categoria sin calificar
    public function categoriaTerminada($idCategoria)
    {
        $categoriaTerminada = !(CompetenciaCompetidor::where('idCategoria', $idCategoria)
            ->where('puntaje', '=', 0)
            ->exists());

        return $categoriaTerminada;
    }

    // se obtiene info de relojes para admin y jueces
    public function obtenerRelojes($idCompetencia = null, $verFinalizados = null)
    {
        $user = auth()->user();
        $dataRelojes = [];
        
        //se debe traer relojes de una competencia en especifico
        if($idCompetencia){
            //trae solo los finalizados
            if($verFinalizados){
                $objRelojes = Reloj::where('idCompetencia',$idCompetencia)
                        ->where('estado', '=', 10)
                        ->get();
            //trae los no finalizados
            }else{
                $objRelojes = Reloj::where('idCompetencia',$idCompetencia)
                        ->where('estado', '!=', 10)
                        ->get();
            }
        }else{
            $objRelojes = Reloj::all();
        }

        foreach ($objRelojes as $objReloj){

            //hago union de las tablas competenciajuez, users y relojcompjuez
            $objRelComJuez = RelojCompJuez::join("competenciajueces", "competenciajueces.idCompetenciaJuez", "=", "RelojCompJuez.idCompetenciaJuez")
            ->join("users", "users.id", "=", "competenciajueces.idJuez")
            ->where("RelojCompJuez.idReloj", $objReloj->idReloj)
            ->select("RelojCompJuez.idCompetenciaJuez","users.nombre","users.apellido")
            ->get();

            $data['id'] = $objReloj->idReloj;
            $data['competencia'] = $objReloj->competencia->nombre;
            $data['categoria'] = $objReloj->categoria->nombre." - ".($objReloj->categoria->genero == 1 ? "Femenino" : "Masculino");
            $data['nombreApellidoCompetidor'] = $objReloj->competenciaCompetidor->competidor->nombre." ". $objReloj->competenciaCompetidor->competidor->apellido;
            $data['cantJueces'] = $objReloj->cantJueces;
            $data['juecesInscriptos'] = $objRelComJuez;
            $data['estado'] = $objReloj->estado;
            $data['textEstado'] = $this->infoEstados($objReloj->estado);
            
            // aca despliego opciones para los admins
            if($user->idRol == 1){
                if(RelojCompJuezController::cantJuecesEnReloj($objReloj->idReloj) >= $objReloj->cantJueces){
                    if($objReloj->estado > 2){
                        $data['acciones'] = "Ir al Cronometro";
                    }else{
                        $data['acciones'] = "Iniciar Cronometro";
                    }
                    $data['funcion'] = "iniciarPuntuador";

                    if($objReloj->estado == 10){
                        $data['disabled'] = "d-none";
                    }
                    
                }else{
                    $data['acciones'] = "Esperando Jueces";
                    $data['disabled'] = "disabled";
                }

            // este else depliega opciones para los jueces
            }else{
                if(RelojCompJuezController::yaExisteJuezEnReloj($objReloj->idReloj)){
                    if($objReloj->estado == 0){
                        $data['acciones'] = "Salir";
                        $data['funcion'] = "quitSala";
                    }elseif($objReloj->estado == 10){
                        $data['acciones'] = "...";
                        $data['funcion'] = "nada";
                        $data['disabled'] = "d-none";
                    }else{
                        $data['acciones'] = "Ir al puntuador";
                        $data['funcion'] = "irPuntuador";
                    }

                }else{
                    if($objReloj->estado > 0){
                        $data['acciones'] = "...";
                        $data['funcion'] = "nada";
                        $data['disabled'] = "d-none";
                    }else{
                        $data['acciones'] = "Anotarse";
                        $data['funcion'] = "joinSala";
                    }
                }
            };

            array_push($dataRelojes,$data);
        }
        
        return response()->json($dataRelojes);
    }

    /* Funcion que devuelve un competidor y lo renderiza en un modal */
    public function obtenerCompetidoresDeUnaCompetencia($idCompetencia){

        $competencia = $idCompetencia;

        $categoria = Competencia::join('competenciaCompetidor', 'competencias.idCompetencia', '=', 'competenciaCompetidor.idCompetencia')
            ->join('categorias', 'competenciaCompetidor.idCategoria', '=', 'categorias.idCategoria')
            ->select('categorias.idCategoria', 'categorias.nombre', 'categorias.genero')
            ->where('competencias.idCompetencia', $idCompetencia)
            ->distinct()
            ->get();

        return view('reloj.modalConstruirReloj', compact('competencia','categoria'))->render();

    }


}
