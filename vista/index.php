<?php include_once('../vista/common/header.php') ?>

<div class="row p-3 justify-content-center ">
    <div class="col-12 justify-content-center">
        <img src="Assets/Img/World_Taekwondo.png" alt="" width="100px" />
        <span class="fs-2 ms-3">Poomsae Reconocido</span>
    </div>
</div>

<div class="row p-3 text-light bg-seccion2">
    <div class=" text-center">
        <span class="display-5">Poomsae Reconocido Elite Individual</span> 
        <p class="lead">es una categoría de competición de taekwondo en la que los participantes deben ejecutar una serie de movimientos complejos y técnicamente avanzados de forma individual.</p>
        <p class="lead">Esta categoría está destinada a competidores altamente experimentados y habilidosos.</p>
    </div>
</div>

<div class="row justify-content-center text-center bg-carru">
    <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner" role="listbox">

            <div class="carousel-item active">
                <div class="col-md-3 p-5">
                    <div class="card rounded-circle border-danger shadow-lg" onclick="utilizarDatos('infantilesA')">
                        <img src="../vista/Assets/Img/thumbnails/infantiles a.jpg" class="img-fluid rounded-circle">
                    </div>
                    <div class="display-6 mt-2">Infantiles A</div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="col-md-3 p-5">
                    <div class="card rounded-circle border-danger shadow-lg" onclick="utilizarDatos('infantilesB')">
                        <img src="../vista/Assets/Img/thumbnails/infantiles b.jpg" class="img-fluid rounded-circle">
                    </div>
                    <div class="display-6 mt-2">Infantiles B</div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="col-md-3 p-5">
                    <div class="card rounded-circle border-danger shadow-lg" onclick="utilizarDatos('cadete')">
                        <img src="../vista/Assets/Img/thumbnails/cadete 12-14.jpg" class="img-fluid rounded-circle">
                    </div>
                    <div class="display-6 mt-2">Cadete</div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3 p-5">
                    <div class="card rounded-circle border-danger shadow-lg" onclick="utilizarDatos('cadete')">
                        <img src="../vista/Assets/Img/thumbnails/cadeteExtra.png" class="img-fluid rounded-circle">
                    </div>
                    <div class="display-6 mt-2">Cadete</div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3 p-5">
                    <div class="card rounded-circle border-danger shadow-lg" onclick="utilizarDatos('juveniles')">
                        <img src="../vista/Assets/Img/thumbnails/juveniles 15-17.jpg" class="img-fluid rounded-circle">
                    </div>
                    <div class="display-6 mt-2">Juveniles</div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="col-md-3 p-5">
                    <div class="card rounded-circle border-danger shadow-lg" onclick="utilizarDatos('adultos1')">
                        <img src="../vista/Assets/Img/thumbnails/adulto 1 menos 30.jpg" class="img-fluid rounded-circle">
                    </div>
                    <div class="display-6 mt-2">Adulto 1</div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3 p-5">
                    <div class="card rounded-circle border-danger shadow-lg" onclick="utilizarDatos('adultos1')">
                        <img src="../vista/Assets/Img/thumbnails/AdultoExtra.jpg" class="img-fluid rounded-circle">
                    </div>
                    <div class="display-6 mt-2">Adulto 1</div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3 p-5">
                    <div class="card rounded-circle border-danger shadow-lg" onclick="utilizarDatos('adultos2')">
                        <img src="../vista/Assets/Img/thumbnails/adulto 2 menos 40.jpg" class="img-fluid rounded-circle">
                    </div>
                    <div class="display-6 mt-2">Adulto 2</div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="col-md-3 p-5">
                    <div class="card rounded-circle border-danger shadow-lg" onclick="utilizarDatos('senior1')">
                        <img src="../vista/Assets/Img/thumbnails/senior 1 menos 50.jpg" class="img-fluid rounded-circle">
                    </div>
                    <div class="display-6 mt-2">Senior 1</div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="col-md-3 p-5">
                    <div class="card rounded-circle border-danger shadow-lg" onclick="utilizarDatos('senior2')">
                        <img src="../vista/Assets/Img/thumbnails/senior 2 menos 60.jpg" class="img-fluid rounded-circle">
                    </div>
                    <div class="display-6 mt-2">Senior 2</div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="col-md-3 p-5">
                    <div class="card rounded-circle border-danger shadow-lg" onclick="utilizarDatos('master1')">
                        <img src="../vista/Assets/Img/thumbnails/master 1  menos 65.jpg" class="img-fluid rounded-circle">
                    </div>
                    <div class="display-6 mt-2 ">Master 1</div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="col-md-3 p-5">
                    <div class="card rounded-circle border-danger shadow-lg" onclick="utilizarDatos('master2')">
                        <img src="../vista/Assets/Img/thumbnails/master 2 mayor 65.jpg" class="img-fluid rounded-circle">
                    </div>
                    <div class="display-6 mt-2">Master 2</div>
                </div>
            </div>



            <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>

<div class="text-center mt-3 mb-0 row">
    
        <div class="col-12 my-2">
            <?php include_once('tab.php') ?>
        </div>
    
</div>


<?php include_once('../vista/common/footer.php') ?>