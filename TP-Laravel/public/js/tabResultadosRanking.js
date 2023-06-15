$(window).on("load", function () {

    consultarRankingPorCategoria(1);
});

$("#selectCategorias").change(function () {
    var idCategoria = $(this).val();
    consultarRankingPorCategoria(idCategoria);
});

function consultarRankingPorCategoria(idCategoria){

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Necesario para que funcione la petición
        },
        url: "http://127.0.0.1:8000/obtenerRanking",
        type: "POST",
        data: { idCategoria: idCategoria },
        success: function (data) {
            console.log(data);

            armarTablaRanking(data.competidoresMasculinos, '#ranking_tabla_masc');
            armarTablaRanking(data.competidoresFemeninos, '#ranking_tabla_fem');

        }
    });
    
}

function armarTablaRanking($arregloCompetidores, $idTabla) {
    
    $($idTabla).DataTable().destroy(); // Destruir el DataTable existente

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
            title: "Lugar de origen",
            data: "lugar",
        },
        {
            targets: 2,
            title: "Nombre",
            data: "nombre",
        },
        {
            targets: 3,
            title: "Ranking",
            data: "ranking",
        },
    ];

    $($idTabla).DataTable({
        data: $arregloCompetidores,
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
            emptyTable: "No hay competidores en esta categoria",
            info: "Viendo _START_ a _END_ de _TOTAL_ entradas",
        },
    });




}


/* 
// Evento del botón "Femenino"
$("#btnFemenino").click(function () {
    cargarTablaRanking("femenino");
});

// Evento del botón "Masculino"
$("#btnMasculino").click(function () {
    cargarTablaRanking("masculino");
});

 */