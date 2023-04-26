const BOTONOSCURO = document.getElementById("botonTemaOscuro");
const BOTONCLARO = document.getElementById("botonTemaClaro");
const BODY = document.body;
const SECCIONES = document.querySelectorAll(".bg-seccion2");
const FOOTER = document.getElementById("footer");
const TEXTOCONTADOR = document.getElementsByClassName("textoContador");

function cambiarClaro() {
  BOTONOSCURO.classList.toggle("d-none");
  BOTONCLARO.classList.toggle("d-none");
  BODY.classList.toggle("bg-dark");

  for (var i = 0; i < SECCIONES.length; i++) {
    SECCIONES[i].classList.add("bg-seccion2");
    SECCIONES[i].classList.remove("bg-seccion-dark");
  }
  FOOTER.classList.toggle("bg-danger");
  FOOTER.classList.remove("bg-seccion-dark");
  localStorage.setItem("tema", "claro");
}
function cambiarOscuro() {
  BOTONOSCURO.classList.toggle("d-none");
  BOTONCLARO.classList.toggle("d-none");
  BODY.classList.toggle("bg-dark");
  TEXTOCONTADOR.classList.toggle("bg-danger");
  for (var i = 0; i < SECCIONES.length; i++) {
    SECCIONES[i].classList.add("bg-seccion-dark");
    SECCIONES[i].classList.remove("bg-seccion2");
  }
  FOOTER.classList.add("bg-seccion-dark");
  FOOTER.classList.remove("bg-danger");

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
