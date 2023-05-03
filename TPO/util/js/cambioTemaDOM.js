const BOTONOSCURO = document.getElementById("botonTemaOscuro");
const BOTONCLARO = document.getElementById("botonTemaClaro");
const BODY = document.body;
const SECCIONES = document.querySelectorAll(".bg-seccion2");
const FOOTER = document.getElementById("footer");
const MODALFORM = document.getElementById("ModalContenido");
const MODALCONTENIDO = document.getElementById("modalResultadoContenido");
const TABLA = document.getElementById("tabla");

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
  TABLA.classList.add("text-bg-light")
  TABLA.classList.remove("text-bg-dark")

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
  TABLA.classList.remove("text-bg-light")
  TABLA.classList.add("text-bg-dark")

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
