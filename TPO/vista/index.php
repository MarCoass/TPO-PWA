<?php include_once("./estructura/header.php") ?>

<div class="row p-3 text-light bg-seccion2 mb-5" id="seccion1">
    <div class="text-center">
        <span class="display-5">Cronómetro </span>
    </div>
</div>

<div class="row text-center my-3 justify-content-center">
    <div class="col-12">
        <button id="startButton" onclick="startCountdown()" type="button" class="btn btn-outline-success btn-lg me-2">
            <i class="bi bi-play me-1"></i>Iniciar
        </button>
        <button id="stopButton" onclick="stopCountdown()" type="button" class="btn btn-outline-danger btn-lg me-2" disabled>
            <i class="bi bi-stop me-1"></i>Finalizar
        </button>
        <button id="restartButton" onclick="resetCountdown()" type="button" class="btn btn-outline-info btn-lg">
            <i class="bi bi-arrow-clockwise me-1"></i></i>Reiniciar
        </button>
    </div>
    <div class="col-6 mt-3 bg-cronometro">
        <p id="inicio" class="textoContador"><span id="countdown">90</span> Segundos</p>
        <p id="pasado" class="d-none text-danger textoContador"><span id="countup">0</span> OVERTIME</p>
        <p id="final" class="d-none text-success textoContador"><span id="total"></span> Segundos Totales</p>
    </div>
</div>
<!-- 








 -->
<div class="row p-3 text-light bg-seccion2 mb-5"  id="seccion2">
    <div class="text-center">
        <span class="display-5">Video</span>
    </div>
</div>

<div class="row mb-5 justify-content-center">
    <a class="d-sm-none d-block" href="https://www.youtube.com/embed/CpEGREBGh2E">Ver video de la última competencia
        internacional de Poomsae</a>
    <iframe title="ver video" class="d-sm-block  d-none col-md-10 col-xl-8" width="560" height="315" src="https://www.youtube.com/embed/CpEGREBGh2E" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
</div>
<!-- 








 -->
<div class="row p-3 text-light bg-seccion2  mb-3"  id="seccion3">
    <div class="text-center">
        <span class="display-5">Lista de Competidores Registrados</span>
    </div>
</div>

<?php include_once("./agregarCompetidor.php") ?> <!-- FORMULARIO MODAL -->

<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex align-items-center mx-3 py-3">
            <button id="botonAgregarCompetidor" type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalFormCompetidor">
                <i class="bi bi-person-plus me-2"></i>Agregar Competidor
            </button>
            <div class="d-flex ms-auto">
                <div class="input-group" style="width: 350px;">
                    <select class="form-select border-danger bg-danger text-white" id="filtroTabla">
                        <option value="0" class="bg-danger text-white">Legajo</option>
                        <option value="1" class="bg-danger text-white">Apellido</option>
                        <option value="2" class="bg-danger text-white">Nombre</option>
                        <option value="3" class="bg-danger text-white">DU</option>
                        <option value="4" class="bg-danger text-white">Email</option>
                        <option value="5" class="bg-danger text-white">Edad</option>
                    </select>
                    <input type="text" class="form-control border-danger" id="buscar" placeholder="Buscar" onkeyup="filtrarTabla()" aria-describedby="basic-addon2">
                    <span class="input-group-text border-danger bg-danger text-white" id="basic-addon2"><i class="bi bi-search"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="table-responsive bg-light" id="bfTabla">
            <table id="tabla" class="table table-hover align-middle text-center m-0">
                <thead>
                    <tr class="table-danger">
                        <th>Legajo</th>
                        <th class="d-none d-sm-table-cell">Apellido</th>
                        <th class="d-none d-sm-table-cell">Nombre</th>
                        <th class="d-none d-md-table-cell">DU</th>
                        <th class="d-none d-md-table-cell">Email</th>
                        <th class="d-none d-lg-table-cell">Edad</th>
                        <th class="d-none d-lg-table-cell">País de origen</th>
                        <th class="d-none d-lg-table-cell">Género</th>
                        <th>Graduación</th>
                        <th>Ranking nacional</th>
                    </tr>
                </thead>
                <tbody id="tablaBody"></tbody>

            </table>
        </div>


    </div>
</div>
<!-- 



 -->
<div class="row p-3 text-light bg-seccion2"  id="seccion4">
    <div class="text-center">
        <span class="display-5">Imágenes Random</span>
    </div>
</div>

<div class="row my-3 justify-content-center d-none mx-3" id="contenedorImagenes">
    <!--
            <div class="col-4">
                <figure class="figure">
                    <img src="..." class="figure-img img-fluid rounded" alt="...">
                    <figcaption class="figure-caption text-end">
                        <a href='#' class='text-decoration-none text-secondary' data-bs-toggle='modal' data-bs-target='#modalImagen'>A caption for the above image.</a>
                    </figcaption>
                </figure>
            </div>
        -->
</div>

<?php include_once("./imagesFake.php") ?> <!-- IMAGENES FAKE -->

<?php include_once("./estructura/modalVerImagen.php") ?> <!-- MODAL VER DETALLE IMAGEN -->

<!-- 

 -->
<?php include_once("./estructura/footer.php") ?>