var btn = document.getElementById('siguientePuntuacion_');
var pasada = "";
var nPasada = "";
const PUNTAJE = $("#puntajeId");
const estados = $("#estados");
const idCompCompe = document.getElementById('idCompCompeti').value
const idCompJuez = document.getElementById('idCompJuez').value
const id_reloj = document.getElementById('id_reloj').value;
const pMenos3 = $(".pulsadorIzq");
const pMenos1 = $(".pulsadorDer");

//Busca si existe exactitud y presentacion, si esta vacio los setea 
if (localStorage.getItem("exactitud") == null) {
    localStorage.setItem("exactitud", "4")
    localStorage.setItem("presentacion", "6")
}

function actualizarBotones(){
    $.ajax({
        url: '/actualizar_reloj',
        type: 'GET',
        dataType: 'json',
        data: {
            //_token: '{{ csrf_token() }}',
            id_reloj:  id_reloj,
        },
        success: function(response) {
            if (response.estado >= 6) { pasada = "segunda"; setNumPasada("2")} else { pasada = "primera"; setNumPasada("1")}

            if (response.estado == 1) { 
                estados.text("esperando jueces") 
            }

            if (response.estado == 2 || response.estado == 6) {

                pMenos3.removeClass("bg-danger"); pMenos1.removeClass("bg-primary");
                pMenos3.addClass("bg-secondary"); pMenos1.addClass("bg-secondary"); 

                $('#poomsaePasadaActual').text(document.getElementById("idPoomsae"+nPasada).value)

                PUNTAJE.text("");
                estados.text("esta por comenzar la " + pasada + " pasada")
                /* Aca reseteo los puntajes */
                $("#etapaPuntuacion").text("Exactitud")
                $("#etapaPasada").text(nPasada)
                
                localStorage.setItem("exactitud", "4") ; localStorage.setItem("presentacion", "6")
                
                $("#terminarPuntuacion").addClass('d-none')
                
                
            }
            
            //desactivo y activo los botones para no generar acumulacion
            if (response.estado == 3 || response.estado == 7) {
                
                pMenos3.removeClass("bg-secondary"); pMenos1.removeClass("bg-secondary");
                pMenos3.addClass("bg-danger"); pMenos1.addClass("bg-primary");

                PUNTAJE.text(localStorage.getItem("exactitud"))
                estados.text( pasada + " pasada")
                $("#etapaPasada").text(nPasada)

                pMenos3.off("click").on("click", function () {
                    let puntaje = parseFloat(PUNTAJE.text()) - 0.3;
                    if (puntaje > 0) {
                        PUNTAJE.text(puntaje.toFixed(1));
                        localStorage.setItem("exactitud", puntaje.toFixed(1))
                    }
                });
                
                pMenos1.off("click").on("click", function () {
                    let puntaje = parseFloat(PUNTAJE.text()) - 0.1;
                    if (puntaje > 0) {
                        PUNTAJE.text(puntaje.toFixed(1));
                        localStorage.setItem("exactitud", puntaje.toFixed(1))
                    }
                });
            }
            
            if (response.estado == 4 || response.estado == 8) {

                pMenos3.removeClass("bg-danger"); pMenos1.removeClass("bg-primary");
                pMenos3.addClass("bg-secondary"); pMenos1.addClass("bg-secondary");
                
                estados.text("termina " + pasada + " pasada")
                $("#etapaPasada").text(nPasada)
                pMenos1.off("click") ; pMenos3.off("click")
                $("#terminarPuntuacion").prop('disabled', false)

            }

            if (response.estado == 5 || response.estado == 9){

                pMenos3.removeClass("bg-secondary"); pMenos1.removeClass("bg-secondary");
                pMenos3.addClass("bg-danger"); pMenos1.addClass("bg-primary");

                estados.text("entregan presentacion " + pasada + " pasada")
                $("#etapaPasada").text(nPasada)
                
                $("#etapaPuntuacion").text("Presentacion")
                PUNTAJE.text(localStorage.getItem("presentacion"))

                pMenos3.off("click").on("click", function () {
                    let puntaje = parseFloat(PUNTAJE.text()) - 0.3;
                    if (puntaje > 0) {
                        PUNTAJE.text(puntaje.toFixed(1));
                        localStorage.setItem("presentacion", puntaje.toFixed(1))
                    }
                });
                
                pMenos1.off("click").on("click", function () {
                    let puntaje = parseFloat(PUNTAJE.text()) - 0.1;
                    if (puntaje > 0) {
                        PUNTAJE.text(puntaje.toFixed(1));
                        localStorage.setItem("presentacion", puntaje.toFixed(1))
                    }
                });

                $('.puntajeExactitudModal').text(localStorage.getItem("exactitud"))
                $('.puntajePresentacionModal').text(localStorage.getItem("presentacion"))

                //$('#enviarPasada').prop('disabled', false);
                $("#terminarPuntuacion").removeClass('d-none');
            }
            
            if(response.estado == 10){
                console.log("todo tiene un final")
                $('#modalCategoriaTerminada').modal('show');
            }
            //console.log(localStorage.getItem("exactitud") + " "+ localStorage.getItem("presentacion"))
        },
    });
}

function setNumPasada(nPas){ nPasada = nPas;}

$('#enviarPasada').on('click', function(){
    subirPuntaje(
        idCompCompe,
        idCompJuez,
        nPasada,
        id_reloj,
        localStorage.getItem("exactitud"),
        localStorage.getItem("presentacion")
    );

});

function subirPuntaje(idCompCompe,idCompJuez,pasada,idReloj,exactitud,presentacion){
    $.ajax({
        url: '/actualizarPuntaje',
        type: 'PATCH',
        dataType: 'json',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),idCompCompe: idCompCompe,idCompJuez: idCompJuez,pasada: pasada,idReloj: idReloj,exactitud: exactitud,presentacion: presentacion,
        },
    success: function(response) {
        console.log(response)
        //$('#respuestaSvr').text("Se envio pasada n° " + data.pasada + " - exactitud: " + data.exactitud + " - presentacion: " + data.presentacion + " - juez: " + data.idCompJuez + " " + response.puntaje)
        $('#modal').modal('hide');
        $("#terminarPuntuacion").prop('disabled', true)
        //$('#enviarPasada').prop('disabled', true);
    },
    error: function(jqXHR, textStatus, errorThrown) {
        $('#respuestaSvr').text("Ocurrió un error al enviar la pasada. Intente denuevo")
    }
    });
}

setInterval(actualizarBotones, 5000);