window.addEventListener("load", () => {
    utilizarDatos("infantilesA"); // POR DEFECTO MOSTRAMOS LA PRIMER CATEGORIA, INFANTILES A
});

/* Recibe por parámetro el nombre del JSON al que debe consumir, retorna un objeto que más adelante será nombrado como "categoría"*/
async function cargarCategorias(tipo) {
    try {
        const response = await fetch('./Assets/json/' + tipo + '.json');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error(error);
    }
}

/* Se encarga de indicar cuál categoría se debe mostrar (parámetro) y arma el resto de la estructura*/
async function utilizarDatos(tipo) {
    const categoria = await cargarCategorias(tipo);
    console.table(categoria);

    $("#nombreCategoria").empty();
    $("#nombreCategoria").html(categoria.nombre); // INSERTAMOS NOMBRE DE LA CATEGORÍA

    armarTablaParticipantes(categoria.femenino, "Femenino");
    armarTablaParticipantes(categoria.masculino, "Masculino");

    armarParrafoGanadores(categoria.ganadorFem, categoria.ganadorMasc);

    armarImagenes(categoria.imagenFem, categoria.imagenMasc);
}

/* Recibe por parámetro el arreglo de participantes y una palabra clave que diferencia el id de las tablas para saber a cuál insertar el contenido, previamente
vacia la tabla correspondiente para que no se acumule la información */
function armarTablaParticipantes(arreglo, id) {
    $("#tabla" + id).empty(); //VACIAMOS LA TABLA

    arreglo.sort((a, b) => b.puntaje - a.puntaje); // ORDENO LOS PARTICIPANES POR PUNTAJE, MALDITO CHATGPT NO ENTENDIÓ UN CARAJO CUANDO LE PEDI QUE LOS ORDENARA

    let contenidoTabla = "";

    arreglo.forEach(participante => {
        contenidoTabla += "<tr>";
        contenidoTabla += "<th scope='row' class='d-none d-sm-table-cell'>" + participante.posicion + "</th>";
        contenidoTabla += "<th class='d-none d-sm-table-cell'>" + participante.lugar + "</th>";
        contenidoTabla += "<td>" + participante.nombre + "</td>";
        contenidoTabla += "<th>" + participante.puntaje + "</th>";
        //contenidoTabla += "<th class='position-relative'><span class='position-absolute top-50 ms-2 translate-middle badge bg-success'>" + participante.orden + "º Lugar</span></th>";
        contenidoTabla += "</tr>";
    });

    $("#tabla" + id).html(contenidoTabla); // ANIDAMOS LOS PARTICIPANTES A LA TABLA
}

/* Recibe por parámetro el texto de cada ganador, previamente vacia el contenido para que no se acumule la información*/
function armarParrafoGanadores(ganadorFemenino, ganadorMasculino) {
    $("#parrafoGanadorFem").empty();
    $("#parrafoGanadorMasc").empty();
    $("#parrafoGanadorFem").html(ganadorFemenino);
    $("#parrafoGanadorMasc").html(ganadorMasculino);
}

/* Recibe por parámetro el nombre de los archivos de cada categoría, en este caso no hace falta "vaciar" el src porque directamente reemplaza el valor*/
function armarImagenes(imagenF, imagenM) {
    url = "./Assets/Img/img/";

    $("#imagenFem").attr("src", url + imagenF);
    $("#imagenMasc").attr("src", url + imagenM);
}