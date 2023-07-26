// Crear una función que reciba el id de la tabla, la columna de ordenación y el orden
function datatables(tabla_id, columna, orden) {
    // Obtener el elemento de la tabla por su id
    var tabla = document.getElementById(tabla_id);
    // Verificar si existe el elemento
    if (tabla) {
        // Inicializar el DataTable con las opciones deseadas
        tabla = $("#" + tabla_id).DataTable({
            processing: true,
            responsive: true,
            ordering: true,
            order: [[columna, orden]],
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
            displayLength: 10,
            lengthMenu: [
                [5, 10, 15, -1],
                [5, 10, 15, "Todos"],
            ],
        });
    }
}
