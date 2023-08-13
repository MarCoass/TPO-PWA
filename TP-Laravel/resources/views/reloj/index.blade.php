@extends('layouts/layout')

@section('titulo')
    Cronómetro
@endsection

@section('encabezado')
    Armar Cronómetro
@endsection

@section('scripts')
    <script>
        $("#competencia").change(function() {
            //console.log($("#competencia").val());
            $.ajax({
                type: "GET",
                url: "/opciones_categoria",
                data: {
                    competencia: $("#competencia").val(), //id de la competencia
                },

                dataType: "json",
                success: function(data) {

                    // console.log(data)
                    if (data.length !== 0) {
                        $("#categoria").empty();
                        $("#categoria").append(
                            '<option value="" disabled selected data-error="Por favor seleccione una categoria">Selecciona una categoria.</option>'
                        );
                        $.each(data, function(key, value) {
                            var genero = value.genero == '1' ? 'Femenino' : 'Masculino'

                            $("#categoria").append(
                                '<option value="' +
                                value.idCategoria +
                                '">' +
                                value.nombre + " " + genero +
                                "</option>"
                            );
                        });
                    }
                },
            });
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

            var disabled = "";

            // Comprobar si el elemento tiene el atributo disabled
            if (item.disabled) {
            // Asignar el atributo disabled a la variable
            disabled = "disabled";
            }
            // Crear una fila con los datos de cada registro
            if(item.estado == 0 || item.estado == 4){
                var colores = "bg-info text-white";
            }else{
                var colores = "bg-success text-white";
            }

            var row = `
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
                                <button onclick=` + item.funcion+'('+item.id+')' 'iniciarPuntuador('+item.id+')' + ` class="btn btn-primary `+disabled+`">`+item.acciones+`</button> 
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
    </script>
@endsection

@section('contenido')

    <form class="m-5 row" method="get" action="{{ url('/iniciar_cronometro') }}">
        @csrf
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
        <div class="col-lg-6 col-md-12 col-sm-12  pt-3">
            <label class="form-label" for="categoria">Categoria:</label>
            <select class="form-control dropdown-toggle validar" id="categoria" name="categoria" required>
                <option value="" disabled selected data-error="Por favor seleccione una categoria válida">Selecciona
                    una categoria.</option>
            </select>
            <div class="valid-feedback">
                ¡Correcto!
            </div>
            <div class="invalid-feedback">Seleccione una opcion valida.</div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12  pt-3">
            <label class="form-label" for="competidor">Competidor:</label>
            <select class="form-control dropdown-toggle validar" id="competidor" name="competidor" required>
                <option value="" disabled selected data-error="Por favor seleccione una graduacion válida">
                    Selecciona un competidor.</option>
            </select>
            <div class="valid-feedback">
                ¡Correcto!
            </div>
            <div class="invalid-feedback">Seleccione una opcion valida.</div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12  pt-3">
            <label class="form-label" for="cantJueces">Cantidad de jueces:</label>
            <select class="form-control dropdown-toggle validar" id="cantJueces" name="cantJueces" required>
                <option value="" disabled selected data-error="Por favor seleccione una cantJueces válida">Selecciona
                    la cantidad de jueces.</option>
                <option value="3">3</option>
                <option value="5">5</option>
                <option value="7">7</option>
            </select>
            <div class="valid-feedback">
                ¡Correcto!
            </div>
            <div class="invalid-feedback">Seleccione una opcion valida.</div>
        </div>


        <div class="col-lg-6 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button class="btn btn-outline-primary mx-2" type="submit"><i class="bi bi-hourglass-split me-1"></i>Iniciar
                Cronómetro</button>
        </div>
    </form>

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
