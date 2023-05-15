/**
 * Cambia de tema
 * @param {string} tema light o dark
 */
export const cambio_de_tema = (tema) => {
    let $tabla = document.querySelector('.table');

    if(tema === "dark"){

      if($tabla){
        $tabla.classList['value'] = 'table hover table-dark table-bordered nowrap border dataTable dtr-inline collapsed';
      }
     
      document.body.classList.add('text-bg-dark');
      document.body.classList.remove('text-bg-light');

      let negro = document.getElementById("cambiarVista_negro");
      negro.style.display = "none";

      let blanco = document.getElementById("cambiarVista_blanco");
      blanco.style.display = "block";

      localStorage.setItem("background", "dark");
    }else{
      document.body.classList.remove('text-bg-dark');
      document.body.classList.add('text-bg-light');
      if($tabla){
        $tabla.classList['value'] = 'table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed';
      }
      let negro = document.getElementById("cambiarVista_negro");
      negro.style.display = "block";

      let blanco = document.getElementById("cambiarVista_blanco");
      blanco.style.display = "none";

      localStorage.setItem("background", "light");
    }
}