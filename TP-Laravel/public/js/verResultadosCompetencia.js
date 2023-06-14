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
            const columns = [
                {
                    targets: 0,
                    title: "Puesto",
                    data: "puesto",
                    render: (data, type, r, m) => {
                        var retorno = ""
                        var tipo = "";
                        if (data == 1) {
                            tipo = "text-warning";
                            retorno = "<i class='bi bi-award-fill fs-5 " + tipo +" me-1'></i>"
                        }
                        if (data == 2) {
                            tipo = "text-secondary";
                            retorno = "<i class='bi bi-award-fill fs-5 " + tipo +" me-1'></i>"
                        }
                        if (data == 3) {
                            tipo = "text-brown";
                            retorno = "<i class='bi bi-award-fill fs-5 " + tipo +" me-1'></i>"
                        }

                        return (retorno + data);
                    },
                },
                {
                    targets: 1,
                    title: "Nombre",
                    data: "nombre",
                },
                {
                    targets: 2,
                    title: "Escuela",
                    data: "escuela",
                },
                {
                    targets: 3,
                    title: "Puntaje",
                    data: "puntaje",
                },
            ];
            pintarDatatable(response.competidoresFiltrados, columns);
        },
    });
}

function pintarDatatable(dataResult, columns) {
    $("#tablaVerCompetidores").DataTable().destroy(); // Destruir el DataTable existente

    $("#tablaVerCompetidores").DataTable({
        data: dataResult,
        columns: columns, // Cambia columnDefs a columns
        order: [[0, "asc"]], // Corrige el orden ascendente de la columna 0 (puesto)
        language: {
            // Configuración de idioma
            search: "Buscar:",
            lengthMenu: "Ver _MENU_ entradas",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior",
            },
            infoEmpty: "Viendo 0 a 0 de 0 entradas",
            info: "Viendo _START_ a _END_ de _TOTAL_ entradas",
        },
    });
}
