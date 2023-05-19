import { boton_contador_inicio, boton_contador_fin } from './cronometro.js';
import { cambio_de_tema } from './tema.js';
//import { competidores_tabla } from './tablaCompetidores.js';
import './eventosMenu.js';

//Cronometro
boton_contador_inicio;
boton_contador_fin;

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
