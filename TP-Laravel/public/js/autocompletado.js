import paisesAceptados from '../json/paisesAceptados.json' assert {type: 'json'};

// Carga del arreglo de paises aceptados en el JSON
const arreglo_paises = paisesAceptados;

$(document).ready(function() {
    // Obtención de la rutas
    const rutaPais = $('#rutaPais').val();
    const rutaEstado = $('#rutaEstado').val();

    $(function() {
      // Dado a que no hay país, hay que "desactivar" a estado
      $('#estado').prop('readonly', true);

      // Método de jquery ui
      $( "#pais" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Obtención del token mediante el header
            },
            type:"POST",
            url: rutaPais,// Ruta al método que devuelve los datos
            dataType: "json",
            data: {
              term: request.term // el request.term es el valor del campo
            },
            success: function( data ) {
                // Recorre los datos. inArray revisa si existe en el arreglo de países aceptados.
                // Si no existe, le coloca no disponible.
                response($.map(data, function(pais) {
                  if ($.inArray(pais.label, arreglo_paises) !== -1) {
                    return {	
                      value:pais.value,              
                      label:pais.label,
                      id_pais: pais.value,	
                      descripcion: pais.label,						           
                    };
                  }else{
                    return {	
                      value:pais.value,              
                      label:pais.label+" [No disponible]",
                      id_pais: pais.value,	
                      descripcion: pais.label,						           
                    };
                  }
                }));
              }
          });
        },
        select: function(event, ui) {
          // Asignar valor seleccionado al input.
         if ($.inArray(ui.item.descripcion, arreglo_paises) !== -1) {
            $( "#pais" ).val(ui.item.descripcion);
            $( "#idPais" ).val(ui.item.id_pais);
            limpiar_datos_estado(false);
            $('#estado').prop('readonly', false);
    
          }else{
            limpiar_datos_paises();
            limpiar_datos_estado();
          }

          return false;
        },
        change: function( event, ui ) {
            // Si se dispara el event change, reinicia todo
            if(ui.item==null){
                limpiar_datos_paises();
                limpiar_datos_estado();
                $('#estado').prop('readonly', true);
            }
        },
        minLength: 2 // Mínimo de caracteres a escribir para que aparezcan sugerencias.
      });

      // Se repite lo mismo, pero con estado
      // La diferencia es que este también lleva el idPais y no tiene opciones no disponibles.
      $( "#estado" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url: rutaEstado,// Ruta al archivo JSON con datos.
            dataType: "json",
            data: {
              idPais: $('#idPais').val(),
              term: request.term
            },
            success: function( data ) {
                response($.map(data, function(estado) {
                    return {	
                            value:estado.value,              
                            label:estado.label,
                            id_estado: estado.value,	
                            descripcion: estado.label,						           
                    };
                }));
            }
          });
        },
        select: function(event, ui) {
          // Asignar valor seleccionado al input.
          $( "#estado" ).val(ui.item.descripcion);
          $( "#idEstado" ).val(ui.item.id_estado);
          
          return false;
        },
        change: function( event, ui ) {
            if(ui.item==null){
                limpiar_datos_estado();
            }
        },
        minLength: 2 // Mínimo de caracteres a escribir para que aparezcan sugerencias.
      });
    });
});

function limpiar_datos_paises(){
    $('#idPais').val(null);
    $('#pais').val(null);
    chequearValidez(document.getElementById("pais"));
}

function limpiar_datos_estado(chequear=true){
  $('#idEstado').val(null);
  $('#estado').val(null);
  if(chequear){
    chequearValidez(document.getElementById("estado"));
  }
}