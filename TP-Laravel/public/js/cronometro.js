
var intervalo;
var overtime = 0;
var tiempo = 90;
var transcurrido = 0;
var id_competencia = $('#id_competencia').val();
const $btnFin = document.getElementById('fin-contador_'+id_competencia);
const $btnInicia = document.getElementById('inicio-contador_'+id_competencia);
const $contador = document.getElementById('contador_'+id_competencia);
const $tiempoTotal = document.getElementById('tiempo-total_'+id_competencia);
  

function actualizarCronometro() {
  $btnFin.classList.remove('disabled');
  $btnInicia.classList.add('disabled');
  
  if(tiempo > 0){
    // Resto uno al tiempo y lo muestro
    tiempo--;
    $contador.innerHTML = tiempo+ " seg.";
  }else{
    // Si no, entró en overtime. Sumo uno a overtime y lo muestro.
    // Cambio color del timer a rojo
    overtime++;
    $contador.classList.add('text-danger');
    $contador.innerHTML = overtime+ " seg. OVERTIME";
  }
  transcurrido++;

}

 function iniciarCronometro() {
  $tiempoTotal.innerHTML = "";
  $tiempoTotal.classList.remove('text-danger');
  transcurrido = 0;
  overtime = 0;
  intervalo = setInterval(actualizarCronometro, 1000);
}

 function detenerCronometro() {
  clearInterval(intervalo);
  tiempo = 90;
  $('#overtime_'+id_competencia).val(overtime);
  $btnFin.classList.add('disabled');
  $btnInicia.classList.remove('disabled');

  $contador.classList.remove('text-danger');
  $contador.innerHTML = tiempo+ " seg.";
  $tiempoTotal.innerHTML = "";
  $tiempoTotal.classList.remove('text-danger');

  $tiempoTotal.innerHTML = "Tiempo total: " + transcurrido + " seg.";
  // Si hay overtime, lo muestro en rojo
  if(overtime > 0){
    $tiempoTotal.classList.add('text-danger');
  }

}
