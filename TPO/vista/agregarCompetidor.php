<!-- Modal -->
<div class="modal fade" id="modalFormCompetidor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cargar Nuevo Competidor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" style="overflow: hidden;">
                    <div class="col-4 align-self-start my-1 d-md-block">
                        <img src="../util/img/form-foto.png" class="img-form rounded" style="width: 100%; height: 400px; object-fit: cover;">
                    </div>
                    <div class="col-md-8 position-relative">
                        <div class="nav justify-content-center">
                            <div class="nav-link active" id="link1" data-bs-toggle="tab" data-bs-target="#paso1">
                                <span class="fs-1"><i class="bi bi-1-square"></i></span>
                            </div>
                            <span class="mx-3"></span>
                            <div class="nav-link" id="link2" data-bs-toggle="tab" data-bs-target="#paso2">
                                <span class="fs-1"><i class="bi bi-2-square"></i></span>
                            </div>
                        </div>
                        <form id="cargaParticipante" class="needs-validation" novalidate> <!-- INICIO FORM -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="paso1"> <!-- INICIO CONTENIDO PASO 1 -->
                                    <div class="row">
                                        <?php include_once("./inputsPaso1.php") ?>
                                    </div>
                                </div> <!-- FIN CONTENIDO PASO 1 -->
                                <div class="tab-pane fade" id="paso2"> <!-- INICIO CONTENIDO PASO 2 -->
                                    <div class="row">
                                        <?php include_once("./inputsPaso2.php") ?>
                                    </div>
                                </div> <!-- FIN CONTENIDO PASO 2 -->
                            </div>
                        </form> <!-- FIN FORM -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="modalResultadoCarga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Participante cargado</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="cuerpoModal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="location.reload()">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL -->