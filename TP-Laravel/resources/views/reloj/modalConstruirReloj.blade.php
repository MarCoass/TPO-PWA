 <div class="modal-header">
     <h5 class="modal-title">Construir Reloj Para Competidor</h5>
     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
 </div>
 <div class="modal-body">
     <form class="row" method="post" id="formReloj">
        @csrf
        {{-- input de la competencia oculto --}}
        <input type="hidden" value="{{ $competencia }}" id="idCompetencia" name="idCompetencia">

        <div class="col-md-12 col-sm-12  pt-1">
            <label class="form-label" for="categoria">Categorias:</label>
            <select class="form-control dropdown-toggle validar" id="categoria" name="categoria" required>
                 @if (count($categoria) > 0)
                     @foreach ($categoria as $row) 

                            <option value="{{ $row->idCategoria }}"> {{ $row->nombre }} {{ $row->genero == '1' ? 'Femenino' : 'Masculino' }} </option>
                         
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

         <div class="col-md-12 col-sm-12  pt-3">
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

         <div class="col-md-12 col-sm-12  pt-3">
             <label class="form-label" for="cantJueces">Cantidad de jueces:</label>
              <br>
             <input class="form-check-input validar" type="radio" name="cantJueces" value="3" id="radio3" checked>
             <label class="form-check-label" for="radio3">
                3
              </label>
              <br>
             <input class="form-check-input validar" type="radio" name="cantJueces" value="5" id="radio5">
             <label class="form-check-label" for="radio5">
                5
              </label>
              <br>
             <input class="form-check-input validar" type="radio" name="cantJueces" value="7" id="radio7">
             <label class="form-check-label" for="radio7">
                7
              </label>



             <div class="valid-feedback">
                 ¡Correcto!
             </div>
             <div class="invalid-feedback">Seleccione una opcion valida.</div>
         </div>


         <div class="col-12 button-group p-2 mb-3">
             <button class="btn btn-outline-primary mx-2" type="submit"><i
                     class="bi bi-hourglass-split me-1"></i>Iniciar
                 Cronómetro</button>
         </div>

         <div id="respuesta"></div>
     </form>
 </div>

 <script>

//Carga los competidores segun la categoria
$("#categoria").on("click", function () {
    $.ajax({
        type: "GET",
        url: "/opciones_competidor",
        data: {
            competencia: $("#idCompetencia").val(),
            categoria: $("#categoria").val(),
        },

        dataType: "json",
        success: function (data) {
            //console.log(data);
            $("#competidor").empty();
            $("#competidor").append(
                '<option value="" disabled selected data-error="Por favor seleccione un competidor">Selecciona un competidor.</option>'
            );
            $.each(data, function (key, value) {
                $("#competidor").append(
                    '<option value="' +
                        value.idCompetidor +
                        '">' +
                        value.nombre +
                        " " +
                        value.apellido +
                        "</option>"
                );
            });
        },
    });
});

$(document).ready(function() {
    // Seleccionar el formulario por su id
    var formulario = $('#formReloj');

    // Añadir un evento submit al formulario
    formulario.submit(function(event) {
        // Evitar que el formulario se envíe de forma normal y recargue la página
        event.preventDefault();

        // Hacer una petición ajax al servidor
        $.ajax({
            // La url donde se enviarán los datos del formulario
            url: '/construir_reloj',
            // El tipo de petición: GET o POST
            type: 'POST',
            // Los datos del formulario en formato clave-valor
            data: formulario.serialize(),
            // La función que se ejecutará si la petición tiene éxito
            success: function(data) {
                // Mostrar la respuesta del servidor en algún elemento de la página
                $('#respuesta').html(data);
                // Cerrar el modal después de enviar el formulario
                /* $('#myModal').modal('hide'); */
            },
            // La función que se ejecutará si la petición falla
            error: function(error) {
                // Mostrar un mensaje de error en algún elemento de la página
                $('#respuesta').html(data);;
            }
        });
    });
});

 </script>

 <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
 </div>
