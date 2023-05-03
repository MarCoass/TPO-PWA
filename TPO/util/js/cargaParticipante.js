/* Establece la fecha max de la inscripcion */
var fechaActual = new Date();
var fechaMaxima = new Date(fechaActual.getFullYear() - 6, fechaActual.getMonth(), fechaActual.getDate()).toISOString().split("T")[0];
document.getElementById("fechaNacimiento").max = fechaMaxima;

/* ########################################################## SUBMIT Y VALIDACIÓN DEL FORMULARIO ############################################################ */
const formulario = document.getElementById("cargaParticipante");
validarFormulario(formulario);

function validarFormulario(form) {
    const inputs = form.querySelectorAll("input"); // OBTENGO LOS INPUTS DEL FORM

    inputs.forEach(input => { // VALIDA CUANDO SE INGRESA ALGO EN LOS INPUTS
        const regex = new RegExp(input.pattern);

        input.addEventListener("input", function () {
            const value = input.value;
            const isValid = regex.test(value);

            if (isValid) {
                input.classList.remove("is-invalid");
                input.classList.add("is-valid");

                // Si el id del input es "dni", se realiza la validación adicional
                if (input.id === "dni" && value.length === parseInt(input.getAttribute("maxlength"))) {
                    $.ajax({
                        url: "./Acciones/validarCompetidor.php",
                        type: "POST",
                        data: { valor: value, tipo: "Du" },
                        success: function (response) {
                            if (response) {
                                input.classList.remove("is-valid");
                                input.classList.add("is-invalid");
                            }
                        }
                    });
                }

                // Si el id del input es "legajo", se realiza la validación adicional
                if (input.id === "legajo") {
                    $.ajax({
                        url: "./Acciones/validarCompetidor.php",
                        type: "POST",
                        data: { valor: value, tipo: "Legajo" },
                        success: function (response) {
                            if (response) {
                                input.classList.remove("is-valid");
                                input.classList.add("is-invalid");
                            }
                        }
                    });
                }

            } else {
                input.classList.remove("is-valid");
                input.classList.add("is-invalid");
            }
        });
    });

    const selects = form.querySelectorAll("select"); // OBTENGO LOS SELECTS DEL FORM

    selects.forEach(select => { // VALIDA CUANDO SE SELECCIONA ALGO EN LOS INPUTS
        select.addEventListener("change", function () {
            const value = select.value;

            if (value !== "") {
                select.classList.remove("is-invalid");
                select.classList.add("is-valid");
            } else {
                select.classList.remove("is-valid");
                select.classList.add("is-invalid");
            }
        });
    });

    form.addEventListener("submit", function (event) { // CUANDO SE INTENTA SUBMITEAR EL FORM
        event.preventDefault();

        if (form.checkValidity()) { // SI TODOS LOS INPUTS SON VÁLIDOS
            nuevoCompetidor = obtenerValoresInputs();

            //console.log(nuevoCompetidor);
            $.ajax({
                type: "POST",
                url: "./Acciones/guardarCompetidor.php", // archivo PHP que guardará los datos
                data: nuevoCompetidor,
                success: function (response) {
                    console.log(response);

                    //Abrir modal de resultado
                    $('#modalResultadoCarga').modal('show')
                }
            });

            form.reset(); // BORRA LOS VALORES DE LOS INPUTS
            const formControlElements = document.querySelectorAll('.form-control');
            for (let i = 0; i < formControlElements.length; i++) { // QUITA LAS VALIDACIONES DE LOS INPUTS Y REMUEVE LOS valid-feedback
                formControlElements[i].classList.remove('is-valid');
                const validFeedbackSibling = formControlElements[i].nextElementSibling;
                if (validFeedbackSibling && validFeedbackSibling.classList.contains('valid-feedback')) {
                    validFeedbackSibling.remove();
                }
            }
        } else {
            // SI HAY ALGUN INPUT INVÁLIDO
            $(form).find(':input').each(function () {
                if (!this.validity.valid) {
                    $(this).addClass('is-invalid');
                }
            });
        }
    });
}

function obtenerValoresInputs() {
    // Obtener los valores de los campos del formulario
    const legajo = $('#legajo').val();
    const apellido = $('#apellido').val();
    const nombre = $('#nombre').val();
    const dni = $('#dni').val();
    const fechaNacimiento = $('#fechaNacimiento').val();
    const genero = $('#genero').val();
    const email = $('#email').val();
    const estadoOrigen = $('#estadoOrigen').val();
    const rankingNacional = $('#rankingNacional').val();
    const graduacion = $('#graduacion').val();


    // Creamos el arreglo para cargar el Objeto
    return datosNuevoCompetidor = {
        legajo: legajo,
        apellido: apellido,
        nombre: nombre,
        du: dni,
        fechaNacimiento: fechaNacimiento,
        estadoOrigen: estadoOrigen,
        graduacion: graduacion,
        rankingNacional: rankingNacional,
        email: email,
        genero: genero,
    };
}

/* ########################################################## CAMBIAR TABS FORMULARIO ############################################################ */
function showTab(tabId, valorProgreso, cambiarAviso) {
    // Obtener el tab actual
    var currentTab = document.querySelector('.tab-pane.active');

    // Ocultar el tab actual
    currentTab.classList.remove('active');
    currentTab.classList.remove('show');

    // Mostrar el tab correspondiente al ID
    var newTab = document.getElementById(tabId);
    newTab.classList.add('active');
    newTab.classList.add('show');

    // Avanzar o retrasaar progress bar
    var progressBar = $('.progress-bar');
    progressBar.animate({ 'aria-valuemax': valorProgreso, 'width': valorProgreso + '%' }, 250);

    // Cambia el color del 2do botón
    if (cambiarAviso == "cambiar") {
        $("#botonForm2")
            .removeClass('btn-primary')
            .addClass('btn-secondary');
    } else {
        $("#botonForm2")
            .removeClass('btn-secondary')
            .addClass('btn-primary');
    }
}
