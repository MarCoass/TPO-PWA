<?php include_once('common/header.php') ?>
<div class="row p-3 justify-content-center ">
    <div class="col-12 justify-content-center">
        <img src="Assets/Img/World_Taekwondo.png" alt="" width="100px" />
        <span class="fs-2 ">Poomsae Reconocido</span>
    </div>
</div>

<div class="row p-3 text-bg-danger">
    <div class="fs-2">
        Individual Elite
    </div>

</div>



<div class="text-center my-3">
    <div class="row justify-content-center">
        <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" role="listbox">

                <div class="carousel-item active">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img button">
                                <img src="../vista/Assets/Img/thumbnails/infantiles a.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay">Infantiles A</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/infantiles b.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay">Infantiles B</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/cadete 12-14.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay">Cadete</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/juveniles 15-17.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay">Juveniles</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/adulto 1 menos 30.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay">Adulto 1</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/adulto 2 menos 40.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay">Adulto 2</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/senior 1 menos 50.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay">Senior 1</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/senior 2 menos 60.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay">Senior 2</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/master 1  menos 65.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay">Master 1</div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <img src="../vista/Assets/Img/thumbnails/master 2 mayor 65.jpg" class="img-fluid rounded-circle p-5">
                            </div>
                            <div class="card-img-overlay">Master 2</div>
                        </div>
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


<hr>
<hr>






    <div class="row">
        <div class="col-12 my-5">
            <div class="tab-content fs-5">

                <div class="tab-pane fade" id="infantilB">
                    <?php include_once('tabInfantilesB.php') ?>
                </div>



                <div class="tab-pane fade" id="infantilA">
                    <div class="row">
                        <div class="col-lg-8 col-sm-4 bg-warning border-1 border-dark p-3">
                            Informacion categoria 2
                        </div>
                        <div class="col-lg-4 col-sm-8 bg-success p-3" style="--bs-bg-opacity: .50;">
                            <img src="Assets/Img/2.jpg" alt="" class="img-fluid" id="imagenExpandida">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-sm-8 bg-primary p-3" style="--bs-bg-opacity: .75;" id="tabla">Tabla</div>
                        <div class="col-lg-4 col-sm-4 bg-primary p-3" id="parrafo">Parrafo</div>
                    </div>
                </div>


                <div class="tab-pane fade" id="cadete">
                    <div class="row">
                        <div class="col-lg-8 col-sm-4 bg-success p-3">
                            Informacion categoria 3
                        </div>
                        <div class="col-lg-4 col-sm-8 bg-success p-3" style="--bs-bg-opacity: .50;">
                            <img src="Assets/Img/queespumse2.jpg" alt="" class="img-fluid" id="imagenExpandida">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-sm-8 bg-primary p-3" style="--bs-bg-opacity: .75;" id="tabla">Tabla</div>
                        <div class="col-lg-4 col-sm-4 bg-primary p-3" id="parrafo">Parrafo</div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</main>




<?php include_once('common/footer.php') ?>