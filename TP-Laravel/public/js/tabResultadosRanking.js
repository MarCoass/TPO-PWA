$(window).on("load", function () {
  //  $('#ranking_tabla_fem').removeClass('tabla-visible');
    $('#ranking_tabla_fem').hide();
    $('#titulo-fem').hide();
    var nombreCategoria = $("#selectCategorias option:selected").text().split("-")[0].trim();
    $("#titulo-masc").text("Categoría " + nombreCategoria + " Masculino");
});

$("#selectCategorias").change(function () {
    var idCategoria = $(this).val();
    var genero = $(this).find('option:selected').data('genero');
    /* console.log("categoria".idCategoria); */
    /* console.log("genero".genero); */
    var idTabla;
    if (genero == 2) {
        idTabla = '#ranking_tabla_masc';
        $('#titulo-fem').hide();
        $('#titulo-masc').show();
        $('#ranking_tabla_fem').hide();
        $('#ranking_tabla_fem').DataTable().destroy();
        consultarRankingPorCategoria(idCategoria, idTabla);

        var nombreCategoria = $("#selectCategorias option:selected").text().split("-")[0].trim();
        $("#titulo-masc").text("Categoría " + nombreCategoria + " Masculino");

    } else {
        idTabla = '#ranking_tabla_fem';
    
        $('#titulo-masc').hide();
        $('#titulo-fem').show();
        $('#ranking_tabla_masc').hide();
        $('#ranking_tabla_masc').DataTable().destroy();
        consultarRankingPorCategoria(idCategoria, idTabla);

        var nombreCategoria = $("#selectCategorias option:selected").text().split("-")[0].trim();
        $("#titulo-fem").text("Categoría " + nombreCategoria + " Femenino");
    }
    
   
});

function consultarRankingPorCategoria(idCategoria, idTabla) {

    if (idTabla == '#ranking_tabla_masc') {
       
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/obtenerRanking",
            type: "POST",
            data: { idCategoria: idCategoria },
            success: function (data) {
                console.log(data);
                
                $(idTabla).show();
                    armarTablaRanking(data.competidoresMasculinos, idTabla);
    
               
            }
        });


    }else{
        var idTabla = '#ranking_tabla_fem';
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/obtenerRanking",
            type: "POST",
            data: { idCategoria: idCategoria },
            success: function (data) {
                console.log(data);
                $(idTabla).show();
                    armarTablaRanking(data.competidoresFemeninos, idTabla);
            }
        });

    }



}

function armarTablaRanking($arregloCompetidores, $idTabla) {

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
                        retorno = "<i class='bi bi-award-fill fs-5 " + tipo + " me-1'></i>"
                    }
                    if (data == 2) {
                        tipo = "text-secondary";
                        retorno = "<i class='bi bi-award-fill fs-5 " + tipo + " me-1'></i>"
                    }
                    if (data == 3) {
                        tipo = "text-brown";
                        retorno = "<i class='bi bi-award-fill fs-5 " + tipo + " me-1'></i>"
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
            columns: columns,
            order: [[0, "asc"]],
            language: {
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
