/* const PUNTAJE = $(".puntaje"); */

var id_competencia = document.getElementById('id_competencia').value;
var btn = document.getElementById('siguientePuntuacion_'+id_competencia);


/* $(".pulsadorIzq").on("click", function () {
    let puntaje = parseFloat(PUNTAJE.text()) - 0.3;
    if (puntaje > 0) {
        PUNTAJE.text(puntaje.toFixed(1));
    }

    //console.log(puntaje)
});

$(".pulsadorDer").on("click", function () {
    let puntaje = parseFloat(PUNTAJE.text()) - 0.1;
    if (puntaje > 0) {
        PUNTAJE.text(puntaje.toFixed(1));
    }

    //console.log('descontando 1.0')
}); */

$("#terminarPuntuacion").on("click", function () {
    //Asigna el puntaje obtenido a la precision
    $(".puntajePresentacionModal").text($(".puntaje").text());
    $("#puntajePresentacionInput").val($(".puntaje").text());

    $("#modal").show();
});

$(btn).one("click", function () {
    //al hacer click en siguiente cambia de exactitud a presentacion
    $("#etapaPuntuacion").text("Presentacion");

    //cambia los botones
    $("#terminarPuntuacion").toggleClass("d-none");
    $(btn).toggleClass("d-none");

    //Asigna el puntaje obtenido a la exactitud
    $(".puntajeExactitudModal").text($(".puntaje").text());
    $("#puntajeExactitudInput").val($(".puntaje").text());

    //define el puntaje inicial de presentacion en 6
    PUNTAJE.text(6);
});
