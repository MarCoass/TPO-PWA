<?php include_once('./estructura/header.php') ?>
<script src="js/cargarDatosTabla.js"></script>
<div class="row p-3 text-light bg-seccion2">
    <div class="text-center">
        <span class="display-5">Lista de Competidores Registrados</span>
    </div>
</div>
<div class="row">
    .<div class="table-responsive">
        <table id="tabla" class="table table-striped
                table-hover	
                table-borderless
                
                align-middle">
            <thead class="table-secondary">
                <tr>
                    <th>Legajo</th>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>DU</th>
                    <th>Email</th>
                    <th>Edad</th>
                    <th>País de origen</th>
                    <th>Género</th>
                    <th>Graduación</th>
                    <th>Ranking nacional</th>
                </tr>
            </thead>
            <tbody class="table-group-divider align-items-center">
                
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>

</div>


<script>
    /*var datos = JSON.parse(document.cookie);
    console.log(datos)

    var tabla = document.getElementById("tabla");
    var row = tabla.insertRow();
    for (var key in datos) {
        var cell = row.insertCell();
        cell.innerHTML = datos[key];
    }


    /* ESTO ES SOLO UNA IDEA */
    /* QUE NO SIRVE */
    /* fetch("tablaDatos.json")
    .then(response => response.json())
    .then(data => {
        console.log(data);
        var tabla = document.getElementById("tabla");
        for (var i = 0; i < data.length; i++) {
            var fila = tabla.insertRow(i+1);
            var celda1 = fila.insertCell(0);
            var celda2 = fila.insertCell(1);
            var celda3 = fila.insertCell(2);
            var celda4 = fila.insertCell(3);
            var celda5 = fila.insertCell(4);
            var celda6 = fila.insertCell(5);
            var celda7 = fila.insertCell(6);
            var celda8 = fila.insertCell(7);
            var celda9 = fila.insertCell(8);
            var celda10 = fila.insertCell(9);
            
            celda1.innerHTML = data[i].legajo;
            celda2.innerHTML = data[i].apellido;
            celda3.innerHTML = data[i].nombre;
            celda4.innerHTML = data[i].du;
            celda5.innerHTML = data[i].fechaNacimiento;
            celda6.innerHTML = data[i].paisOrigen;
            celda7.innerHTML = data[i].graduacion;
            celda8.innerHTML = data[i].rankingNacional;
            celda9.innerHTML = data[i].email;
            celda10.innerHTML = data[i].genero;
        }
    }); */
</script>


<?php include_once('./estructura/footer.php') ?>