
<script src="js/cargarOpcionesForm.js"></script>
<div class="row p-3 text-light bg-seccion2">
    <div class="text-center">
        <span class="display-5">Agregar competidor</span>
    </div>
</div>

<div class="row col-10 mx-auto my-5 shadow" style="overflow: hidden;">
    <div class="col-4 align-self-start mt-2 d-none d-md-block">
        <img src="./estructura/img/form-foto.png" class="img-form rounded" style="height: 100%; width: 100%; object-fit: contain;">
    </div>
    <div class="col-md-8 position-relative">
        <div class="nav justify-content-center">
            <div class="nav-link active" id="link1" data-bs-toggle="tab" data-bs-target="#paso1">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-1-circle" viewBox="0 0 16 16">
                    <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383h1.312Z" />
                </svg>
            </div>
            <span class="mx-3"></span>
            <div class="nav-link" id="link2" data-bs-toggle="tab" data-bs-target="#paso2">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-2-circle" viewBox="0 0 16 16">
                    <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM6.646 6.24v.07H5.375v-.064c0-1.213.879-2.402 2.637-2.402 1.582 0 2.613.949 2.613 2.215 0 1.002-.6 1.667-1.287 2.43l-.096.107-1.974 2.22v.077h3.498V12H5.422v-.832l2.97-3.293c.434-.475.903-1.008.903-1.705 0-.744-.557-1.236-1.313-1.236-.843 0-1.336.615-1.336 1.306Z" />
                </svg>
            </div>
        </div>
        <form id="cargaParticipante" class="needs-validation" novalidate> <!-- INICIO FORM -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="paso1"> <!-- INICIO CONTENIDO PASO 1 -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
                            <label class="form-label" for="apellido">Apellido:</label>
                            <input class="form-control" type="text" id="apellido" name="apellido" maxlength="50" placeholder="Ej: Lopez" autocomplete="off" required>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">Campo necesario, Ej: Grillo</div>

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
                            <label class="form-label" for="nombre">Nombre:</label>
                            <input class="form-control" type="text" id="nombre" name="nombre" maxlength="50" placeholder="Ej: Lautaro" autocomplete="off" required>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">Campo necesario, Ej: Pepe</div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pt-3">
                            <label class="form-label" for="dni">DNI:</label>
                            <input class="form-control " type="text" name="dni" id="dni" pattern="[0-9]{8}" maxlength="8" placeholder="Ej: 23456789" required>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">Campo necesario, Ej: 23456789</div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12  pt-3">
                            <label class="form-label" for="fechaNacimiento">Nacimiento:</label>
                            <input class="form-control" type="date" min="1900-01-01" id="fechaNacimiento" name="fechaNacimiento" required>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">Ingresa tu fecha de nacimiento!</div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
                            <label class="form-label" for="email">Email:</label>
                            <input class="form-control" type="email" id="email" name="email" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Ej: persona@correo.com" required>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">Ej: persona@correo.com</div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
                            <label class="form-label" for="paisOrigen">País:</label>
                            <select class="form-control" type="text" id="paisOrigen" name="paisOrigen" autocomplete="off" required>
                                <option value="" disabled selected data-error="Por favor seleccione un país válido">Selecciona una opción</option>

                            </select>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">Seleccione una opcion valida.</div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
                            <label class="form-label" for="genero">Género:</label>
                            <select class="form-control" id="genero" name="genero" required>
                                <option value="" disabled selected data-error="Por favor seleccione un genero">Selecciona una opción</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                            </select>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">Seleccione una opcion valida.</div>
                        </div>
                        <div class="my-3 ml-3 row justify-content-center">
                            <button type="button" class="btn btn-outline-primary col-md-4 col-sm-6 col-xs-8" onclick="showTab('paso2', 'link2', 'link1')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                </svg>
                                Siguiente
                            </button>
                        </div>
                    </div>
                </div> <!-- FIN CONTENIDO PASO 1 -->
                <div class="tab-pane fade" id="paso2"> <!-- INICIO CONTENIDO PASO 2 -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
                            <label class="form-label" for="legajo">GAL:</label>
                            <input class="form-control" type="text" id="legajo" name="legajo" autocomplete="off" pattern="^[A-Z]{3}\d{7}$" placeholder="Ej: ABC1234567" required>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">Campo necesario, necesita 3 letras mayúsculas seguidas de 7 números</div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
                            <label class="form-label" for="rankingNacional">Ranking:</label>
                            <input class="form-control" type="number" min="0" id="rankingNacional" name="rankingNacional" autocomplete="off" max="900" required>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">Ingrese un numero entre 0 y 900</div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12  pt-3">
                            <label class="form-label" for="graduacion">Graduacion:</label>
                            <select class="form-control" id="graduacion" name="graduacion" required>
                                <option value="" disabled selected data-error="Por favor seleccione una graduacion válida">Selecciona una opción</option>
                            </select>
                            <div class="valid-feedback">
                                ¡Correcto!
                            </div>
                            <div class="invalid-feedback">Seleccione una opcion valida.</div>
                        </div>
                        <div class="my-3 ml-3 row justify-content-center">
                            <button type="button" class="btn btn-outline-secondary col-md-4 col-sm-6 col-xs-8" onclick="showTab('paso1', 'link1', 'link2')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                                </svg>
                                Volver
                            </button>
                            <button type="submit" class="btn btn-outline-success col-md-4 col-sm-6  col-xs-8 " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z" />
                                </svg>
                                Guardar
                            </button>
                        </div>
                    </div>
                </div> <!-- FIN CONTENIDO PASO 2 -->
            </div>
        </form> <!-- FIN FORM -->
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<script src="./js/claseCompetidor.js"></script>
<script src="./js/cargaParticipante.js"></script>
<script src="./js/bs-form-validator.js"></script>
