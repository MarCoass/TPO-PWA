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

