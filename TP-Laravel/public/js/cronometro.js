// Cuando se hace click al botón de inicio
function iniciar_cronometro(id_competencia){
  const $contador = document.getElementById('contador_'+id_competencia);
  const $btnInicia = document.getElementById('inicio-contador_'+id_competencia);
  const $btnFin = document.getElementById('fin-contador_'+id_competencia);
  const $tiempoTotal = document.getElementById('tiempo-total_'+id_competencia);
  let estaActivo = false;
  // Contadores
  let tiempo = 90;
  let transcurrido = 0;
  let overtime = 0;

  // Reinicio de los estilos del contador
  $contador.classList.remove('text-danger');
  $contador.innerHTML = tiempo+ " seg.";
  $tiempoTotal.innerHTML = "";
  $tiempoTotal.classList.remove('text-danger');

  // Botón de inicio desactivado, botón de fin activado
  $btnFin.classList.remove('disabled');
  $btnInicia.classList.add('disabled');
  
  // Indicación de que ahora está activo
  estaActivo = true;
  
  // Intervalo que ejecuta el timer
  const intervalo = setInterval(() => {
    // Si está activo
      if(estaActivo){
        // Sumo al contador total
        transcurrido++;
        // Si está en tiempo reglamentario
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
      }else{
        // Si no está activo (fue presionado el botón de fin)
        // Corto del intervalo y muestro tiempo total
        clearInterval(intervalo);
        $tiempoTotal.innerHTML = "Tiempo total: " + transcurrido + " seg.";
        // Si hay overtime, lo muestro en rojo
        if(overtime > 0){
          $tiempoTotal.classList.add('text-danger');
        }
      }
      $('#overtime').val(overtime);

    }, 1000);
}

function finalizar_cronometro(id_competencia){
    // Se coloca en false la variable que mantiene el intervalo
    const $btnInicia = document.getElementById('inicio-contador_'+id_competencia);
    const $btnFin = document.getElementById('fin-contador_'+id_competencia);
    estaActivo = false;
  
    // Se deshabilita el botón de fin y se activa el de inicio
    $btnFin.classList.add('disabled');
    $btnInicia.classList.remove('disabled');
}

