@extends('layouts/layout')

@section('titulo')
    Cronómetro
@endsection

@section('encabezado')
    Armar Cronómetro
@endsection

@section('scripts')
    <script>
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

                var disabled = "";

                // Comprobar si el elemento tiene el atributo disabled
                if (item.disabled) {
                    // Asignar el atributo disabled a la variable
                    disabled = item.disabled;
                }
                // Crear una fila con los datos de cada registro
                if (item.estado == 0 || item.estado == 4) {
                    var colores = "bg-info text-white";
                } else {
                    var colores = "bg-success text-white";
                }

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
                                    if(item.estado == 0){
                                        row +=` <button onclick=quitarJuez(`+ juez.idCompetenciaJuez +`,`+item.id+`) class="rounded-circle bg-danger text-white bi bi-x-circle me-2"></button>`;
                                    }
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

        //esto es para buscar categorias donde hayan competidores de una competencia
        $(document).ready(function() {
            // Seleccionar el botón que activa el modal
            var button = $('.btn-modal');

            // Seleccionar el modal
            var modal = $('#myModal');

            // Seleccionar el select con id="competencia"
            var select = $('#competencia');

            // Añadir un evento change al select
            select.change(function() {
                // Obtener el valor del select
                var value = $(this).val();
                // Cambiar el valor del atributo data-id del botón
                button.attr('data-id', value);
            });


            // Añadir un evento click al botón
            button.click(function() {

                // Obtener el id del competencia competidor desde el select
                var id = select.val();

                // Hacer una petición ajax al servidor pasando el id como parámetro
                $.ajax({
                    /* url: '/competenciasActivas/' + id, */
                    url: '/competenciasActivas/' + id,
                    type: 'GET',
                    dataType: 'HTML',
                    success: function(data) {
                        // Cargar el contenido del modal con los datos obtenidos
                        modal.find('.modal-content').html(data);
                    },
                    error: function(error) {
                        // Mostrar un mensaje de error en caso de fallo
                        modal.find('.modal-content').html(
                            '<p>Ocurrió un error al obtener los datos.</p>');
                    }
                });
            });
        });


        function iniciarPuntuador(n) {
            location.href = "/control_cronometro/" + n ;
        }

        function quitarJuez(n,idReloj){
            $.ajax({
                url: "/quitarJuez",
                type: "POST",
                dataType: "json",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    idCompetenciaJuez: n,
                    idReloj
                },
                success: function (response) {
                    if(response.success){
                        getData();
                    }
                },
            });
        }


    </script>
@endsection

@section('contenido')

    <div class="row justify-content-center">

        <div class="col-lg-6 col-md-12 col-sm-12  pt-3">
            <label class="form-label" for="competencia">Competencia:</label>
            <select class="form-control dropdown-toggle validar" id="competencia" name="competencia" required>
                @if (count($competencias) > 0)
                    <option value="" disabled selected data-error="Por favor seleccione una competencia válida">
                        Selecciona una Competencia.</option>
                    @foreach ($competencias as $row)
                        <option value="{{ $row->idCompetencia }}">{{ $row->nombre }}</option>
                    @endforeach
                @else
                    <option value="" disabled selected data-error="Por favor seleccione una competencia válida">No hay
                        competencias Abiertas.</option>
                @endif
            </select>
            <div class="valid-feedback">
                ¡Correcto!
            </div>
            <div class="invalid-feedback">Seleccione una opcion valida.</div>
        </div>
        <div class="col-lg-6 col-12 button-group m-3 d-flex justify-content-center align-items-center">
            <button type="button" class="btn btn-outline-success btn-modal" data-bs-toggle="modal"
                data-bs-target="#myModal" data-id=""><i class="bi bi-check2-square me-2"></i>Construir reloj</button>
        </div>

    </div>


    <!-- Modal vacío -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Aca se cargará el contenido del modal -->
            </div>
        </div>
    </div>


    <table id="relojes_activos" class="table border">
        <thead>
            <tr>
                <th scope="col">Cargando relojes activos creados</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>



@endsection
