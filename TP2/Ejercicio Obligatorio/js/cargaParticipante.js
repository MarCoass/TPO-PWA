/* ########################################################## OBTENCIÓN COMPETIDORES ############################################################3 */
/* Obtiene el JSON almacenado en el localStorage y lo convierte en un arreglo de objetos */
function obtenerCompetidores() {
    const competidoresJson = localStorage.getItem('competidores');
    let arreglo = [];

    if (competidoresJson !== null) {
        // Si hay datos en localStorage, los parseamos
        const competidores = JSON.parse(competidoresJson);

        // Recorremos los competidores
        for (const datosCompetidor of competidores) {
            const competidor = new Competidor(datosCompetidor);
            // Guardamos los objetos en el arreglo
            // console.log(competidor.verPerfil());
            arreglo.push(competidor);
        }
    }
    // console.table(arreglo);

    return arreglo;
}

/* ########################################################## CARGA PARTICIPANTE ############################################################3 */
// Obtenemos el formulario por su ID
const form = document.getElementById('cargaParticipante');

// Submit del formulario

form.addEventListener('submit', (event) => {
    event.preventDefault(); // Evitar que el formulario se envíe de forma predeterminada
    arrayCompetidores = obtenerCompetidores();

    // Obtener los valores de los campos del formulario
    const legajo = document.getElementById('legajo').value;
    const apellido = document.getElementById('apellido').value;
    const nombre = document.getElementById('nombre').value;
    const dni = document.getElementById('dni').value;
    const fechaNacimiento = document.getElementById('fechaNacimiento').value;
    const genero = document.getElementById('genero').value;
    const email = document.getElementById('email').value;
    const paisOrigen = document.getElementById('paisOrigen').value;
    const rankingNacional = document.getElementById('rankingNacional').value;
    const graduacion = document.getElementById('graduacion').value;

    // Creamos el arreglo para cargar el Objeto
    const nuevoCompetidor = {
        legajo: legajo,
        apellido: apellido,
        nombre: nombre,
        du: dni,
        fechaNacimiento: fechaNacimiento,
        paisOrigen: paisOrigen,
        graduacion: graduacion,
        rankingNacional: rankingNacional,
        email: email,
        genero: genero,
    };

    // Creamos el Objeto Competidor y lo sumamos a la colección

    var competidor = new Competidor(nuevoCompetidor);
    console.log(competidor.validarDatos())
    console.log(competidor)
    if(competidor.validarDatos()){
        arrayCompetidores.push(new Competidor(nuevoCompetidor));
    } else {
        console.log("datos incorrectos")
    }
    
    //console.log(arrayCompetidores)
    localStorage.setItem("competidores", JSON.stringify(arrayCompetidores));
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