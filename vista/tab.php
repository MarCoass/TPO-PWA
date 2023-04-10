<script src="./Assets/js/tab.js"></script>

<div class="row">
    <div class="col-lg-4 col-md-12 p-3">
        <h4 id="nombreCategoria"><!-- NOMBRE CATEGORÍA --></h4>
        <div id="descripcionCategoria" class="fst-italic text-center mb-3">
            <!-- DESCRIPCIÓN CATEGORÍA -->
        </div>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Pommsae Más Populares
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-center me-5" id="listaPosiciones">
                        <!-- LISTA DE LAS POSICIONES MÁS USADAS EN LA COMPETENCIA -->
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <button class="btn btn-outline-danger" id="fem" onclick="btnCambioGen('fem')">Femenino</button>
        <button class="btn btn-outline-dark" id="masc" onclick="btnCambioGen('masc')">Masculino</button>
    </div>

    <div class="col-lg-8 col-md-12 " style="--bs-bg-opacity: .50;">
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
                    <th scope="col" class="d-none d-sm-table-cell">
                        <div>N°</div>
                    </th>
                    <th scope="col" class="d-none d-sm-table-cell">
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
            <tbody id="tablaFemenino" class="table-group-divider">
                <!-- ACÁ EL JS LISTA LOS PARTICIPANTES FEMENINOS -->
            </tbody>
        </table>
    </div>
    <div class="card col-lg-4 col-sm-4 p-3">
        <img class="card-img rounded-circle border-danger shadow-lg" src="../vista/Assets/Img/img/adulto1f.jpg" alt="" srcset="">
        <div id="parrafoGanadorFem">

        </div>

        <!-- DESCRIPCIÓN DE LA GANADORA -->
    </div>
</div>

<div id="infoMasc" class="row d-none">
    <div class="col-lg-8 col-sm-8 p-3 table-responsive-sm">
        <table class="table text-center m-auto bg-light rounded">
            <thead>
                <tr>
                    <th scope="col" class="d-none d-sm-table-cell">
                        <div>N°</div>
                    </th>
                    <th scope="col" class="d-none d-sm-table-cell">
                        <div>Lugar</div>
                    </th>
                    <th scope="col">
                        <div">Nombre</div>
                    </th>
                    <th scope="col">
                        <div">Puntaje</div>
                    </th>
                </tr>
            </thead>
            <tbody id="tablaMasculino" class="table-group-divider">
                <!-- ACÁ EL JS LISTA LOS PARTICIPANTES MASCULINOS-->
            </tbody>
        </table>
    </div>
    <div class="card col-lg-4 col-sm-4 p-3">
        <img class="card-img rounded-circle border-danger shadow-lg" src="../vista/Assets/Img/img/adulto1m.jpg" alt="" srcset="">
        <div id="parrafoGanadorMasc">

        </div>

        <!-- DESCRIPCIÓN DEL GANADOR -->
    </div>
</div>