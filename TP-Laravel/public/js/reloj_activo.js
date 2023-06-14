const $btn = document.getElementById('siguientePuntuacion_'+id_competencia);

setInterval(actualizarBotones, 1000);


function actualizarBotones(){
    $.ajax({
        url: '/actualizar_reloj',
        type: 'GET',
        dataType: 'json',
        data: {
            _token: '{{ csrf_token() }}',
            id_competencia: $('#id_competencia').val(),
            id_categoria:  $('#id_categoria').val()
        },
        success: function(response) {
            if (response.estado) {
                $btn.classList.remove('disabled');
           }else{
            $btn.classList.add('disabled');
           }
        },
    });
}
