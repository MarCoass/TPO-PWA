document.addEventListener("DOMContentLoaded", function () {
  // Obtener referencia al select
  const selectGraduacion = document.getElementById("graduacion");
  const selectPaises = $("#paisOrigen");

  // Obtener datos del archivo JSON
  fetch("../util/json/formulario/graduaciones.json")
    .then((response) => response.json())
    .then((data) => {
      // Iterar sobre los datos y crear opciones
      data.forEach((option) => {
        const optionElement = document.createElement("option");
        optionElement.value = option.graduacion;
        optionElement.textContent = option.graduacion;
        selectGraduacion.appendChild(optionElement);
      });
    })
    .catch((error) => console.error(error));

  // Listando paises para mostrar
  $.ajax({
    url: './Acciones/listarPaises.php',
    type: 'POST',
    data: null,
    success: function (data) {
      paises = JSON.parse(data)

      estructura = "";
      estructura += "<option value='' disabled selected data-error='Por favor seleccione un país válido'>Selecciona una opción</option>";
      $.each(paises, function (index, pais) {
        estructura += "<option value=" + pais.id + ">" + pais.paisnombre + "</option>";
      });

      selectPaises.html(estructura);
    },
  });
});

const selectEstados = $("#estadoOrigen");

// Verificar si el select tiene opciones al cargar la página
if (selectEstados.find('option').length === 0) {
  selectEstados.prop('disabled', true);
}

// Listando estados cada que un país es seleccionado
function actualizarEstados() {

  if (selectEstados.hasClass("is-valid")) { // ESTO ES PARA QUE CON CADA CAMBIO DE PAÍS EL SELECT PIERDA SU VALIDACIÓN
    selectEstados.removeClass("is-valid");
    selectEstados.prop('disabled', true);
  }

  var valorSeleccionado = $('#paisOrigen').val();

  $.ajax({
    url: './Acciones/listarEstadosPais.php',
    type: 'POST',
    data: { ubicacionpaisid: valorSeleccionado },
    success: function (data) {
      estados = JSON.parse(data)

      estructura = "";
      estructura += "<option value='' disabled selected data-error='Por favor seleccione un estado válido'>Selecciona una opción</option>";
      $.each(estados, function (index, estado) {
        estructura += "<option value=" + estado.id + ">" + estado.nombre + "</option>";
      });

      selectEstados.html(estructura);
      selectEstados.prop('disabled', false); //Vuelve a activar el select despues de volver a armar las opciones de estados
    },
  });

}
