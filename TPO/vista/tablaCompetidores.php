<?php include_once('./estructura/header.php') ?>
<script src="../util/js/cargarDatosTabla.js"></script>
<div class="row p-3 text-light bg-seccion2">
    <div class="text-center">
        <span class="display-5">Lista de Competidores Registrados</span>
    </div>
</div>

<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex justify-content-end my-3">
            <div class="input-group" style="width: 350px;">
                <select class="form-select" id="filtroTabla">
                    <option value="0">Legajo</option>
                    <option value="1">Apellido</option>
                    <option value="2">Nombre</option>
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
                        <th class="d-none d-sm-table-cell">Apellido</th>
                        <th class="d-none d-sm-table-cell">Nombre</th>
                        <th class="d-none d-md-table-cell">DU</th>
                        <th class="d-none d-md-table-cell">Email</th>
                        <th class="d-none d-lg-table-cell">Fecha Nacimiento</th>
                        <th class="d-none d-lg-table-cell">País de origen</th>
                        <th class="d-none d-lg-table-cell">Género</th>
                        <th>Graduación</th>
                        <th>Ranking nacional</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>


<script src="../util/js/filtrarTabla.js"></script>



<?php include_once('./estructura/footer.php') ?>