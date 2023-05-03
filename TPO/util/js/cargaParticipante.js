/* Establece la fecha max de la inscripcion */
var fechaActual = new Date();
var fechaMaxima = new Date(fechaActual.getFullYear() - 6, fechaActual.getMonth(), fechaActual.getDate()).toISOString().split("T")[0];
document.getElementById("fechaNacimiento").max = fechaMaxima;

/* ########################################################## SUBMIT Y VALIDACIÓN DEL FORMULARIO ############################################################ */
const formulario = document.getElementById("cargaParticipante");
validarFormulario(formulario);

/* Se encarga de validar los datos del nuevo competidor, en caso de que ya existan agregara una nueva clase con otros colores */
function consultaVerificacion(input, valor, tipo) {
    $.ajax({
        url: "./Acciones/validarCompetidor.php",
        type: "POST",
        data: { valor: valor, tipo: tipo },
        success: function (response) {
            //console.log(response);
            respuesta = JSON.parse(response)
            if (respuesta) { // Si el valor ya esta registrado, agregamos la nueva clase y removemos "is-valid"
                input.classList.remove("is-valid");
                input.classList.add("verificacion-invalid");
            } else { // En caso de que no se encuentre, removemos la clase por si ya la tenia de antes
                input.classList.remove("verificacion-invalid");
            }

            var errorDiv = input.parentNode.querySelector(".verificacion-invalid-feedback"); // Buscamos al div que cumple la misma función de los "invalid/valid-feedback"
            if (errorDiv) {
                errorDiv.style.display = !respuesta ? "none" : "block"; // Lo quita o agrega según la respuesta
            }
        }
    });
}

/* Esta funcion es para verificar los inputs DU y Legajo ya que al no contar con la clase "is-invalid" la funcion checkValidity los tomará como OK */
function validarVerificaciones(inputs) {
    let esValido = true;

    inputs.forEach((input) => {
        if (!input.checkValidity() || input.classList.contains('verificacion-invalid')) {
            // Si el campo de entrada no es válido o tiene la clase "verificacion-invalid"
            esValido = false; // El formulario no es válido
        }
    });

    return esValido;
}

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
                    consultaVerificacion(input, value, "Du");
                }

                // Si el id del input es "legajo", se realiza la validación adicional
                if (input.id === "legajo") {
                    consultaVerificacion(input, value, "Legajo");
                }

            } else {
                input.classList.remove("is-valid");
                input.classList.add("is-invalid");

                /* Condicional necesario, en esta instancia, puede que hayas ingresado un DU o Legajo ya existente, borras uno solo caracter y se agregará la clase
                is-invalid, pero la razón por la que no desaparece el div VIF es porque la función para el input dni SOLO se llama cuando el valor de este iguala al
                maxlength, osea que si tenemos menos caracteres del limite, la funcion nunca será llamada y por eso el VIF no se removerá*/
                var errorDiv = input.parentNode.querySelector(".verificacion-invalid-feedback");
                if (errorDiv) {
                    errorDiv.style.display = "none" // Lo quitamos
                }
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

        const inputsVerificables = form.querySelectorAll('.verificable');

        if (form.checkValidity() && validarVerificaciones(inputsVerificables)) { // SI TODOS LOS INPUTS SON VÁLIDOS
            nuevoCompetidor = obtenerValoresInputs();

            //console.log(nuevoCompetidor);
            $.ajax({
                type: "POST",
                url: "./Acciones/guardarCompetidor.php", // archivo PHP que guardará los datos
                data: nuevoCompetidor,
                success: function (response) {
                    //console.log(response);
                    respuestaCarga = JSON.parse(response)

                    //Ocultamos el modal del formulario
                    $('#modalFormCompetidor').modal('hide');
                    //Abrir modal de resultado
                    $('#modalResultadoCarga').modal('show');

                    // Mostramos el mensaje en el modal según si la carga fue exitosa o no
                    textoModal = document.getElementById("mensajeCarga");
                    if (respuestaCarga) {
                        textoModal.innerHTML = "<div class='alert alert-success' role='alert'><i class='bi bi-check2-circle me-1'></i>Competidor cargado correctamente!</div>";
                    } else {
                        textoModal.innerHTML = "<div class='alert alert-danger' role='alert'><i class='bi bi-x-circle me-1'></i>Error al cargar el competidor!</div>";
                    }
                }
            });

            form.reset(); // BORRA LOS VALORES DE LOS INPUTS
            const formControlElements = document.querySelectorAll('.form-control');
            for (let i = 0; i < formControlElements.length; i++) { // QUITA LAS VALIDACIONES DE LOS INPUTS Y REMUEVE LOS valid-feedback
                formControlElements[i].classList.remove('is-valid'); // REMOVEMOS LA CLASE "IS-VALID" PORQUE SI SE HIZO SUBMIT FUE PORQUE TODOS LOS INPUTS ESTABAN BIEN
                const validFeedbackSibling = formControlElements[i].nextElementSibling;
                if (validFeedbackSibling && validFeedbackSibling.classList.contains('valid-feedback')) { // OCULTAMOS TODOS LOS DIV valid-feedback
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

// Ocultamos el modal que muestra la carga exitosa y refresca la tabla
$(".botonResultado").on("click", function () {
    $("#modalResultadoCarga").modal('hide');
    armarTabla();
});
