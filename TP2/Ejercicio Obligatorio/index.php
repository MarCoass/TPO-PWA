<?php include_once('./estructura/header.php') ?>
<div class="row p-3 text-light bg-seccion2">
    <div class="text-center">
        <span class="display-5">Agregar competidor</span>
    </div>
</div>

<style>
    .nav-link.active {
        color: red;
    }
</style>

<div class="row col-10 mx-auto my-5 shadow" style="min-height: 400px; max-height: 500px; overflow: hidden;">
    <div class="col-4">
        <img src="./estructura/form-foto.png" height="300" style="height: 100%; width: 100%; object-fit: contain;">
    </div>
    <div class="col-8 position-relative">
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
        <form id="cargaParticipante"> <!-- INICIO FORM -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="paso1"> <!-- INICIO CONTENIDO PASO 1 -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12  pt-3">
                            <label class="form-label" for="apellido">Apellido:</label>
                            <input class="form-control" type="text" id="apellido" name="apellido" autocomplete="off">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12  pt-3">
                            <label class="form-label" for="nombre">Nombre:</label>
                            <input class="form-control" type="text" id="nombre" name="nombre" autocomplete="off">
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12 pt-3">
                            <label class="form-label" for="dni">DNI:</label>
                            <input class="form-control" type="number" min="0" id="dni" name="dni" autocomplete="off">
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12  pt-3">
                            <label class="form-label" for="fechaNacimiento">Edad:</label>
                            <input class="form-control" type="date" min="0" id="fechaNacimiento" name="fechaNacimiento">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12  pt-3">
                            <label class="form-label" for="email">Email:</label>
                            <input class="form-control" type="email" id="email" name="email" autocomplete="off">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12  pt-3">
                            <label class="form-label" for="paisOrigen">País:</label>
                            <input class="form-control" type="text" id="paisOrigen" name="paisOrigen" autocomplete="off">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12  pt-3">
                            <label class="form-label" for="genero">Género:</label>
                            <select class="form-control" id="genero" name="genero">
                                <option disabled selected>Selecciona una opción</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div class="my-3 ml-3 row justify-content-end">
                            <button type="button" class="btn btn-outline-primary  col-md-4 col-sm-6" onclick="showTab('paso2', 'link2', 'link1')">
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
                        <div class="col-lg-6 col-md-6 col-sm-12  pt-3">
                            <label class="form-label" for="legajo">Legajo:</label>
                            <input class="form-control" type="text" id="legajo" name="legajo" autocomplete="off">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12  pt-3">
                            <label class="form-label" for="rankingNacional">Ranking:</label>
                            <input class="form-control" type="number" min="0" id="rankingNacional" name="rankingNacional" autocomplete="off">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12  pt-3">
                            <label class="form-label" for="graduacion">Graduacion:</label>
                            <select class="form-control" id="graduacion" name="graduacion">
                                <option disabled selected>Selecciona una opción</option>
                                <option value="1ro GUP">1ro GUP</option>
                                <option value="2do GUP">2do GUP</option>
                                <option value="3ero GUP">3ero GUP</option>
                                <option value="4to GUP">4to GUP</option>
                                <option value="5to GUP">5to GUP</option>
                                <option value="6to GUP">6to GUP</option>
                                <option value="7mo GUP">7mo GUP</option>
                                <option value="8vo GUP">8vo GUP</option>
                                <option value="9no GUP">9no GUP</option>
                                <option value="10mo GUP">10mo GUP</option>
                            </select>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 end-0 mb-3 me-3 mt-5">
                        <button type="button" class="btn btn-outline-secondary" onclick="showTab('paso1', 'link1', 'link2')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                            </svg>
                            Volver
                        </button>
                        <button type="submit" class="btn btn-outline-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z" />
                            </svg>
                            Guardar
                        </button>
                    </div>
                </div> <!-- FIN CONTENIDO PASO 2 -->
            </div>
        </form> <!-- FIN FORM -->
    </div>
</div>

<script>
    const competidores = localStorage.getItem('competidores');
    if (competidores === null) {
        setearCompetidores();
    }

    function setearCompetidores() {
        const datosCompetidor1 = {
            legajo: "ABC1234567",
            apellido: "Centurión",
            nombre: "Braian",
            du: "12345678",
            fechaNacimiento: "2001-04-08",
            paisOrigen: "Chile",
            graduacion: "2do GUP",
            rankingNacional: 750,
            email: "braian.cent@example.com",
            genero: "masculino",
        };

        const datosCompetidor2 = {
            legajo: "DEF2345678",
            apellido: "Coassin",
            nombre: "Martina",
            du: "23456789",
            fechaNacimiento: "2001-08-25",
            paisOrigen: "Argentina",
            graduacion: "1er DAN",
            rankingNacional: 600.5,
            email: "mar.coassin@example.com",
            genero: "femenino",
        };

        const datosCompetidor3 = {
            legajo: "GHI3456789",
            apellido: "Farfan",
            nombre: "Matias",
            du: "34567890",
            fechaNacimiento: "1995-03-15",
            paisOrigen: "Colombia",
            graduacion: "5to GUP",
            rankingNacional: 350,
            email: "matias.farfan@example.com",
            genero: "masculino",
        };

        const jsonCompetidores = JSON.stringify([datosCompetidor1, datosCompetidor2, datosCompetidor3]);

        localStorage.setItem('competidores', jsonCompetidores);
    }
</script>
<script src="./js/claseChayanne.js"></script>
<script src="./js/cargaParticipante.js"></script>


<!--<form class="row m-5" id="myForm">
    <div class="col-lg-3 col-md-6 col-sm-12  pt-3">
        <label class="form-label" for="legajo">Legajo:</label>
        <input class="form-control" type="text" id="legajo" name="legajo">
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12  pt-3">
        <label class="form-label" for="apellido">Apellido:</label>
        <input class="form-control" type="text" id="apellido" name="apellido">
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12  pt-3">
        <label class="form-label" for="nombre">Nombre:</label>
        <input class="form-control" type="text" id="nombre" name="nombre">
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 pt-3">
        <label class="form-label" for="dni">DNI:</label>
        <input class="form-control" type="number" id="dni" name="dni">
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12  pt-3">
        <label class="form-label" for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email">
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12  pt-3">
        <label class="form-label" for="edad">Edad:</label>
        <input class="form-control" type="number" id="edad" name="edad">

    </div>

    <div class="col-lg-3 col-md-6 col-sm-12  pt-3">
        <label class="form-label" for="paisOrigen">País:</label>
        <input class="form-control" type="text" id="paisOrigen" name="paisOrigen">

    </div>

    <div class="col-lg-3 col-md-6 col-sm-12  pt-3">
        <label class="form-label" for="genero">Género:</label>
        <select class="form-control" id="genero" name="genero">
            <option value="">Selecciona una opción</option>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="otro">Otro</option>
        </select>

    </div>

    <div class="col-lg-3 col-md-6 col-sm-12  pt-3">
        <label class="form-label" for="graduacion">Graduacion:</label>
        <select class="form-control" id="graduacion" name="graduacion">
        </select>

    </div>
    <div class="col-lg-3 col-md-6 col-sm-12  pt-3">

        <label class="form-label" for="rankingNacional">Ranking:</label>
        <input class="form-control" type="number" id="rankingNacional" name="rankingNacional">
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12  pt-3 m-auto">

        <input class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal" type="button" value="Enviar" onclick="convertirEnJSON()">
        <input class="btn btn-secondary" type="reset" value="Borrar datos">
    </div>

    <script>
        function convertirEnJSON() {
            var form = document.getElementById("myForm");
            var data = new FormData(form);
            var object = {};
            data.forEach(function(value, key) {
                object[key] = value;
            });
            var json = JSON.stringify(object);
            //console.log(json);
            cargarDatos(json)
            /* usando por ahora una cookie */
            document.cookie = json

        }
        // Leer datos del archivo JSON
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myObj = JSON.parse(this.responseText);
                // Crear selector en el DOM
                var x = document.getElementById("graduacion");
                for (var i = 0; i < myObj.length; i++) {
                    var option = document.createElement("option");
                    option.text = myObj[i].graduacion;
                    x.add(option);
                }
            }
        };
        xmlhttp.open("GET", "graduaciones.json", true);
        xmlhttp.send();
    </script>

</form>
<div id="modal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Competidor agregado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="cuerpoModal" class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>
<script src="./js/agregarDatosModal.js"></script>-->

<?php include_once('./estructura/footer.php') ?>