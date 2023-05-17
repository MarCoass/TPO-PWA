@extends('layouts/layout')

@section('titulo')
    Home
@endsection

@section('encabezado')
    Home
@endsection
@section('contenido')
    <div class="row justify-content-around">

        <div class="format-container">

            <div class="seccion_box">


              <div class="seccion_item">
                <a href="/cronometro" class="seccion-item_link">
                  <div class="seccion-item_bg"></div>
                  <div class="seccion-item_title">
                    Cronometro
                  </div>
                </a>
              </div>

              <div class="seccion_item">
                <a href="/video" class="seccion-item_link">
                  <div class="seccion-item_bg"></div>
                  <div class="seccion-item_title">
                    Video
                  </div>
                </a>
              </div>

              <div class="seccion_item">
                <a href="/tablaCompetidores" class="seccion-item_link">
                  <div class="seccion-item_bg"></div>
                  <div class="seccion-item_title">
                    Ver competidores
                  </div>
                </a>
              </div>

              <div class="seccion_item">
                <a href="/cargarCompetidor" class="seccion-item_link">
                  <div class="seccion-item_bg"></div>
                  <div class="seccion-item_title">
                    Cargar competidor
                  </div>
                </a>
              </div>

              <div class="seccion_item">
                <a href="/imagenesRandom" class="seccion-item_link">
                  <div class="seccion-item_bg"></div>
                  <div class="seccion-item_title">
                    Imagenes random
                  </div>
                </a>
              </div>
              
          
              
          
            </div>
          </div><!-- /.col-lg-4 -->

    </div>
@endsection
