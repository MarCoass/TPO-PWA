/* ########################################################## VALIDACIÓN DEL FORMULARIO ############################################################ */
// Mensajes de error para los campos especiales
const MENSAJES = {
    gal: "Campo necesario, necesita 3 letras mayúsculas seguidas de 7 números",
    du: "Deben ser 7 números",
    correo: "Ej: persona@correo.com",
};

/**
 * Dado un input, chequea su validez y le coloca el estilo correspondiente
 * @param {*} input 
 */
const chequearValidez = (input) => {
    if(input.checkValidity()){
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    }else{
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
    }
}

/**
 * Dado un objeto input que requiere validación del servidor, realiza el llamado ajax y lo valida
 * @param {*} input 
 */
const validarAjax = (input) => {
    const ruta = $('#validar').val();
    const campo = (input.id === "correo") ? 'email' : input.id;
    const valor = input.value;

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Necesario para que funcione la petición
        },
        type:"POST",
        url: ruta,
        data: {
            campo : campo,
            valor : valor,
        },
        beforeSend: () => {
            // Mostrar la rueda girando
            $('#'+input.id).siblings('label').children('span').removeClass('d-none');
          },
        complete: () => {
            // Ocultar la rueda girando
            $('#'+input.id).siblings('label').children('span').addClass('d-none');
        },
        success: (response) => {
            // Si no está duplicado, le coloca la clase is-valid.
            // Caso contrario, le coloca is-invalid y el error recibido
            if(response['success'] === 1){	
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }else{
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
                $('#'+input.id).siblings('.invalid-feedback')[0].innerHTML = response['error'];
            }
            
        },
        error: function(xhr, status, error) {
            // Ocurrió un error al procesar la solicitud
            console.log(error);
            $('#error').removeClass('d-none');
            setTimeout(() => {
                $('#error').addClass('d-none');
            }, 10000);
        }
      });
}

/**
 * Igual al anterior chequearValidez, pero para campos especiales (requieren validación del servidor)
 * @param {*} input 
 */
const chequearValidezEspecial = (input) => {
    // Restaura el mensaje de error en caso de que fuera cambiado
    $('#'+input.id).siblings('.invalid-feedback')[0].innerHTML = MENSAJES[input.id];

    if(input.checkValidity()){
        validarAjax(input);
    }else{
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
    }
}

/**
 * Función principal. Al llamarse, coloca todos los listeners para la validación del formulario.
 */
const validarFormulario = () => {
    const $form = document.getElementById('cargaParticipante');
    const $inputs = $form.querySelectorAll('.validar');
    const $inputsEspeciales = $form.querySelectorAll('.validarEspecial');

    // Listener para los inputs normales
    $inputs.forEach((el) => {
        el.addEventListener('input', (e) => {
            let target = e.target;
            $('#error-js').addClass('d-none');
            chequearValidez(target);
        })
    })

    // Listener para los inputs especiales
    $inputsEspeciales.forEach((el) => {
        el.addEventListener('input', (e) => {
            let target = e.target;
            $('#error-js').addClass('d-none');
            chequearValidezEspecial(target);
        })
    })

    // Listener al presionar el botón de guardar (submit)
    $form.addEventListener('submit', (event) => {
        event.preventDefault();
        // Valida otra vez
        $inputs.forEach((el) => {
            chequearValidez(el);
        })
        $inputsEspeciales.forEach((el) => {
            chequearValidezEspecial(el);
        })

        // Si es válido, enviamos por AJAX
        if($form.checkValidity()){
            // llamada ajax
            enviarFormulario($form);

        }else{
            // Caso contrario, prevenimos que se envíe y mostramos mensaje de ayuda.
            $('#error-js').removeClass('d-none');
        }
    });
}

/**
 * Envia el formulario de competidor a través de AJAX
 * @param formulario 
 */
const enviarFormulario = (formulario) => {
    const ruta = $('#cargaParticipante').attr('action');
    const redireccion = $('#postEnvio').val();

    $.ajax({
        url: ruta,
        type: "POST",
        dataType: 'json',
        data: $('#cargaParticipante').serialize(),
        beforeSend: () => {
            // Mostrar la rueda girando
            $('#botonGuardarCompetidor').children('span').removeClass('d-none');
          },
        complete: () => {
            // Ocultar la rueda girando
            $('#botonGuardarCompetidor').children('span').removeClass('d-none');
        },
        success: (response) => {
            // Si todo sale bien, redireccionamos a la tabla con un mensaje de éxito
            let mensaje = response.message;
            // encodeURIComponente convierte un string común en un string amigable para URLs
            window.location.href = redireccion+'?message='+encodeURIComponent(mensaje); 
        },
        error: function(xhr, status, error) {
            // Ocurrió un error al procesar la solicitud
            console.log(error);
            $('#error').removeClass('d-none');
            setTimeout(() => {
                $('#error').addClass('d-none');
            }, 10000);
        }
    });
}

// No quitar - Sin esto no funciona nada
validarFormulario();

/* ########################################################## PASOS DEL FORMULARIO ############################################################ */
function showTab(tabId, valorProgreso) {
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
    if (valorProgreso == 0) {
        $("#botonForm2")
            .removeClass('btn-primary')
            .addClass('btn-secondary');
    } else if (valorProgreso == 100) {
        $("#botonForm2")
            .removeClass('btn-secondary')
            .addClass('btn-primary');
    }
}