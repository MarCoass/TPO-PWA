
document.addEventListener("DOMContentLoaded", function () {
  // Obtener referencia al select
  const tabla = document.getElementById("tabla");

  // Recupera el array de objetos JSON del localStorage
  const json = localStorage.getItem("competidores");

  // Convierte el JSON a un array de objetos JavaScript
  const arrayCompetidores = JSON.parse(json);

arrayCompetidores.forEach(competidor => {
  const miTabla = document.getElementById("tabla");
  const nuevaFila = miTabla.insertRow(); // crea una nueva fila vacía
  const celdaLegajo = nuevaFila.insertCell();
  celdaLegajo.textContent = competidor.legajo;

  const celdaApellido = nuevaFila.insertCell(); // agrega una celda para la edad
  celdaApellido.textContent = competidor.apellido; // agrega la edad a la celda

  const celdaNombre = nuevaFila.insertCell(); // agrega una celda para el nombre
  celdaNombre.textContent = competidor.nombre; // agrega el nombre a la celda

  const celdaDU = nuevaFila.insertCell();
  celdaDU.textContent = competidor.du;

  const celdaMail = nuevaFila.insertCell();
  celdaMail.textContent = competidor.email;

  const celdaFecNac = nuevaFila.insertCell();
  celdaFecNac.textContent = competidor.fechaNacimiento;

  const celdaPais = nuevaFila.insertCell();
  celdaPais.innerHTML =
    '<img src="svg/' +
    competidor.paisOrigen +
    '.svg" alt="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" width="20px">';
  //celdaPais.textContent = competidor.paisOrigen;

  const celdaGenero = nuevaFila.insertCell();
  celdaGenero.textContent = competidor.genero;

  const celdaGraduacion = nuevaFila.insertCell();
  celdaGraduacion.textContent = competidor.graduacion;

  const celdaRanking = nuevaFila.insertCell();
  celdaRanking.textContent = competidor.rankingNacional;

});

});
