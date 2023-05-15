/**
 * Cambia de tema
 * @param {string} tema light o dark
 */
export const cambio_de_tema = (tema) => {
       
    if(tema === "dark"){

      //document.body.style.backgroundColor = "var(--bs-dark)";

      document.body.classList.add('text-bg-dark')
      document.body.classList.remove('text-bg-light')

      let negro = document.getElementById("cambiarVista_negro");
      negro.style.display = "none";

      let blanco = document.getElementById("cambiarVista_blanco");
      blanco.style.display = "block";

      localStorage.setItem("background", "dark");
    }else{
      //document.body.style.backgroundColor = "#FFFFFF";
      document.body.classList.remove('text-bg-dark')
      document.body.classList.add('text-bg-light')

      let negro = document.getElementById("cambiarVista_negro");
      negro.style.display = "block";

      let blanco = document.getElementById("cambiarVista_blanco");
      blanco.style.display = "none";

      localStorage.setItem("background", "light");
    }
}