<?php include_once('./estructura/header.php') ?>

<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
</head>



<div class="row p-3 text-light bg-seccion2">
    <div class="text-center">
        <span class="display-5">Lista de Competidores Registrados</span>
    </div>
</div>

<body>

    <table id="myTable" class="table table-striped table-hover	
                table-borderless display responsive nowrap" style="width:100%">
    </table>

    <script type="text/javascript">


        /* lugar donde lo encontre: https://es.stackoverflow.com/questions/429064/acelerar-la-carga-de-muchos-registros-a-una-tabla-con-datatables */

        //Configuración de DataTable
        function pintarDatatable(dataResult, columns) {
            $("#myTable").DataTable({
                data: dataResult,
                columnDefs: columns,
                order: [[7, 'desc']], /* orden descendiente rank */
                pageLength: 10
            })
        }

        async function datos() {
            const data = await fetch("tablaDatos.json")
                .then(value => value.json())
                .then(value => value)

            const columns = [{
                targets: 0,
                title: "legajo",
                data: "legajo"
            },
            {
                targets: 1,
                title: "apellido",
                data: "apellido",
            },
            {
                targets: 2,
                title: "nombre",
                data: "nombre",
            },
            {
                targets: 3,
                title: "du",
                data: "du"
            },
            {
                targets: 4,
                title: "fechaNacimiento",
                data: "fechaNacimiento",
            },
            {
                targets: 5,
                title: "paisOrigen",
                data: "paisOrigen",

            },
            {
                targets: 6,
                title: "graduacion",
                data: "graduacion",
            },
            {
                targets: 7,
                title: "rankingNacional",
                data: "rankingNacional",
            },
            {
                targets: 8,
                title: "email",
                data: "email",
            },
            {
                targets: 9,
                title: "genero",
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