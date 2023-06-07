var interval = setInterval(function () {
    var idCompetencia = $("#competencia_puntuador").val(); // Valor del idCompetencia
    var idCompetidor = $("#competencia_puntuador").val(); // Valor del idCompetidor
    var numPasada = $("#pasada_puntuador").val(); // Numero de pasada
    // Realizar la petición AJAX
    $.ajax({
        url: "http://127.0.0.1:8000/validarJueces",
        method: "POST",
        data: {
            idCompetencia: idCompetencia,
            idCompetidor: idCompetidor,
            numPasada: numPasada,
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Necesario para que funcione la petición
        },
        success: function (response) {
            console.log(response);

            // La petición fue exitosa, procesar la respuesta
            if (response.puntuacionCompleta) {
                // El resultado es true
                /*  console.log("Validación de jueces exitosa"); */
                $(".boton").removeAttr("disabled");
                $("#badgeMensajeSuccess").removeClass("d-none");
                $("#badgeMensajeDanger").addClass("d-none");
               cargarPuntajeTotal(idCompetencia, idCompetidor, numPasada);
               clearInterval(interval);
            } else {
                // El resultado es false
                $("#badgeMensajeDanger").removeClass("d-none");
                $("#badgeMensajeSuccess").addClass("d-none");

                $("#cantJueces").text(
                    " de " + response.cantJuecesFaltantes + " jueces"
                );
                /* console.log("Validación de jueces fallida"); */
            }
        },
        error: function (xhr, status, error) {
            // Ocurrió un error en la petición

            console.error(error);
        },
    });
}, 3000); // 10 segundos (3000 milisegundos)

function cargarPuntajeTotal(idCompetencia, idCompetidor, numPasada) {
    $.ajax({
        url: "http://127.0.0.1:8000/calcularPuntajePasada",
        method: "POST",
        data: {
            idCompetencia: idCompetencia,
            idCompetidor: idCompetidor,
            numPasada: numPasada,
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Necesario para que funcione la petición
        },
        success: function (response) {
            // La petición fue exitosa, procesar la respuesta
            console.log(response);

            $('.esperando').addClass('d-none');
            $('.resultadoTotal').removeClass('d-none');

            $('#puntajeTotal').text(response.totalPasada);
            $('#puntajePresentacionTotal').text(response.totalPresentacion);
            $('#puntajeExactitudTotal').text(response.totalExactitud);
        },
        error: function (xhr, status, error) {
            // Ocurrió un error en la petición

            console.error(error);
        },
    });
}
