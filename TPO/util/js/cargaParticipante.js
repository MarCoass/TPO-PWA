/* ########################################################## OBTENCIÓN COMPETIDORES ############################################################3 */
/* Establece la fecha max de la inscripcion */
var fechaActual = new Date();
var fechaMaxima = new Date(fechaActual.getFullYear() - 6, fechaActual.getMonth(), fechaActual.getDate()).toISOString().split("T")[0];
document.getElementById("fechaNacimiento").max = fechaMaxima;

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
        nuevoCompetidor = obtenerValoresInputs();

        // CREAMOS EL OBJETO CONTROL 
        var controlCompetidor = new ControlCompetidor();
        // RECIBE POR PARÁMETRO LOS DATOS VALIDADOS POR EL FORM, RETORNARA UNA ESTRUCTURA HTML CON LA INFO DEL COMPETIDOR SI ES QUE TODO ESTA BIEN
        // EN CASO DE QUE ALGÚN DATO SEA ERRONEO RETORNARA UNA ESTRUCTURA LISTANDO TODOS LOS ERRORES ENCONTRADOS
        estructuraRetorno = controlCompetidor.crearCompetidor(nuevoCompetidor);

        var miModal = document.querySelector('#modalForm');
        var modal = new bootstrap.Modal(miModal);

        $("#cuerpoModal").html(estructuraRetorno);

        modal.show();

        // Obtenemos los datos actuales del archivo JSON
        $.getJSON("../util/json/competidoresGuardados.json", function (datos) {
            // Agregamos el nuevo objeto al final del arreglo
            datos.unshift(nuevoCompetidor);

            // Convertimos los datos a formato JSON
            var datosJSON = JSON.stringify(datos);

            // Guardamos los datos en el archivo JSON
            $.ajax({
                type: "POST",
                url: "guardarCompetidores.php", // archivo PHP que guardará los datos
                data: {
                    datos: datosJSON
                },
                success: function () {
                    console.log("Datos guardados correctamente");
                }
            });
        });
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