<?php

namespace App\Http\Controllers;
use App\Models\Escuela;
use App\Models\Competencia;
use App\Models\Competidor;
use App\Models\CompetenciaCompetidor;
use App\Models\Categoria;
use App\Models\Solicitud;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function index($idCompetencia = null,$idEscuela = null)
    public function index()
    {
        //$objCompetencia = Competencia::find($idCompetencia);
        $objCompetencia = Competencia::find(1)->first();
        $objEscuela = Escuela::find(2);
        $objCompetidoresCompetencia = CompetenciaCompetidor::where('idCompetencia',$objCompetencia->idCompetencia)
                ->join('competidores','competenciacompetidor.idCompetidor','=','competidores.idCompetidor')
                ->join('users','competidores.idUser','=','users.id')
                ->where('users.idEscuela',$objEscuela->idEscuela)
                ->get();

        foreach ($objCompetidoresCompetencia as $compe) {
            // Agregar el campo nombre al objeto competidor
            $compe->tieneSolicitud = Solicitud::where('idUser', '=', $compe->competidor->idUser)->where('estadoSolicitud', '=', 4)->exists();;
        }

            
        $fecha = $objCompetencia->fecha;

        $data = [
            'title' => 'Lista de Competidores Inscriptos a corroborar',
            'nombreCompetencia' => $objCompetencia->nombre,
            'sorteoPoomsae' => $fecha,
            'escuela' => $objEscuela,
            'competidoresComp' =>  $objCompetidoresCompetencia,
            
        ];
           
        $pdf = PDF::loadView('pdf.testPDF', $data);
     
        //return $pdf->download('tutsmake.pdf');
        return $pdf->stream('tutsmake.pdf');

    }

}
