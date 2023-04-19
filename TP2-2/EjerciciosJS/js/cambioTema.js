const ESTILOS = getComputedStyle(document.documentElement);
const BOTONOSCURO = document.getElementById("botonTemaOscuro");
const BOTONCLARO = document.getElementById("botonTemaClaro");
const BODY = document.body;
const CONTENIDO = document.getElementById("contenido");
const SECCIONES = document.querySelectorAll(".bg-seccion2");
const FOOTER = document.getElementById("footer");

BODY.style.transitionProperty = "background";
BODY.style.transitionDuration = "2s";

function cambiarClaro() {
  BOTONOSCURO.classList.toggle("d-none");
  BOTONCLARO.classList.toggle("d-none");
  BODY.classList.toggle("bg-dark");
  CONTENIDO.classList.toggle("text-bg-dark");
  for (var i = 0; i < SECCIONES.length; i++) {
    SECCIONES[i].classList.add("bg-seccion2");
    SECCIONES[i].classList.remove("bg-seccion-dark");
  }
  FOOTER.classList.remove("bg-seccion-dark");
  FOOTER.classList.add("bg-danger");

  localStorage.setItem("tema", "claro");
}
function cambiarOscuro() {
  BOTONOSCURO.classList.toggle("d-none");
  BOTONCLARO.classList.toggle("d-none");
  BODY.classList.toggle("bg-dark");
  CONTENIDO.classList.toggle("text-bg-dark");
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
