<script src="./Assets/js/tab.js"></script>

<div class="row">
    <div class="col-lg-4 col-sm-4 p-3">
        <h4 id="nombreCategoria"><!-- NOMBRE CATEGORÍA --></h4>
        <p id="descripcionCategoria">
            <!-- DESCRIPCIÓN CATEGORÍA -->
        </p>
        <hr>
        <button class="btn btn-outline-danger" id="fem" onclick="btnCambioGen('fem')">Femenino</button>
        <button class="btn btn-outline-dark" id="masc" onclick="btnCambioGen('masc')">Masculino</button>
    </div>

    <div class="col-lg-8 col-sm-8 " style="--bs-bg-opacity: .50;">
        <img id="imagenFem" src="" alt="" class="img-fluid rounded"> <!-- IMAGEN COMPETIDOR FEMENINO -->
        <img id="imagenMasc" src="" alt="" class="img-fluid rounded d-none"> <!-- IMAGEN COMPETIDOR MASCULINO -->
    </div>
</div>
<hr>
<div id="infoFem" class="row">
    <div class="col-lg-8 col-sm-8 p-3 table-responsive-sm">
        <table class="table text-center m-auto bg-light rounded">
            <thead>
                <tr>
                    <th scope="col" class=" d-none d-sm-table-cell col-sm-6 col-md-4 col-lg col-xl-3 col-xxl-2">
                        <div>N°</div>
                    </th>
                    <th scope="col" class=" d-none d-sm-table-cell col-sm-6 col-md-4 col-lg col-xl-3 col-xxl-2">
                        <div>Lugar</div>
                    </th>
                    <th scope="col" class="col-sm-12 col-md-4 col-lg col-xl-6 col-xxl-8">
                        <div class="">Nombre</div>
                    </th>
                    <th scope="col" class="col-sm-12 col-md-4 col-lg col-xl-6 col-xxl-8">
                        <div class="">Puntaje</div>
                    </th>
                </tr>
            </thead>
            <tbody id="tablaFemenino" class="table-group-divider">
                <!-- ACÁ EL JS LISTA LOS PARTICIPANTES FEMENINOS -->
            </tbody>
        </table>
    </div>
    <div class="col-lg-4 col-sm-4 p-3" id="parrafoGanadorFem">
        <!-- DESCRIPCIÓN DE LA GANADORA -->
    </div>
</div>

<div id="infoMasc" class="row d-none">
    <div class="col-lg-8 col-sm-8 p-3 table-responsive-sm">
        <table class="table text-center m-auto bg-light rounded">
            <thead>
                <tr>
                    <th scope="col" class=" d-none d-sm-table-cell">
                        <div>N°</div>
                    </th>
                    <th scope="col" class=" d-none d-sm-table-cell">
                        <div>Lugar</div>
                    </th>
                    <th scope="col">
                        <div class="">Nombre</div>
                    </th>
                    <th scope="col">
                        <div class="">Puntaje</div>
                    </th>
                </tr>
            </thead>
            <tbody id="tablaMasculino" class="table-group-divider">
                <!-- ACÁ EL JS LISTA LOS PARTICIPANTES MASCULINOS-->
            </tbody>
        </table>
    </div>
    <div class="col-lg-4 col-sm-4 p-3" id="parrafoGanadorMasc">
        <!-- DESCRIPCIÓN DEL GANADOR -->
    </div>
</div>