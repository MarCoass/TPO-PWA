//Faltaria que se cargue desde lo guardado en el localStorage, sino solo carga los del json tablaDatos.json

document.addEventListener("DOMContentLoaded", function () {
  // Obtener referencia al select
  const tabla = document.getElementById("tabla");

  // Obtener datos del archivo JSON
  fetch("tablaDatos.json")
    .then((response) => response.json())
    .then((data) => {
      // Iterar sobre los datos y crear opciones
      data.forEach((competidor) => {
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
        celdaPais.textContent = competidor.paisOrigen;

        const celdaGenero = nuevaFila.insertCell();
        celdaGenero.textContent = competidor.genero;

        const celdaGraduacion = nuevaFila.insertCell();
        celdaGraduacion.textContent = competidor.graduacion;

        const celdaRanking = nuevaFila.insertCell();
        celdaRanking.textContent = competidor.rankingNacional;


      });
    })
    .catch((error) => console.error(error));
});
