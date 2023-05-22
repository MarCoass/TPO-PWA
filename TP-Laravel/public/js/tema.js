/**
 * Cambia de tema
 * @param {string} tema light o dark
 */
export const cambio_de_tema = (tema) => {
    let $tabla = document.querySelector('#competidores_tabla');
    let $tablas = document.querySelectorAll('.table');
    let $acordeones = document.querySelectorAll('.accordion-item');

    if(tema === "dark"){

      if($tabla){
        $tabla.classList['value'] = 'table hover table-dark table-bordered nowrap border dataTable dtr-inline collapsed';
      }

      if($tablas){
        $tablas.forEach((el) => {
          el.classList.remove('table-light');
          el.classList.add('table-dark');
        })
      }
      if($acordeones){
        $acordeones.forEach((el) => {
          el.classList.remove('bg-light', 'text-dark');
          el.classList.add('bg-dark','text-light');
        })
      }
      
      document.body.classList.add('text-bg-dark');
      document.body.classList.remove('text-bg-light');
      document.querySelectorAll('.card').forEach((el) => {
        el.classList.add('bg-dark');
      })

      let negro = document.getElementById("cambiarVista_negro");
      negro.style.display = "none";

      let blanco = document.getElementById("cambiarVista_blanco");
      blanco.style.display = "block";

      localStorage.setItem("background", "dark");
    }else{
      document.body.classList.remove('text-bg-dark');
      document.body.classList.add('text-bg-light');
      document.querySelectorAll('.card').forEach((el) => {
        el.classList.remove('bg-dark');
      })
      if($tabla){
        $tabla.classList['value'] = 'table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed';
      }
      if($tablas){
        $tablas.forEach((el) => {
          el.classList.add('table-light');
          el.classList.remove('table-dark');
        })
      }
      if($acordeones){
        $acordeones.forEach((el) => {
          el.classList.remove('bg-dark','text-light');
          el.classList.add('bg-light','text-dark');
        })
      }
      let negro = document.getElementById("cambiarVista_negro");
      negro.style.display = "block";

      let blanco = document.getElementById("cambiarVista_blanco");
      blanco.style.display = "none";

      localStorage.setItem("background", "light");
    }
}