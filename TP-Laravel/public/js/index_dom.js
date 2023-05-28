import { boton_contador_inicio, boton_contador_fin } from './cronometro.js';
import { cambio_de_tema } from './tema.js';
import { competidores_tabla } from './tablaCompetidores.js';
import {tabla_usuarios} from './tablaUsuarios.js';
import './eventosMenu.js';
import {tabla_CompetenciaCompetidores} from './tablaCompetenciaCompetidores.js';


//Cronometro
boton_contador_inicio;
boton_contador_fin;

//Gestion de usuarios tabla
tabla_usuarios;

//tabla de competidores
competidores_tabla;

//tabla competidores de la competencia
tabla_CompetenciaCompetidores;

/*
Si o si poner http://127.0.0.1:800/ruta sino no anda, os advierte su querido Braian <3
  $.ajax({
  url: 'http://127.0.0.1:8000/paises', // URL del archivo o ruta que manejará la solicitud en el servidor
  method: 'GET', // Método HTTP utilizado para la solicitud
  success: function (response) {
    console.log(response)
  },
});*/

//Temas
if (localStorage.getItem('background') == null) {
  cambio_de_tema("dark");
} else {
  cambio_de_tema(localStorage.getItem('background'));
}

document.getElementById("cambiarVista_negro").addEventListener("click", () => {
  cambio_de_tema("dark")
});
document.getElementById("cambiarVista_blanco").addEventListener("click", () => {
  cambio_de_tema("light")
});

$('#graduacion_puntuador').on('click', function() {
  $.ajax({
    type:"GET",
    url: '/opciones_competidor',
    data: { graduacion_puntuador: $('#graduacion_puntuador').val(),
    competencia_puntuador: $('#competencia_puntuador').val()},
    dataType: 'json',
    success: function(data) {
        $('#competidor_puntuador').empty();
        $('#competidor_puntuador').append('<option value="" disabled selected data-error="Por favor seleccione una graduacion válida">Selecciona un competidor.</option>');
        $.each(data, function(key, value) {// 'idCompetidor', 'apellido','nombre'
            
          $('#competidor_puntuador').append('<option value="'+value.idCompetidor+'">'+value.apellido+' '+value.nombre+'</option>');
        });
    }
});
});