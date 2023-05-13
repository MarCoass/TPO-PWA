import { boton_contador_inicio, boton_contador_fin } from './cronometro.js';
import { cambio_de_tema } from './tema.js';

//Cronometro
boton_contador_inicio;
boton_contador_fin;

//Temas
if(localStorage.getItem('background') == null){
    cambio_de_tema("dark");
  }else{
    cambio_de_tema(localStorage.getItem('background'));
  }
  
  document.getElementById("cambiarVista_negro").addEventListener("click", () => {
    cambio_de_tema("dark")
  });
  document.getElementById("cambiarVista_blanco").addEventListener("click", () => {
    cambio_de_tema("light")
  });
