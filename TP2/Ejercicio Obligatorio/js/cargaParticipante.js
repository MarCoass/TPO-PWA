/* ########################################################## CARGA PARTICIPANTE ############################################################3 */
// Obtener el formulario por su ID
const form = document.getElementById('cargaParticipante');

// Agregar un evento al formulario cuando se envíe
form.addEventListener('submit', (event) => {
  event.preventDefault(); // Evitar que el formulario se envíe de forma predeterminada

  // Obtener los valores de los campos del formulario
  const nombre = document.getElementById('nombre').value;
  const edad = document.getElementById('edad').value;
  const email = document.getElementById('email').value;
  const telefono = document.getElementById('telefono').value;

  // Crear un objeto Competidor con los valores del formulario
  const competidor = new Competidor(nombre, edad, email, telefono);

  // Hacer lo que necesites con el objeto Competidor
  console.log(competidor);
});

/* ########################################################## CAMBIAR TABS FORMULARIO ############################################################3 */
function showTab(tabId, link1, link2) {
    // Obtener el tab actual
    var currentTab = document.querySelector('.tab-pane.active');

    // Ocultar el tab actual
    currentTab.classList.remove('active');
    currentTab.classList.remove('show');

    // Mostrar el tab correspondiente al ID
    var newTab = document.getElementById(tabId);
    newTab.classList.add('active');
    newTab.classList.add('show');

    // Actualizar los nav-links
    var enlace1 = document.getElementById(link1);
    enlace1.classList.add('active');
    var enlace2 = document.getElementById(link2);
    enlace2.classList.remove('active');
}