<?php include_once('./estructura/header.php') ?>
<script src="js/cargarDatosTabla.js"></script>
<div class="row p-3 text-light bg-seccion2">
    <div class="text-center">
        <span class="display-5">Lista de Competidores Registrados</span>
    </div>
</div>

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



<?php include_once('./estructura/footer.php') ?>