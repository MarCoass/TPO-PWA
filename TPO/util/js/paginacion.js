$(document).ready(function () {
  armarTabla();
});

function obtenerCompetidores() {
  var competidoresObtenidos;
  $.ajax({
    url: 'http://localhost/TPO-PWA/TPO/vista/Acciones/listarCompetidor.php',
    dataType: 'json',
    async: false, // Hacer la solicitud AJAX de manera síncrona
    success: function (response) {
      competidoresObtenidos = response;
    }
  });
  return competidoresObtenidos;
}

function obtenerGenero(generoCompetidor) {
  icono = "";
  switch (generoCompetidor.toLowerCase()) {
    case "masculino":
      icono += "<i class='bi bi-gender-male' data-bs-toggle='tooltip' title='Masculino'></i>";
      break;
    case "femenino":
      icono += "<i class='bi bi-gender-female' data-bs-toggle='tooltip' title='Femenino'></i>"
      break;
  }

  return icono;
}

function obtenerBandera(pais) {
  $.ajax({
    url: 'https://flagcdn.com/es/codes.json',
    dataType: 'json',
    async: false, // Hacer la solicitud AJAX de manera síncrona
    success: function (response) {
      for (var nomcltr in response) {
        var valor = response[nomcltr]
        if (pais === valor) {
          dile = nomcltr
        }
      }
    }
  });
  return dile;
}

function armarTabla() {
  let container = $("#bfTabla");

  // Obtenemos los competidores
  var arrayCompetidores = obtenerCompetidores();
  //console.table(arrayCompetidores)

  container.pagination({
    dataSource: arrayCompetidores,
    pageSize: 5,
    className: 'paginationjs-theme-red paginationjs-big',
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
        celdaFecNac.textContent = competidor.edad;
        celdaFecNac.classList.add("d-none", "d-lg-table-cell");

        const celdaPais = nuevaFila.insertCell();
        celdaPais.innerHTML =
          '<img src="../util/svg/' +
          obtenerBandera(competidor.paisOrigen) +
          '.svg" alt="..." data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="' +
          competidor.paisOrigen +
          '" width="20px">';
        celdaPais.classList.add("d-none", "d-lg-table-cell");

        const celdaGenero = nuevaFila.insertCell();
        iconoGenero = obtenerGenero(competidor.genero);
        celdaGenero.innerHTML = iconoGenero
        celdaGenero.classList.add("d-none", "d-lg-table-cell");

        const celdaGraduacion = nuevaFila.insertCell();
        const botonGraduacion =
          '<button type="button" class="btn btn-outline-dark btn-sm">' +
          competidor.graduacion +
          "</button>";
        celdaGraduacion.innerHTML = botonGraduacion;

        const celdaRanking = nuevaFila.insertCell();
        const contenidoRanking = "<i class='bi bi-award me-1'></i>" + competidor.rankingNacional;
        celdaRanking.innerHTML = contenidoRanking;
      });

      /* INCIALIZA LOS TOOLTIPS, SIN ESTO NO FUNCIONAN */
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    },
  });
}


/*
⢀⡴⠑⡄⠀⠀⠀⠀⠀⠀⠀⣀⣀⣤⣤⣤⣀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀ 
⠸⡇⠀⠿⡀⠀⠀⠀⣀⡴⢿⣿⣿⣿⣿⣿⣿⣿⣷⣦⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀ 
⠀⠀⠀⠀⠑⢄⣠⠾⠁⣀⣄⡈⠙⣿⣿⣿⣿⣿⣿⣿⣿⣆⠀⠀⠀⠀⠀⠀⠀⠀ 
⠀⠀⠀⠀⢀⡀⠁⠀⠀⠈⠙⠛⠂⠈⣿⣿⣿⣿⣿⠿⡿⢿⣆⠀⠀⠀⠀⠀⠀⠀ 
⠀⠀⠀⢀⡾⣁⣀⠀⠴⠂⠙⣗⡀⠀⢻⣿⣿⠭⢤⣴⣦⣤⣹⠀⠀⠀⢀⢴⣶⣆ 
⠀⠀⢀⣾⣿⣿⣿⣷⣮⣽⣾⣿⣥⣴⣿⣿⡿⢂⠔⢚⡿⢿⣿⣦⣴⣾⠁⠸⣼⡿ 
⠀⢀⡞⠁⠙⠻⠿⠟⠉⠀⠛⢹⣿⣿⣿⣿⣿⣌⢤⣼⣿⣾⣿⡟⠉⠀⠀⠀⠀⠀ 
⠀⣾⣷⣶⠇⠀⠀⣤⣄⣀⡀⠈⠻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀ 
⠀⠉⠈⠉⠀⠀⢦⡈⢻⣿⣿⣿⣶⣶⣶⣶⣤⣽⡹⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀ 
⠀⠀⠀⠀⠀⠀⠀⠉⠲⣽⡻⢿⣿⣿⣿⣿⣿⣿⣷⣜⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀ 
⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⣷⣶⣮⣭⣽⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⠀⠀⠀ 
⠀⠀⠀⠀⠀⠀⣀⣀⣈⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠇⠀⠀⠀⠀⠀⠀⠀ 
⠀⠀⠀⠀⠀⠀⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⠀⠀⠀⠀⠀⠀⠀ 
⠀⠀⠀⠀⠀⠀⠀⠹⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠟⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀ 
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠛⠻⠿⠿⠿⠿⠛⠉
*/
