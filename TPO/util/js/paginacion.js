$(function () {
  let container = $("#tabla");
  // Recupera el array de objetos JSON del localStorage
  const json = localStorage.getItem("competidores");

  // Convierte el JSON a un array de objetos JavaScript
  const arrayCompetidores = JSON.parse(json);
  
  container.pagination({
    dataSource: arrayCompetidores,
    pageSize: 5,
    className: 'paginationjs-theme-red paginationjs-big d-flex',
    showSizeChanger: true,
    callback: function (data, pagination) {
        $("#tablaBody").html("");
      $.each(data, function (index, competidor) {
        const miTabla = document.getElementById("tablaBody");
        const nuevaFila = miTabla.insertRow(); // crea una nueva fila vacía
        const celdaLegajo = nuevaFila.insertCell();
        celdaLegajo.textContent = competidor.legajo;

        const celdaApellido = nuevaFila.insertCell(); // agrega una celda para la edad
        celdaApellido.textContent = competidor.apellido; // agrega la edad a la celda
        celdaApellido.classList.add("d-none", "d-sm-table-cell");

        const celdaNombre = nuevaFila.insertCell(); // agrega una celda para el nombre
        celdaNombre.textContent = competidor.nombre; // agrega el nombre a la celda
        celdaNombre.classList.add("d-none", "d-sm-table-cell");

        const celdaDU = nuevaFila.insertCell();
        celdaDU.textContent = competidor.du;
        celdaDU.classList.add("d-none", "d-md-table-cell");

        const celdaMail = nuevaFila.insertCell();
        celdaMail.textContent = competidor.email;
        celdaMail.classList.add("d-none", "d-md-table-cell");

        const celdaFecNac = nuevaFila.insertCell();
        var fecha = new Date(competidor.fechaNacimiento);
        var fechaFormateada =
          fecha.getDate() +
          "-" +
          (fecha.getMonth() + 1) +
          "-" +
          fecha.getFullYear();
        celdaFecNac.textContent = fechaFormateada;
        celdaFecNac.classList.add("d-none", "d-lg-table-cell");

        const celdaPais = nuevaFila.insertCell();
        celdaPais.innerHTML =
          '<img src="../util/svg/' +
          competidor.paisOrigen +
          '.svg" alt="" data-bs-toggle="tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="' +
          competidor.paisOrigen +
          '" width="20px">';
        celdaPais.classList.add("d-none", "d-lg-table-cell");

        const celdaGenero = nuevaFila.insertCell();
        celdaGenero.textContent = competidor.genero;
        celdaGenero.classList.add("d-none", "d-lg-table-cell");

        const celdaGraduacion = nuevaFila.insertCell();
        const botonGraduacion =
          '<button type="button" class="btn btn-outline-dark btn-sm">' +
          competidor.graduacion +
          "</button>";
        celdaGraduacion.innerHTML = botonGraduacion;

        const celdaRanking = nuevaFila.insertCell();
        const contenidoRanking =
          '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award me-2" viewBox="0 0 16 16"><path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/><path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/></svg>' +
          competidor.rankingNacional;
        celdaRanking.innerHTML = contenidoRanking;
      });

    },
  });
});
