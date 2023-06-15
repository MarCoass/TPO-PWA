var id_competencia = document.getElementById('id_competencia').value;
var id_categoria = document.getElementById('id_categoria');
var btn = document.getElementById('siguientePuntuacion_'+id_competencia);

setInterval(actualizarBotones, 1000);


function actualizarBotones(){
    $.ajax({
        url: '/actualizar_reloj',
        type: 'GET',
        dataType: 'json',
        data: {
            _token: '{{ csrf_token() }}',
            id_competencia: id_competencia,
            id_categoria:  id_categoria.value,
        },
        success: function(response) {
            
            if (response.estado==0) {
                console.log(response)
                btn.classList.remove('disabled');
           }else{
            btn.classList.add('disabled');
           }
        },
    });
}