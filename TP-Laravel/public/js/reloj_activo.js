var id_competencia = document.getElementById('id_competencia').value;
var id_categoria = document.getElementById('id_categoria').value;
var btn = document.getElementById('siguientePuntuacion_'+id_competencia);
const PUNTAJE = $("#puntajeId");
var yaEstuvoEnCero = false;

setInterval(actualizarBotones, 5000);


function actualizarBotones(){
    $.ajax({
        url: '/actualizar_reloj',
        type: 'GET',
        dataType: 'json',
        data: {
            _token: '{{ csrf_token() }}',
            id_competencia: id_competencia,
            id_categoria:  id_categoria,
        },
        success: function(response) {
            
            //desactivo y activo los botones para no generar acumulacion
            if (response.estado==1) {
                $(".pulsadorIzq").off("click").on("click", function () {
                    let puntaje = parseFloat(PUNTAJE.text()) - 0.3;
                    if (puntaje > 0) {
                        PUNTAJE.text(puntaje.toFixed(1));
                    }
                
                    //console.log(puntaje)
                });
                
                $(".pulsadorDer").off("click").on("click", function () {
                    let puntaje = parseFloat(PUNTAJE.text()) - 0.1;
                    if (puntaje > 0) {
                        PUNTAJE.text(puntaje.toFixed(1));
                    }
                
                    //console.log('descontando 1.0')
                });

                yaEstuvoEnCero = true;
            }
            console.log("entre" + yaEstuvoEnCero)
            
            if (response.estado==0 && yaEstuvoEnCero) {
                //console.log(response)
                btn.classList.remove('disabled');
           }else{
            btn.classList.add('disabled');
           }
        },
    });
}