<?php include_once('./estructura/header.php') ?>

<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <style>
        table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before{
            background-color: orangered;
            font-weight: bolder;
        }
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td.dtr-control:before, table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th.dtr-control:before{
            background-color: #D1A637;
        }
    </style>
</head>



<div class="row p-3 text-light bg-seccion2 mb-3">
    <div class="text-center">
        <span class="display-5">Lista de Competidores Registrados</span>
    </div>
</div>

<body>

    <table id="myTable" class="table table-striped table-hover table-borderless display responsive nowrap"
        style="width:100%">
    </table>

    <script type="text/javascript">


        /* lugar donde lo encontre: https://es.stackoverflow.com/questions/429064/acelerar-la-carga-de-muchos-registros-a-una-tabla-con-datatables */

        //Configuración de DataTable
        function pintarDatatable(dataResult, columns) {
            $("#myTable").DataTable({
                data: dataResult,
                columnDefs: columns,
                order: [[7, 'desc']], /* orden descendiente rank */
                pageLength: 10,
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Ver _MENU_ entradas",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "infoEmpty":      "Viendo 0 a 0 de 0 entradas",
                    "info":      "Viendo _START_ a _END_ de _TOTAL_ entradas",
                },
            })
        }

        async function datos() {
            const data = await fetch("tablaDatos2.json")
                .then(value => value.json())
                .then(value => value)

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
                    return (type == "display") ? `<img src="svg/${data}.svg" alt="${data}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" width="20px"> ${data}</img>` : data
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

    </script>

</body>

</html>

<hr>

<?php include_once('./estructura/footer.php') ?>