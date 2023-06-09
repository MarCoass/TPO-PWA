window.addEventListener("load", () => {
    utilizarDatos("infantilesA"); // POR DEFECTO MOSTRAMOS LA PRIMER CATEGORIA, INFANTILES A
  });
  
  /* Recibe por parámetro el nombre del JSON al que debe consumir, retorna un objeto que más adelante será nombrado como "categoría"*/
  async function cargarCategorias(tipo) {
    try {
      const response = await fetch("../json/" + tipo + ".json");
      const data = await response.json();
      return data;
    } catch (error) {
      console.error(error);
    }
  }
  
  /* Se encarga de indicar cuál categoría se debe mostrar (parámetro) y arma el resto de la estructura*/
  async function utilizarDatos(tipo) {
    const categoria = await cargarCategorias(tipo);
    //console.table(categoria);
  
    armarDescripcion(categoria.nombre, categoria.descripcion);
  
    armarListaPosiciones(categoria.posiciones);
  
    armarTablaParticipantes(categoria.femenino, "Femenino");
    armarTablaParticipantes(categoria.masculino, "Masculino");
  
    armarCardGanador(categoria.ganadorFem[0], "Ganadora", "Femenino");
    armarCardGanador(categoria.ganadorMasc[0], "Ganador", "Masculino");
  
    armarImagenes(categoria.imagenFem, categoria.imagenMasc);
  }
  
  /* Muestra el nombre de la categoría y su respectiva descripción */
  function armarDescripcion(nombreCategoria, descripcionCategoria) {
    $("#nombreCategoria").empty();
    $("#descripcionCategoria").empty();
  
    $("#nombreCategoria").html(nombreCategoria).hide().fadeIn(750);
    $("#descripcionCategoria").html(descripcionCategoria).hide().fadeIn(750);
  }
  
  /* Llena de contenido el accordion con una lista de posiciones "más usadas" en la competencia */
  function armarListaPosiciones(arreglo) {
    $("#listaPosiciones").empty();
  
    let contenidoLista = "";
  
    contenidoLista +=
      "<div class='row mb-2 align-items-center'><span class='col-5'>Posición</span><span class='col-5'>Veces Usadas</span><span class='col-2'>Puntaje Mayor</span></div>";
  
    arreglo.forEach((posicion) => {
      contenidoLista += "<div class='row mb-2 align-items-center'>";
      contenidoLista +=
        "<span class='col-6 fw-bold'>" + posicion.posicion + "</span>";
      contenidoLista +=
        "<span class='col-4 text-warning fw-semibold'>" +
        posicion.cantidad +
        "</span>";
      contenidoLista +=
        "<span class='col-2 text-success fw-semibold'>" +
        posicion.puntajeMaximo +
        "</span>";
      contenidoLista += "</div>";
    });
  
    $("#listaPosiciones").append(contenidoLista).hide().fadeIn(750);
  }
  
  /* Recibe por parámetro el arreglo de participantes y una palabra clave que diferencia el id de las tablas para saber a cuál insertar el contenido, previamente
  vacia la tabla correspondiente para que no se acumule la información */
  function armarTablaParticipantes(arreglo, id) {
    $("#tabla" + id).empty(); //VACIAMOS LA TABLA
  
    arreglo.sort((a, b) => b.puntaje - a.puntaje); // ORDENO LOS PARTICIPANES POR PUNTAJE, MALDITO CHATGPT NO ENTENDIÓ UN CARAJO CUANDO LE PEDI QUE LOS ORDENARA
  
    let contenidoTabla = "";
  
    arreglo.forEach((participante) => {
      contenidoTabla += "<tr>";
      contenidoTabla +=
        "<th scope='row' class='d-none d-sm-table-cell'>" +
        participante.posicion +
        "</th>";
      contenidoTabla +=
        "<th class='d-none d-sm-table-cell'>" + participante.lugar + "</th>";
      contenidoTabla += "<td>" + participante.nombre + "</td>";
      contenidoTabla += "<th>" + participante.puntaje + "</th>";
      //contenidoTabla += "<th class='position-relative'><span class='position-absolute top-50 ms-2 translate-middle badge bg-success'>" + participante.orden + "º Lugar</span></th>";
      contenidoTabla += "</tr>";
    });
  
    $("#tabla" + id)
      .append(contenidoTabla)
      .hide()
      .fadeIn(750); // ANIDAMOS LOS PARTICIPANTES A LA TABLA
  }
  
  /* Recibe por parámetro el objeto del ganador, el sexo es una palabra que puede ser "Ganador" o "Ganadora", y el id es para saber en que div insertar el card */
  function armarCardGanador(ganador, sexo, id) {
    //console.log(ganador);
      $("#cardGanador"+id).empty();
    card =
      "";
    card +=
      "<img class='shadow rounded-circle img-thumbnail position-absolute top-0 start-50 translate-middle' src='./images/ganadores/" +
      ganador.imagen +
      "' height='150' width='150'>";
    card += "<div class='mt-5 text-center'>";
    card +=
      "<p class='fw-semibold mt-4'>" +
      sexo +
      " del Torneo Poomsae Taewkwondo 2023</p>";
    card +=
      "<p class='fw-normal text-decoration-underline'>" + ganador.nombre + "</p>";
    card += "<p class='fst-italic mx-2'>" + ganador.frase + "</p>";
    card += "</div>";
  
    $("#cardGanador"+id).append(card).hide().fadeIn(750);
  }
  
  /* Recibe por parámetro el nombre de los archivos de cada categoría, en este caso no hace falta "vaciar" el src porque directamente reemplaza el valor*/
  function armarImagenes(imagenF, imagenM) {
    url = "./images/img/";
  
    $("#imagenFem")
      .attr("src", url + imagenF)
      .hide()
      .fadeIn(750);
    $("#imagenMasc")
      .attr("src", url + imagenM)
      .hide()
      .fadeIn(750);
  }
  