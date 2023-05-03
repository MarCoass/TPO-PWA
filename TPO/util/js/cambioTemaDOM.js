const BOTONOSCURO = document.getElementById("botonTemaOscuro");
const BOTONCLARO = document.getElementById("botonTemaClaro");
const BODY = document.body;
const SECCIONES = document.querySelectorAll(".bg-seccion2");
const FOOTER = document.getElementById("footer");
const MODALFORM = document.getElementById("ModalContenido");
const MODALCONTENIDO = document.getElementById("modalResultadoContenido");
const TABLA = document.getElementById("tabla");
var PAGINACION;
const BOTONESGRADUACION = document.getElementsByClassName("botonGraduacion");

const BOTONINICIO = document.getElementById("startButton");
const BOTONFIN = document.getElementById("stopButton");
const BOTONREINICIO = document.getElementById("restartButton");

const BOTONABRIRMODALFORM = document.getElementById("botonAgregarCompetidor");

const BOTONSIG = document.getElementById("botonSiguiente");
const BOTONVOLVER = document.getElementById("botonVolver");
const BOTONGUARDAR = document.getElementById("botonGuardarCompetidor");

function cambiarClaro() {
  BOTONOSCURO.classList.toggle("d-none");
  BOTONCLARO.classList.toggle("d-none");
  BODY.classList.toggle("bg-dark");
  for (var i = 0; i < SECCIONES.length; i++) {
    SECCIONES[i].classList.add("bg-seccion2");
    SECCIONES[i].classList.remove("bg-seccion-dark");
  }
  FOOTER.classList.remove("bg-seccion-dark");
  FOOTER.classList.toggle("bg-danger");

  //Cambio de temas del modal del form
  MODALFORM.classList.add("text-bg-light");
  MODALFORM.classList.remove("text-bg-dark");

  //Cambio de tema del modal de resultado
  MODALCONTENIDO.classList.add("text-bg-light");
  MODALCONTENIDO.classList.remove("text-bg-dark");

  //Cambio de tema de la tabla
  TABLA.classList.add("table-light");
  TABLA.classList.remove("table-dark");

  //cambio de tema de los botones de graduacion
  for (var i = 0; i < BOTONESGRADUACION.length; i++) {
    BOTONESGRADUACION[i].classList.add("btn-outline-dark");
    BOTONESGRADUACION[i].classList.remove("btn-outline-light");
  }

  // Cambio de tema botones del cronómetro
  BOTONINICIO.classList.add("btn-outline-success");
  BOTONINICIO.classList.remove("btn-success");
  BOTONFIN.classList.add("btn-outline-danger");
  BOTONFIN.classList.remove("btn-danger");
  BOTONREINICIO.classList.add("btn-outline-info");
  BOTONREINICIO.classList.remove("btn-info");

  // Cambio de tema boton agregar competidor
  BOTONABRIRMODALFORM.classList.add("btn-outline-danger");
  BOTONABRIRMODALFORM.classList.remove("btn-danger");

  // Cambio de tema botones formulario
  BOTONSIG.classList.add("btn-outline-primary");
  BOTONSIG.classList.remove("btn-primary");
  BOTONVOLVER.classList.add("btn-outline-primary");
  BOTONVOLVER.classList.remove("btn-primary");
  BOTONGUARDAR.classList.add("btn-outline-success");
  BOTONGUARDAR.classList.remove("btn-success");

  //Guardo preferencia de tema en localStorage
  localStorage.setItem("tema", "claro");
}
function cambiarOscuro() {
  BOTONOSCURO.classList.toggle("d-none");
  BOTONCLARO.classList.toggle("d-none");
  BODY.classList.toggle("bg-dark");
  for (var i = 0; i < SECCIONES.length; i++) {
    SECCIONES[i].classList.add("bg-seccion-dark");
    SECCIONES[i].classList.remove("bg-seccion2");
  }
  FOOTER.classList.add("bg-seccion-dark");
  FOOTER.classList.remove("bg-danger");

  //Cambio de temas del modal del form
  MODALFORM.classList.remove("text-bg-light");
  MODALFORM.classList.add("text-bg-dark");

  //Cambio de tema del modal de resultado
  MODALCONTENIDO.classList.remove("text-bg-light");
  MODALCONTENIDO.classList.add("text-bg-dark");

  //Cambio de tema de la tabla
  TABLA.classList.remove("table-light");
  TABLA.classList.add("table-dark");

  //cambio de tema de los botones de graduacion
  for (var i = 0; i < BOTONESGRADUACION.length; i++) {
    BOTONESGRADUACION[i].classList.add("btn-outline-light");
    BOTONESGRADUACION[i].classList.remove("btn-outline-dark");
  }

  // Cambio de tema botones del cronómetro
  BOTONINICIO.classList.add("btn-success");
  BOTONINICIO.classList.remove("btn-outline-success");
  BOTONFIN.classList.add("btn-danger");
  BOTONFIN.classList.remove("btn-outline-danger");
  BOTONREINICIO.classList.add("btn-info");
  BOTONREINICIO.classList.remove("btn-outline-info");

  // Cambio de tema boton agregar competidor
  BOTONABRIRMODALFORM.classList.add("btn-danger");
  BOTONABRIRMODALFORM.classList.remove("btn-outline-danger");

  // Cambio de tema botones formulario
  BOTONSIG.classList.add("btn-primary");
  BOTONSIG.classList.remove("btn-outline-primary");
  BOTONVOLVER.classList.add("btn-primary");
  BOTONVOLVER.classList.remove("btn-outline-primary");
  BOTONGUARDAR.classList.add("btn-success");
  BOTONGUARDAR.classList.remove("btn-outline-success");

  //Guardo preferencia de tema en localStorage
  localStorage.setItem("tema", "oscuro");
}

BOTONOSCURO.addEventListener("click", () => {
  cambiarOscuro();
});
BOTONCLARO.addEventListener("click", () => {
  cambiarClaro();
});

var temaGuardado = localStorage.getItem("tema");
if (temaGuardado === "oscuro") {
  cambiarOscuro();
}
