var intervalo;
var overtime = 0;
var tiempo = 90;
var transcurrido = 0;
var id_competencia = $("#id_competencia").val();
var id_categoria = $("#id_categoria").val();
var cantJueces = $("#cantJueces").val();
var idReloj = $("#idReloj").val();
const $btnFin = document.getElementById("fin-contador_" + id_competencia);
const $btnInicia = document.getElementById("inicio-contador_" + id_competencia);
const $contador = document.getElementById("contador_" + id_competencia);
const $tiempoTotal = document.getElementById("tiempo-total_" + id_competencia);
const $btnJuez = document.getElementById(
    "siguientePuntuacion_" + id_competencia
);

function actualizarCronometro() {
    $btnFin.classList.remove("disabled");
    $btnInicia.classList.add("disabled");

    if (tiempo > 0) {
        // Resto uno al tiempo y lo muestro
        tiempo--;
        $contador.innerHTML = tiempo + " seg.";
    } else {
        // Si no, entró en overtime. Sumo uno a overtime y lo muestro.
        // Cambio color del timer a rojo
        overtime++;
        $contador.classList.add("text-danger");
        $contador.innerHTML = overtime + " seg. OVERTIME";
    }
    transcurrido++;
}

function iniciarCronometro() {
    $.ajax({
        url: "/start",
        type: "GET",
        dataType: "json",
        data: {
            _token: "{{ csrf_token() }}",
            idReloj
        },
        success: function (response) {
            if (response.success) {
                $tiempoTotal.innerHTML = "";
                $tiempoTotal.classList.remove("text-danger");
                transcurrido = 0;
                overtime = 0;
                intervalo = setInterval(actualizarCronometro, 1000);
            }
        },
    });
}

function detenerCronometro() {
    $("#overtime_" + id_competencia).val(overtime);

    clearInterval(intervalo);
    tiempo = 90;

    $.ajax({
        url: "/stop",
        type: "GET",
        dataType: "json",
        data: {
            _token: "{{ csrf_token() }}",
            overtime: $("#overtime_" + id_competencia).val(),
            id_competencia: $("#id_competencia").val(),
            id_categoria: $("#id_categoria").val(),
        },
        success: function (response) {
            if (response.success) {
                // La función start() se ha iniciado correctamente
                $btnFin.classList.add("disabled");
                $btnInicia.classList.remove("disabled");
                $contador.classList.remove("text-danger");
                $contador.innerHTML = tiempo + " seg.";
                $tiempoTotal.innerHTML = "";
                $tiempoTotal.classList.remove("text-danger");

                $tiempoTotal.innerHTML =
                    "Tiempo total: " + transcurrido + " seg.";
                // Si hay overtime, lo muestro en rojo
                if (overtime > 0) {
                    $tiempoTotal.classList.add("text-danger");
                }
            }
        },
    });
}

const intervalInformacion = setInterval(actualizarInformacion, 1000);
function actualizarInformacion() {
    $.ajax({
        url: "/actualizar_informacion",
        type: "GET",
        dataType: "json",
        data: {
            _token: "{{csrf_token()}}",
            id_competencia: id_competencia,
            id_categoria: id_categoria,
        },
        success: function (response) {
            //console.log(response)
            let puntajesPrimeraPasada = response["primeraPasada"];
            let puntajesSegundaPasada = response["segundaPasada"];
            let competidor = response["competidor"];
            let jueces = response["jueces"];

            $("#nombreCompetidor").text(competidor);

            
            for (let i = 0; i < cantJueces; i++) {
                let nombreJuez = $("#nombreJuez" + i);
                nombreJuez.text(jueces[i]);
                if (puntajesPrimeraPasada[i]) {
                    $("#exactitudPrimeraPasadaJuez" + i).text(
                        puntajesPrimeraPasada[i]["puntajeExactitud"]
                    );

                    $("#presentacionPrimeraPasadaJuez" + i).text(
                        puntajesPrimeraPasada[i]["puntajePresentacion"]
                    );
                } else {
                    $("#exactitudPrimeraPasadaJuez" + i).text("...");

                    $("#presentacionPrimeraPasadaJuez" + i).text("...");
                }

                if (puntajesSegundaPasada[i]) {
                    $("#exactitudSegundaPasadaJuez" + i).text(
                        puntajesSegundaPasada[i]["puntajeExactitud"]
                    );
                    $("#presentacionSegundaPasadaJuez" + i).text(
                        puntajesSegundaPasada[i]["puntajePresentacion"]
                    );
                } else {
                    $("#exactitudSegundaPasadaJuez" + i).text("...");

                    $("#presentacionSegundaPasadaJuez" + i).text("...");
                }
            }
            if(response['categoriaTerminada']){

                $('#modalCategoriaTerminada').modal('show');
            }
        },
    });
}
