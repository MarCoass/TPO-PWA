@extends('layouts/layout')

@section('titulo')
    Iniciar Puntuador
@endsection

@section('encabezado')
    Seleccionar competidor a puntuar
@endsection

@section('librerias')

@endsection

@section('scripts')
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    // Función para obtener los datos de la tabla desde el controlador
    function getData() {
            // Hacer una petición GET al método index del controlador
            $.ajax({
                url: '/relojes',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Si la petición tiene éxito, actualizar los datos de la tabla
                    /* console.log(data); */
                    updateTable(data);
                },
                error: function(error) {
                    // Si la petición falla, mostrar un mensaje de error
                    console.log(error);
                }
            });
        }

    // Función para actualizar los datos de la tabla con los datos recibidos
    function updateTable(data) {
        // Vaciar el contenido de la tabla
        $('#relojes_activos').empty();

        // Recorrer el array de datos recibidos
        $.each(data, function(index, item) {
            // Crear una fila con los datos de cada registro

            var disabled = "";

                // Comprobar si el elemento tiene el atributo disabled
                if (item.disabled) {
                    // Asignar el atributo disabled a la variable
                    disabled = item.disabled;
                }

            if(item.estado == 0){
                var colores = "bg-info text-white";
            }else if(item.estado == 10){
                var colores = "bg-secondary text-white"
            }else{
                var colores = "bg-success text-white";
            }

            /* var row = `
            <tr> 
                <td>
                    <div class="card ` + colores + `">
                        <div class="card-header"> <span class="lead" > ` + item.nombreApellidoCompetidor + `</span> <span class="fw-bold" >` + item.competencia + ` </span> ` + item.categoria + `</div> 
                        <div class="card-body row"> 
                            <div class="col">
                                <p class="card-text lead"> Jueces activos</p> 
                                <h5 class=" card-title">` + item.juecesInscriptos.length + ` de ` + item.cantJueces + `</h5> 
                            </div>
                            <div class="col">
                                <p class="card-text lead"> Estado </p>
                                <p class="card-text">` + item.estado + `</p>           
                            </div>
                            <div class="col">
                                <p class="card-text lead"> Acciones</p>
                                <button onclick=` + item.funcion+'('+item.id+')' + ` class="btn btn-primary">`+item.acciones+`</button> 
                            </div>
                        </div> 
                    </div>
                </td>
            </tr>`; */
            var row = `
            <tr> 
                <td>
                    <div class="card ` + colores + `">
                        <div class="card-header"> <span class="lead" > ` + item.nombreApellidoCompetidor +
                    `</span> <span class="fw-bold" >` + item.competencia + ` </span> ` + item.categoria + `</div> 
                        <div class="card-body row"> 

                            <!--  i n f o   d e   j u e c e s -->
                            <div class="col">
                                <p class="card-text lead"> Jueces activos</p> 
                                <h5 class="card-title">` + item.juecesInscriptos.length + ` de ` + item.cantJueces + `</h5> 
                            `;
                                // itero la cantidad de jueces que estan inscripto
                            $.each(item.juecesInscriptos, function(i,juez){
                                row += `<p>`;
                                row += ` ` + juez.apellido + " " + juez.nombre + ` </p> `;
                            });
                            
            row +=                `
                            </div>
                            <!--  i n f o   d e   e s t a d o -->
                            <div class="col">
                                <p class="card-text lead"> Estado </p>
                                <h5 class="card-text">` + item.textEstado + `</h5>           
                            </div>

                            <!--  i n f o   d e   a c c i o n e s -->
                            <div class="col">
                                <p class="card-text lead"> Acciones</p> 
                                <button onclick=` + item.funcion + '(' + item.id + ')' + ` class="btn btn-primary ` +
                    disabled + `">` + item.acciones + `</button> 
                            </div>
                        </div> 
                    </div>
                </td>
            </tr>`;
            // Añadir la fila al cuerpo de la tabla
            $('#relojes_activos').append(row);
        });
    }

    // Ejecutar la función getData cada 1 segundo
    setInterval(getData, 5000);



    function joinSala(idReloj) {
            // Hacer una petición GET al método index del controlador
            $.ajax({
                url: '/unirseSala',
                type: 'POST',
                data: {
                    idReloj: idReloj,
                },
                dataType: 'json',
                success: function(data) {
                    // Si la petición tiene éxito, actualizar los datos de la tabla
                    //alert(data.mensaje);
                    getData();
                },
                error: function(error) {
                    // Si la petición falla, mostrar un mensaje de error
                    console.log(error);
                }
            });
        }
    
        function quitSala(idReloj) {
            // Hacer una petición GET al método index del controlador
            $.ajax({
                url: '/salirSala',
                type: 'POST',
                data: {
                    idReloj: idReloj,
                },
                dataType: 'json',
                success: function(data) {
                    // Si la petición tiene éxito, actualizar los datos de la tabla
                    //alert(data.mensaje);
                    getData();
                },
                error: function(error) {
                    // Si la petición falla, mostrar un mensaje de error
                    console.log(error);
                }
            });
        }

        function irPuntuador(idReloj) {
            location.href = "/iniciar_puntaje/" + idReloj ;
        }


        
</script>
    
@endsection

@include('layouts.partials.messages')
@section('contenido')
    <div class="desktop">
        @include('puntuador.partials.vistaNoDisponible')

    </div>
    @csrf

    <div class="mobile">
        <div class="vertical">
            @include('puntuador.partials.vistaNoDisponible')
        </div>
{{--         <form class="m-5 row" method="post" action="{{ url('/iniciar_puntaje') }}">
            @csrf
            <div class="col-lg-6 col-md-12 col-sm-12  pt-3">
                <label class="form-label" for="competencia">Competencia:</label>
                <select class="form-control validar" id="competencia" name="competencia" required>
                    <option value="" disabled selected data-error="Por favor seleccione una competencia válida">
                        Selecciona una Competencia.</option>
                    @foreach ($competencias as $row)
                        <option value="{{ $row->idCompetencia }}">{{ $row->nombre }}</option>
                    @endforeach
                </select>
                <div class="valid-feedback">
                    ¡Correcto!
                </div>
                <div class="invalid-feedback">Seleccione una opcion valida.</div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12  pt-3">
                <label class="form-label" for="categoria">Categoria:</label>
                <select class="form-control validar" id="categoria" name="categoria" required>
                    <option value="" disabled selected data-error="Por favor seleccione una categoria válida">
                        Selecciona una categoria.</option>
                </select>
                <div class="valid-feedback">
                    ¡Correcto!
                </div>
                <div class="invalid-feedback">Seleccione una opcion valida.</div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12  pt-3">
                <label class="form-label" for="competidor">Competidor:</label>
                <select class="form-control validar" id="competidor" name="competidor" required>
                    <option value="" disabled selected data-error="Por favor seleccione una graduacion válida">
                        Selecciona un competidor.</option>
                </select>
                <div class="valid-feedback">
                    ¡Correcto!
                </div>
                <div class="invalid-feedback">Seleccione una opcion valida.</div>
            </div>
            <div class="col-lg-6 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
                <button class="btn btn-outline-primary mx-2" type="submit">Iniciar Puntaje</button>
            </div>
        </form> --}}

        <table id="relojes_activos" class="table border">
            <thead>
                <tr>
                    <th scope="col">Cargando relojes activos creados</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>



    </div>
@endsection
