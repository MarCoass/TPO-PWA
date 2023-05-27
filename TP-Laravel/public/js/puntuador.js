const PUNTAJE = $('.puntaje');
PUNTAJE.text(10);

$( ".pulsadorIzq" ).on( "click", function() {
    let puntaje = parseFloat(PUNTAJE.text())  - 0.3;
    PUNTAJE.text(puntaje.toFixed(1));
    //console.log(puntaje)
  } );

$( ".pulsadorDer" ).on( "click", function() {
    let puntaje = parseFloat(PUNTAJE.text())  - 1.0;
    PUNTAJE.text(puntaje.toFixed(1));
    //console.log('descontando 1.0')
  } );

$(".modalPuntuacion").on("click",function(){
    $('.competidorModal').text('aqui va el nombre del competidor')
    $('.poomseModal').text('aqui va el poomse evaluado')
    $('.puntajeModal').text($('.puntaje').text())
    $('#modal').show();
})