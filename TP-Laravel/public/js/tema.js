/**
 * Cambia de tema
 * @param {string} tema light o dark
 */
export const cambio_de_tema = (tema) => {
       
    if(tema === "dark"){

      document.body.style.backgroundColor = "#000000";

      let negro = document.getElementById("cambiarVista_negro");
      negro.style.display = "none";

      let blanco = document.getElementById("cambiarVista_blanco");
      blanco.style.display = "block";

      localStorage.setItem("background", "dark");
    }else{
      document.body.style.backgroundColor = "#FFFFFF";

      let negro = document.getElementById("cambiarVista_negro");
      negro.style.display = "block";

      let blanco = document.getElementById("cambiarVista_blanco");
      blanco.style.display = "none";

      localStorage.setItem("background", "light");
    }
}