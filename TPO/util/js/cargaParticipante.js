/* Establece la fecha max de la inscripcion */
var fechaActual = new Date();
var fechaMaxima = new Date(fechaActual.getFullYear() - 6, fechaActual.getMonth(), fechaActual.getDate()).toISOString().split("T")[0];
document.getElementById("fechaNacimiento").max = fechaMaxima;

/* ########################################################## CARGA PARTICIPANTE ############################################################ */
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

        $.ajax({
            type: "POST",
            url: "../Acciones/guardarCompetidor.php", // archivo PHP que guardará los datos
            data: { nuevoCompetidor },
            success: function (response) {
                console.log(response);
            }
        });

        /*var miModal = document.querySelector('#modalForm');
        var modal = new bootstrap.Modal(miModal);

        $("#cuerpoModal").html(estructuraRetorno);

        modal.show();*/
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

/* ########################################################## APLICAR CLASES VALID OR INVALID BOOTSTRAP ############################################################ */
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                /* 
                    Cuando se invoca el método checkValidity (), si el elemento es candidato para la validación de restricciones y no satisface sus restricciones, 
                    el agente de usuario debe disparar un evento simple llamado inválido que es cancelable (pero en este caso no tiene una acción predeterminada) 
                    en el elemento y devuelve falso. De lo contrario, solo debe volver a verdadero sin hacer nada más.
                */
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
            /* se añade al boton limpiar una funcion que remueve la clase was-validated del form para que vuelva a su estilo inicial*/
            form.addEventListener('reset', function () {
                form.classList.remove('was-validated')
            }, false)
        })
})()



/* ########################################################## CAMBIAR TABS FORMULARIO ############################################################ */
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