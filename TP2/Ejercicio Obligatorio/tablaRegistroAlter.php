<?php include_once('./estructura/header.php') ?>

<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <style>
        table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
            background-color: orangered;
            font-weight: bolder;
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td.dtr-control:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th.dtr-control:before {
            background-color: #D1A637;
        }
    </style>

</head>

<div class="row p-3 text-light bg-seccion2 mb-3">
    <div class="text-center">
        <span class="display-5">Lista de Competidores Registrados</span>
    </div>
</div>

<table id="myTable" class="table table-striped table-hover table-borderless display responsive nowrap"
    style="width:100%">
</table>

<script src="js/tablaAlter.js"></script>

<?php include_once('./estructura/footer.php') ?>