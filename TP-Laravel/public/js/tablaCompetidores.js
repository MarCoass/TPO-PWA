$(document).ready(function () {

    $("#competidores_tabla").DataTable({
        ajax: {
            type: "GET",
            url: "/competidores/data",
            dataSrc: "",
        },
        dom: '<"top"f>t<"bottom"lip>',
     columns: [
            { data: "gal" }, 
            { data: "apellido" }, 
            { data: "nombre" }, 
            { data: "du" }, 
            { data: "fechaNacimiento" },
            { data: "nombre_pais" },
            { data: "ranking" }, 
            { data: "graduacion" }, 
            { data: "email" }, 
            { data: "genero" },
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

