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

    const datosCompetidor4 = {
        legajo: "DEF7654321",
        apellido: "Pérez",
        nombre: "Julieta",
        du: "87654321",
        fechaNacimiento: "1999-12-10",
        paisOrigen: "Argentina",
        graduacion: "1er DAN",
        rankingNacional: 400,
        email: "julieta.perez@example.com",
        genero: "femenino",
    };

    const datosCompetidor5 = {
        legajo: "MNO1357902",
        apellido: "González",
        nombre: "Sebastián",
        du: "13579023",
        fechaNacimiento: "2002-11-30",
        paisOrigen: "Colombia",
        graduacion: "2do DAN",
        rankingNacional: 900,
        email: "sebastian.gonzalez@example.com",
        genero: "masculino",
    };

const datosCompetidor6 = {
        legajo: "PQR2468013",
        apellido: "Rodríguez",
        nombre: "Camila",
        du: "24680135",
        fechaNacimiento: "2003-06-22",
        paisOrigen: "Uruguay",
        graduacion: "3er DAN",
        rankingNacional: 100,
        email: "camila.rodriguez@example.com",
        genero: "femenino",
    };

const datosCompetidor7 = {
        legajo: "STU3690124",
        apellido: "López",
        nombre: "Jorge",
        du: "36901247",
        fechaNacimiento: "1998-09-15",
        paisOrigen: "Perú",
        graduacion: "1er GUP",
        rankingNacional: 600,
        email: "jorge.lopez@example.com",
        genero: "masculino",
    };

const datosCompetidor8 = {
        legajo: "VWX4816235",
        apellido: "Gómez",
        nombre: "Lucía",
        du: "48162358",
        fechaNacimiento: "2001-03-08",
        paisOrigen: "Chile",
        graduacion: "2do GUP",
        rankingNacional: 800,
        email: "lucia.gomez@example.com",
        genero: "femenino",
    };

const datosCompetidor9 = {
        legajo: "YZA7037469",
        apellido: "Fernández",
        nombre: "Pedro",
        du: "70374692",
        fechaNacimiento: "1997-12-02",
        paisOrigen: "Argentina",
        graduacion: "3er GUP",
        rankingNacional: 160,
        email: "pedro.fernandez@example.com",
        genero: "masculino",
    };

    const jsonCompetidores = JSON.stringify([datosCompetidor1, datosCompetidor2, datosCompetidor3, datosCompetidor4, datosCompetidor5, datosCompetidor6, datosCompetidor7, datosCompetidor8, datosCompetidor9]);

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
    const inputsValidados = document.querySelectorAll(".form-control");
    const todosValidados = Array.from(inputsValidados).every(input => input.checkValidity());

    // Si todos los inputs están validados, hacer algo
    if (todosValidados) {
        arrayCompetidores = obtenerCompetidores();

        nuevoCompetidor = obtenerValoresInputs();

        // CREAMOS EL OBJETO CONTROL 
        var controlCompetidor = new ControlCompetidor();
        // RECIBE POR PARÁMETRO LOS DATOS VALIDADOS POR EL FORM, RETORNARA UNA ESTRUCTURA HTML CON LA INFO DEL COMPETIDOR SI ES QUE TODO ESTA BIEN
        // EN CASO DE QUE ALGÚN DATO SEA ERRONEO RETORNARA UNA ESTRUCTURA LISTANDO TODOS LOS ERRORES ENCONTRADOS
        estructuraRetorno = controlCompetidor.crearCompetidor(nuevoCompetidor, arrayCompetidores);

        var miModal = document.querySelector('#modalForm');
        var modal = new bootstrap.Modal(miModal);

        $("#cuerpoModal").html(estructuraRetorno);

        modal.show();
    }
});

function obtenerValoresInputs() {
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
    return datosNuevoCompetidor = {
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
}

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