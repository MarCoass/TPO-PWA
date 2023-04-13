<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poomsae Reconocido Individual Élite</title>

    <!-- ICON -->
    <link rel="icon" type="image\x-icon" href=".\Assets\Img\img\logo.ico">

    <!-- Jquery 3.6.4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../TPO/vista/Assets/Css/style.css">

</head>

<body>
    <div class="container-fluid ">
        <div class="row p-3 justify-content-center ">
            <div class="col-12 justify-content-center">
                <img src="../TPO/vista/Assets/Img/World_Taekwondo.png" alt="" width="100px" />
                <span class="fs-2 ms-3">Poomsae Reconocido</span>
            </div>
        </div>
        <div class="row p-3 text-light bg-seccion2">
            <div class="text-center">
                <span class="display-5">Agregar competidor</span>
            </div>
        </div>



        <form class="row m-5" id="myForm">
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
                <input class="form-control" type="number" id="rankingNacional" name="rankingNacional"> </div>
                
                <div class="col-lg-3 col-md-6 col-sm-12  pt-3 m-auto">
                    <input class="btn btn-primary" type="button" value="Enviar" onclick="convertirEnJSON()">
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
                        console.log(json);
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
    
    <div class="bg-danger row d-flex">
        <section class="mt-3" style="user-select: none;">
            <footer class="text-center text-white bg-danger">
                <div class="container">
                    <div class="row text-center">
                        <div class="col">
                            <a href="https://github.com/MarCoass">
                                <button type="button" class="btn btn-outline-dark">
                                    <h5 class="mx-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                                            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                                        </svg></h5>
                                </button>
                            </a>
                            <h5>Martina Coassin</h5>
                            <p>FAI - 2542</p>
                        </div> |
                        <div class="col">
                            <a href="https://github.com/BraianCenturion2001" style="text-decoration:none;">
                                <button type="button" class="btn btn-outline-dark">
                                    <h5 class="mx-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                                            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                                        </svg></h5>
                                </button>
                            </a>
                            <h5>Braian Centurión</h5>
                            <p>FAI - 3001</p>
                        </div> |
                        <div class="col">
                            <a href="https://github.com/matiasnqn16">
                                <button type="button" class="btn btn-outline-dark">
                                    <h5 class="mx-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                                            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                                        </svg></h5>
                                </button>
                            </a>
                            <h5>Matias Farfan</h5>
                            <p>FAI - 1842</p>
                        </div>
                    </div>
                </div>
                <div class="text-center mb-3">
                    Programación Web Avanzada - 2023 <img src="./Assets/Img/img/logo.png" class="mx-2" alt="FAI" title="FAI" width="40" height="40"> Universidad Nacional del Comahue
                </div>
            </footer>
        </section>
    </div>
    </div>
    <!--Fin del div.container-fluid-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="Assets/js/carousel.js"></script>
    <script src="Assets/js/botonCambioGenero.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>



</body>

</html>