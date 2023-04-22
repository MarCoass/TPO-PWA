/* lugar donde lo encontre: https://es.stackoverflow.com/questions/429064/acelerar-la-carga-de-muchos-registros-a-una-tabla-con-datatables */

//Configuración de DataTable
function pintarDatatable(dataResult, columns) {
    $("#myTable").DataTable({
        data: dataResult,
        columnDefs: columns,
        order: [[7, 'desc']], /* orden descendiente rank */
        "language": {
            "search": "Buscar:",
            "lengthMenu": "Ver _MENU_ entradas",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "infoEmpty": "Viendo 0 a 0 de 0 entradas",
            "info": "Viendo _START_ a _END_ de _TOTAL_ entradas",
        },
    })
}

async function datos() {

    const data = await JSON.parse(localStorage.getItem('competidores'));

    const columns = [{
        targets: 0,
        title: "Legajo",
        data: "legajo"
    },
    {
        targets: 1,
        title: "Apellido",
        data: "apellido",
    },
    {
        targets: 2,
        title: "Nombre",
        data: "nombre",
    },
    {
        targets: 3,
        title: "Pais",
        data: "paisOrigen",
        render: (data, type, r, m) => {
            return (type == "display") ? `<img src="svg/${data}.svg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="${data}" width="20px">` : data
        }
    },
    {
        targets: 4,
        title: "Rank Nacional",
        data: "rankingNacional",
    },
    {
        targets: 5,
        title: "Movimiento",
        data: "du",
        render: (data, type, r, m) => {
            return (type == "display") ? `<button class="btn btn-dark text-white bolder">${data}</button>` : data
        }
    },
    {
        targets: 6,
        title: "Grado",
        data: "graduacion",
        render: (data, type, r, m) => {
            return (type == "display") ? `<button class="btn btn-dark text-white bolder">${data}</button>` : data
        }
    },
    {
        targets: 7,
        title: "Fecha de Nacimiento",
        data: "fechaNacimiento",
    },
    {
        targets: 8,
        title: "Email",
        data: "email",
    },
    {
        targets: 9,
        title: "Genero",
        data: "genero",
    }
    ]
    pintarDatatable(data, columns)
}

datos()
