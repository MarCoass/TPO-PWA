<?php include_once('./estructura/header.php') ?>
<script src="js/cargarDatosTabla.js"></script>
<div class="row p-3 text-light bg-seccion2">
    <div class="text-center">
        <span class="display-5">Lista de Competidores Registrados</span>
    </div>
</div>


<!--<div class="row m-2">
    <div class="col-12">
        <div class="d-flex justify-content-end mb-2">
            <div class="form-group d-flex flex-row align-items-center">
                <label for="buscar" class="me-2">Búsqueda:</label>
                <input type="text" id="buscar" name="buscar" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table id="tabla" class="table table-striped table-hover table-borderless align-middle">
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
            </table>
        </div>
    </div>
</div>-->

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-end my-3">
            <div class="input-group" style="width: 350px;">
                <select class="form-select" id="filtroTabla">
                    <option value="1">Nombre</option>
                    <option value="2">Apellido</option>
                    <option value="3">DU</option>
                    <option value="4">Email</option>
                </select>
                <input type="text" class="form-control" id="buscar" placeholder="Buscar" onkeyup="filtrarTabla()">
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table id="tabla" class="table table-hover align-middle text-center">
                <thead>
                    <tr class="table-danger">
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
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>


<script>
    function filtrarTabla() {
        let filtro = document.getElementById("filtroTabla");
        let columna = filtro.value;
        let busqueda = document.getElementById("buscar").value.toLowerCase();
        let tabla = document.getElementById("tabla");
        let filas = tabla.getElementsByTagName("tr");

        for (let i = 1; i < filas.length; i++) {
            let celda = filas[i].getElementsByTagName("td")[columna];
            if (celda) {
                let texto = celda.textContent.toLowerCase();
                filas[i].style.display = texto.includes(busqueda) ? "" : "none";
            }
        }

        filtro.addEventListener("change", function() {
            document.getElementById("buscar").value = "";
        });
    }
</script>



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