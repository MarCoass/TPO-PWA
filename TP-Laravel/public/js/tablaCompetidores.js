$(document).ready(function () {
    $("#competidores_tabla").DataTable({
        ajax: {
            type: "POST",
            url: "js/MOCK_Competidores.json",
            dataSrc: "",
            data: {},
        },
        columns: [
            { data: "GAL" }, 
            { data: "Apellido" }, 
            { data: "Nombre" }, 
            { data: "DU" }, 
            { data: "FechaNacimiento" }, 
            { data: "Pais" }, 
            { data: "Ranking" }, 
            { data: "Graduacion" }, 
            { data: "Email" }, 
            { data: "Genero" }
        ],
        processing: true,
        responsive: true,
        ordering: true,
        language: {
            decimal: ",",
            thousands: ".",
            search: "Buscar: ",
            processing: "Obteniendo datos...",
            lengthMenu: "Mostrar _MENU_ elementos por página",
            zeroRecords: "Sin resultados",
            info: "Mostrando _PAGE_ de _PAGES_ páginas",
            infoEmpty: "No se encontraron elementos",
            infoFiltered: "(filtrado de _MAX_ total elementos)",
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior",
            },
        },

        lengthMenu: [
            [5, 10, 15, -1],
            [5, 10, 15, "Todos"],
        ],
    });
});
