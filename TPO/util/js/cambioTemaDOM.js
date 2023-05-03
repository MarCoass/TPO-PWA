const BOTONOSCURO = document.getElementById("botonTemaOscuro");
const BOTONCLARO = document.getElementById("botonTemaClaro");
const BODY = document.body;
const SECCIONES = document.querySelectorAll(".bg-seccion2");
const FOOTER = document.getElementById("footer");
const MODALFORM = document.getElementById("ModalContenido");
const MODALFORMTITULO = document.getElementById("ModalFormTitulo");

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
  localStorage.setItem("tema", "claro");

  //Cambio de temas del modal del form
  MODALFORM.classList.add("text-bg-light");
  MODALFORM.classList.remove("text-bg-dark");
  
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

  localStorage.setItem("tema", "oscuro");
 
  //Cambio de temas del modal del form
  MODALFORM.classList.remove("text-bg-light");
  MODALFORM.classList.add("text-bg-dark");
  console.log(MODALFORM)
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
