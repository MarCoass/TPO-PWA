/* ########################################################## OBTENCIÓN COMPETIDORES ############################################################3 */
/* Establece la fecha max de la inscripcion */
var fechaActual = new Date();
var fechaMaxima = new Date(fechaActual.getFullYear() - 6, fechaActual.getMonth(), fechaActual.getDate()).toISOString().split("T")[0];
document.getElementById("fechaNacimiento").max = fechaMaxima;


/* Carga competidores default en localstorage */
const competidores = localStorage.getItem('competidores');
if (competidores === null) {
    setearCompetidores();
}

function setearCompetidores() {
    const datosCompetidor1 = {
        legajo: "ABC1234567",
        apellido: "Centurión",
        nombre: "Braian",
        du: "12345678",
        fechaNacimiento: "2001-04-08",
        paisOrigen: "Chile",
        graduacion: "2do GUP",
        rankingNacional: 750,
        email: "braian.cent@example.com",
        genero: "masculino",
    };

    const datosCompetidor2 = {
        legajo: "DEF2345678",
        apellido: "Coassin",
        nombre: "Martina",
        du: "23456789",
        fechaNacimiento: "2001-08-25",
        paisOrigen: "Argentina",
        graduacion: "1er DAN",
        rankingNacional: 600.5,
        email: "mar.coassin@example.com",
        genero: "femenino",
    };

    const datosCompetidor3 = {
        legajo: "GHI3456789",
        apellido: "Farfan",
        nombre: "Matias",
        du: "34567890",
        fechaNacimiento: "1995-03-15",
        paisOrigen: "Colombia",
        graduacion: "5to GUP",
        rankingNacional: 350,
        email: "matias.farfan@example.com",
        genero: "masculino",
    };

    const jsonCompetidores = JSON.stringify([datosCompetidor1, datosCompetidor2, datosCompetidor3]);

    localStorage.setItem('competidores', jsonCompetidores);
}
/* fin carga competidor default */

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
    //console.log(competidor.validarDatos())
    //onsole.log(competidor)
    if (competidor.validarDatos()) {
        arrayCompetidores.push(new Competidor(nuevoCompetidor));

        var miModal = document.querySelector('#modalForm');
        var modal = new bootstrap.Modal(miModal);

        var texto = "Legajo: " + competidor.legajo +
            "<br>Apellido: " + competidor.apellido +
            "<br>Nombre: " + competidor.nombre +
            "<br>DNI: " + competidor.du +
            "<br>Mail: " + competidor.email +
            "<br>Pais: " + competidor.paisOrigen +
            "<br>Genero: " + competidor.genero +
            "<br>Graduacion: " + competidor.graduacion +
            "<br>Ranking: " + competidor.rankingNacional ;
        $("#cuerpoModal").html(texto);


        modal.show();
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