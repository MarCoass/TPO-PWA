var intervalo;
var overtime = 0;
var tiempo = 90;
var transcurrido = 0;
var idReloj = $("#idReloj").val();
const btnFin = document.getElementById("fin-contador_" + idReloj);
const btnInicia = document.getElementById("inicio-contador_" + idReloj);
const contador = document.getElementById("contador_" + idReloj);
const tiempoTotal = document.getElementById("tiempo-total_" + idReloj);
const controlBtn = $("#controlBotonesCronometro");

var botonAnterior = $('#botonAnterior');
var botonActual = $('#botonActual');
var botonSiguiente = $('#botonSiguiente');


function actualizarCronometro() {
    btnFin.classList.remove("disabled");
    btnInicia.classList.add("disabled");

    if (tiempo > 0) {
        // Resto uno al tiempo y lo muestro
        tiempo--;
        contador.innerHTML = tiempo + " seg.";
    } else {
        // Si no, entró en overtime. Sumo uno a overtime y lo muestro.
        // Cambio color del timer a rojo
        overtime++;
        contador.classList.add("text-danger");
        contador.innerHTML = overtime + " seg. OVERTIME";
    }
    transcurrido++;
}

// Funcion que pertenece a la etapa 2 y 6 que da inicio de las etapas 3 y 7
function siguienteEstado() {
    var resp = false;
    $.ajax({
        url: "/siguiente_estado",
        type: "POST",
        dataType: "json",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            idReloj
        },
        success: function (response) {
            resp = true;
            if(response['finPuntuacion']){

                $('#modalCategoriaTerminada').modal('show');
            }
        },
    });
    return resp;
}


// Funcion que pertenece a la etapa 2 y 6 que da inicio de las etapas 3 y 7
function iniciarCronometro() {
    $.ajax({
        url: "/start",
        type: "GET",
        dataType: "json",
        data: {
            idReloj
        },
        success: function (response) {
            if (response.success) {
                tiempoTotal.innerHTML = "";
                tiempoTotal.classList.remove("text-danger");
                transcurrido = 0;
                overtime = 0;
                intervalo = setInterval(actualizarCronometro, 1000);
            }
        },
    });
}

// Funcion que pertenece a la etapa 3 y 7 que da inicio de las etapas 4 y 8
function detenerCronometro() {
    $("#overtime_" + idReloj).val(overtime);

    clearInterval(intervalo);
    tiempo = 90;

    $.ajax({
        url: "/stop",
        type: "GET",
        dataType: "json",
        data: {
            overtime: $("#overtime_" + idReloj).val(),
            idReloj
        },
        success: function (response) {
            if (response.success) {
                // La función start() se ha iniciado correctamente
                btnFin.classList.add("disabled");
                btnInicia.classList.remove("disabled");
                contador.classList.remove("text-danger");
                contador.innerHTML = tiempo + " seg.";
                tiempoTotal.innerHTML = "";
                tiempoTotal.classList.remove("text-danger");

                tiempoTotal.innerHTML =
                    "Tiempo total: " + transcurrido + " seg.";
                // Si hay overtime, lo muestro en rojo
                if (overtime > 0) {
                    tiempoTotal.classList.add("text-danger");
                }
            }
        },
    });
}

function actualizarInformacion() {
    $.ajax({
        url: "/actualizar_informacion/" + idReloj,
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (response.success) {
            let puntajesPrimeraPasada = response["primeraPasada"];
            let puntajesSegundaPasada = response["segundaPasada"];
            let competidor = response["competidor"];
            let jueces = response["jueces"];

            $("#nombreCompetidor").text(competidor);

            if (response.estados[1] != botonActual.find('span').text()){
                botonAnterior.find("span").animate( {opacity: 0}, function() {
                    $(this).text(response.estados[0]).animate( {opacity: 1} );
                  });
                botonActual.find("span").animate( {opacity: 0}, function() {
                    $(this).text(response.estados[1]).animate( {opacity: 1} );
                  });
                botonSiguiente.find("span").animate( {opacity: 0}, function() {
                    $(this).text(response.estados[2]).animate( {opacity: 1} );
                  });

            }
            if(response.habBoton){
                //console.log("activo")
                botonSiguiente.removeClass('disabled');
                botonSiguiente.off('click');
                botonSiguiente.on('click',function(){
                    if(siguienteEstado()){
                        alert("hola")
                        botonSiguiente.addClass('disabled');
                        actualizarInformacion();
                    }
                })
            }else{
                botonSiguiente.addClass('disabled');
            }
            var valores = [2,3,6,7];
            if( valores.includes(response.estadoReloj) ){
                console.log(valores + " " + response.estadoReloj)
                controlBtn.css('opacity', 1);
                if(response.estadoReloj == 2 || response.estadoReloj == 6){
                    btnInicia.classList.remove("disabled");
                }
            }else{
                controlBtn.css('opacity', 0);
                if(!btnInicia.classList.contains("disabled")){
                    btnInicia.classList.add("disabled");
                }
            }

            if(response.estadoReloj == 10){
                $('#modalCategoriaTerminada').modal('show');
            }
                
            // Actualiza estado de jueces
            for (let i = 0; i < response["cantJueces"]; i++) {
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
        }
        },
    });
}

const intervalInformacion = setInterval(actualizarInformacion, 5000);
