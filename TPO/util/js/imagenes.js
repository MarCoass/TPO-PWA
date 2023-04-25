function obtenerNumeroAleatorio(min, max) {
    // Función para obtener un número aleatorio entre min y max
    return Math.floor(Math.random() * (max - min + 1) + min);
}

function obtenerObjetoJson(numero) {
    var objetoJson;
    $.ajax({
        url: 'https://jsonplaceholder.typicode.com/photos/' + numero,
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
    var len = str.length;

    // Generar un índice aleatorio entre 0 y la longitud del string - 10
    var randomIndex = Math.floor(Math.random() * (len - 10));

    // Obtener una subcadena de entre 5 y 10 caracteres a partir del índice aleatorio
    var palabraRandom = str.substr(randomIndex, Math.floor(Math.random() * 6) + 5);

    // Retornar la palabra generada
    return palabraRandom;
}


function armarModal(id) {
    imagenJson = obtenerObjetoJson(id);

    nombreRandom = generarPalabraRandom(imagenJson.title); // Retorna una palabra random generada con las letras del titulo de la imagen

    $("#nombreRandom").html(nombreRandom);
    $("#idAlbumImagen").html(imagenJson.albumId);
    $("#idImagen").html(imagenJson.id);
    $("#tituloImagen").html(imagenJson.title);
    $("#thumbUrlImagen").html(imagenJson.thumbnailUrl);
    $("#urlImagen").html(imagenJson.url);
}

function armarFigure(photo) {
    //console.log(photo);
    var contenido = "";
    contenido += "<div class='col-2'><figure class='figure'>";
    contenido += "<img src='" + photo.url + "' class='figure-img img-fluid rounded' alt='...'>";
    contenido += "<figcaption class='figure-caption text-end'>";
    contenido += "<a href='#' onclick='armarModal(" + photo.id + ")' class='text-decoration-none text-secondary' data-bs-toggle='modal' data-bs-target='#modalImagen'>" + photo.title + "</a>";
    contenido += "</figcaption></figure></div>";

    return contenido
}

$(document).ready(function () {
    estructuraImagenes = "";
    for (var i = 0; i < 5; i++) {
        var numeroAleatorio = obtenerNumeroAleatorio(1, 5000);
        imagenJson = obtenerObjetoJson(numeroAleatorio);
        estructuraImagenes += armarFigure(imagenJson);
    }

    $("#contenedorImagenes").html(estructuraImagenes);

    setTimeout(function () {
        $("#contenedorImagenesFake").addClass('d-none');
        $("#contenedorImagenes").removeClass('d-none');
    }, 1500);
});
