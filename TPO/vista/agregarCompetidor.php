<!-- Modal -->
<div class="modal fade" id="modalFormCompetidor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-xl ">
        <div class="modal-content" id="ModalContenido">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalFormTitulo">Cargar Nuevo Competidor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" style="overflow: hidden;">
                    <div class="col-4 align-self-start my-1 d-none d-md-block">
                        <img src="../util/img/form-foto.png" class="img-form rounded" style="width: 100%; height: 480px; object-fit: cover;">
                    </div>
                    <div class="col-md-8 position-relative">
                        <div class="mx-auto" style="width: 350px">
                            <div class="position-relative m-4">
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <button type="button" onclick="showTab('paso1', 0, 'cambiar')" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height: 2rem;">1</button>
                                <button type="button" onclick="showTab('paso2', 100, '')" id="botonForm2" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height: 2rem;">2</button>
                            </div>
                        </div>
                        <form id="cargaParticipante" class="needs-validation" novalidate> <!-- INICIO FORM -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="paso1"> <!-- INICIO CONTENIDO PASO 1 -->
                                    <div class="row">
                                        <?php include_once("./estructura/inputsPaso1.php") ?>
                                    </div>
                                </div> <!-- FIN CONTENIDO PASO 1 -->
                                <div class="tab-pane fade" id="paso2"> <!-- INICIO CONTENIDO PASO 2 -->
                                    <div class="row">
                                        <?php include_once("./estructura/inputsPaso2.php") ?>
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

<div class="modal fade" id="modalResultadoCarga" tabindex="-1" aria-labelledby="modalResultadoCarga" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Resultado de Carga de Competidor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="mensajeCarga"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary botonResultado">Cerrar</button>
            </div>
        </div>
    </div>
</div>