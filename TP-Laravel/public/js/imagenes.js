function obtenerNumeroAleatorio(min, max) {
    // Función para obtener un número aleatorio entre min y max
    return Math.floor(Math.random() * (max - min + 1) + min);
}

function obtenerObjetoJson(numero) {
    let objetoJson;
    $.ajax({
        url: 'https://jsonplaceholder.typicode.com/photos?_start='+ numero +'&_limit=5',
        type: 'GET',
        dataType: 'json',
        async: false,
        success: function (data) {
            objetoJson = data;
        },
        error: function () {
            console.error("Error en la llamada AJAX");
        }
    });

    return objetoJson;
}

function obtenerDatos(id){
    let objetoJson;
    $.ajax({
        url: 'https://jsonplaceholder.typicode.com/photos/'+id,
        type: 'GET',
        dataType: 'json',
        async: false,
        success: function (data) {
            objetoJson = data;
        },
        error: function () {
            console.error("Error en la llamada AJAX");
        }
    });

    return objetoJson;
}

function generarPalabraRandom(str) {
    // Eliminar espacios en blanco y convertir a minúsculas
    str = str.replace(/\s+/g, '').toLowerCase();

    // Obtener la longitud del string
    let len = str.length;

    // Generar un índice aleatorio entre 0 y la longitud del string - 10
    let randomIndex = Math.floor(Math.random() * (len - 10));

    // Obtener una subcadena de entre 5 y 10 caracteres a partir del índice aleatorio
    let palabraRandom = str.substr(randomIndex, Math.floor(Math.random() * 6) + 5);

    // Retornar la palabra generada
    return palabraRandom;
}


function armarModal(id) {
    let imagenJson = obtenerDatos(id);

    let nombreRandom = generarPalabraRandom(imagenJson.title); // Retorna una palabra random generada con las letras del titulo de la imagen

    $("#nombreRandom").html(nombreRandom);
    $("#idAlbumImagen").html(imagenJson.albumId);
    $("#idImagen").html(imagenJson.id);
    $("#tituloImagen").html(imagenJson.title);

    $("#thumbUrlImagen").html(imagenJson.thumbnailUrl);
    $("#thumbUrlImagen").attr('href', imagenJson.thumbnailUrl);

    $("#urlImagen").html(imagenJson.url);
    $("#urlImagen").attr('href', imagenJson.url);
}

function armarFigures(photos) {
    let contenido = "";

    photos.forEach((el) => {
        contenido += "<div class='col-5 col-sm-4 col-md-3 col-lg-2'><figure class='figure' data-bs-toggle='modal' data-bs-target='#modalImagen'  onclick='armarModal(" + el.id + ")'>";
        contenido += "<img src='" + el.url + "' class='figure-img img-fluid rounded' alt='...'>";
        contenido += "<figcaption class='figure-caption text-end'>";
        contenido += "<a href='#' class='text-secondary'>" + el.title + "</a>";
        contenido += "</figcaption></figure></div>";
    })

    return contenido
}

// Imagenes
$(document).ready(function () {
    let estructuraImagenes = "";
    let numeroAleatorio = obtenerNumeroAleatorio(0, 4995); // Si es más de 4995, no van a llegar 5.
    let imagenesJson = obtenerObjetoJson(numeroAleatorio);
    estructuraImagenes += armarFigures(imagenesJson);
  
    $("#contenedorImagenes").html(estructuraImagenes);
  
    setTimeout(function () {
        $("#contenedorImagenesFake").addClass('d-none');
        $("#contenedorImagenes").removeClass('d-none');
    }, 3000);
  });