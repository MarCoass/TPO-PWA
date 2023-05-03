function filtrarTabla() {
  let filtro = document.getElementById("filtroTabla");
  let columna = filtro.value;
  let busqueda = document.getElementById("buscar").value.toLowerCase();
  let tabla = document.getElementById("tabla");
  let filas = tabla.getElementsByTagName("tr");

  for (let i = 1; i < filas.length; i++) {
    let celda = filas[i].getElementsByTagName("td")[columna];
    let texto = '';
    if (celda) {
    texto = celda.textContent.toLowerCase();
      filas[i].style.display = texto.includes(busqueda) ? "" : "none";

      if (texto == "") {
        //si es un pais
        let textoSpan =
          celda.getElementsByClassName("tituloPais")[0].textContent;
        console.log(textoSpan);
        texto = textoSpan.toLowerCase();
        filas[i].style.display = texto.includes(busqueda) ? "" : "none";
      }
    }
  }

  filtro.addEventListener("change", function () {
    document.getElementById("buscar").value = "";
  });
}
