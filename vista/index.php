<?php include_once('../vista/common/header.php') ?>
<div class="row p-3 justify-content-center ">
    <div class="col-12 justify-content-center">
        <img src="Assets/Img/World_Taekwondo.png" alt="" width="100px" />
        <span class="fs-2 ">Poomsae Reconocido</span>
    </div>
</div>

<div class="row p-3 text-bg-danger">
    <div class="fs-5">
    El Poomsae Reconocido Elite Individual es una categoría de competición de taekwondo en la que los participantes deben ejecutar una serie de movimientos complejos y técnicamente avanzados de forma individual. Esta categoría está destinada a competidores altamente experimentados y habilidosos.
    </div>
</div>



<div class="text-center my-3">
    <div class="row justify-content-center">
        <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner nav" role="listbox">

                <div class="carousel-item active">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/infantiles a.jpg" class="img-fluid rounded-circle p-5" >
                            </div>
                            <div class="card-img-overlay" data-bs-toggle="tab" data-bs-target="#infantilA">Infantiles A</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/infantiles b.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay" data-bs-toggle="tab" data-bs-target="#infantilB">Infantiles B</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/cadete 12-14.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay" data-bs-toggle="tab" data-bs-target="#cadete">Cadete</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/juveniles 15-17.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay" data-bs-toggle="tab" data-bs-target="#infantilB">Juveniles</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/adulto 1 menos 30.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay" data-bs-toggle="tab" data-bs-target="#infantilA">Adulto 1</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/adulto 2 menos 40.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay" data-bs-toggle="tab" data-bs-target="#infantilB">Adulto 2</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/senior 1 menos 50.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay" data-bs-toggle="tab" data-bs-target="#infantilA">Senior 1</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/senior 2 menos 60.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay" data-bs-toggle="tab" data-bs-target="#infantilB">Senior 2</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/master 1  menos 65.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay" data-bs-toggle="tab" data-bs-target="#infantilA">Master 1</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/master 2 mayor 65.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay" data-bs-toggle="tab" data-bs-target="#infantilB">Master 2</div>
                        </div>
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

    <div class="row">
        <div class="col-12 my-5">
            <div class="tab-content fs-5">

                <div class="tab-pane fade" id="infantilB">
                    <?php include_once('tabInfantilesB.php') ?>
                </div>

                <div class="tab-pane fade" id="infantilA">
                    <?php include_once('tabInfantilesA.php') ?>
                </div>

                <div class="tab-pane fade" id="cadete">
                    <?php include_once('tabcadetes.php') ?>
                </div>


                
            </div>

        </div>
    </div>

</main>


<?php include_once('../vista/common/footer.php') ?>