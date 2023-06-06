$(window).on("load", function () {
    var idCompetencia = $("#idCompetenciaOculto").html();
    var idCategoria = $("#selectCategorias").val();
    obtenerCompetidores(idCompetencia, idCategoria);
});

$("#selectCategorias").change(function () {
    var idCategoria = $(this).val();
    var idCompetencia = $("#idCompetenciaOculto").html();
    obtenerCompetidores(idCompetencia, idCategoria);
});

function obtenerCompetidores(idCompetencia, idCategoria) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Necesario para que funcione la petición
        },
        type: "POST",
        url: "http://127.0.0.1:8000/traerCompetidores",
        data: { idCompetencia: idCompetencia, idCategoria: idCategoria },
        success: function (response) {
            //console.log(response);
            armarTablaCompetidores(response.competidoresFiltrados);
        },
    });
}

function armarTablaCompetidores(competidores) {
    //console.log(competidores);
    $("#tbodyCompetidores").empty();

    estructura = "";

    if (competidores.length > 0) {
        competidores.forEach((competidor) => {
            var icono = "";
            if (competidor.puesto > 0 && competidor.puesto <= 3) {
                icono =
                    "<i class='bi bi-award-fill fs-5 text-warning me-1'></i>";
            }
            estructura += "<tr><th scope='row'>" + icono,competidor.puesto + "</th>";
            estructura += "<td>" + competidor.nombre + "</td>";
            estructura += "<td>" + competidor.escuela + "</td>";
            estructura += "<td>" + competidor.puntaje + "</td>";
            estructura += "</tr>";
        });
    } else {
        estructura = "<h4 class='text-danger'>Esta competencia o categoría aún no tiene registrado competidores.</h4>"
    }

    $("#tbodyCompetidores").html(estructura);
}
