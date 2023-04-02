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

<main class="">
    <div class="row text-bg-danger">
        <div id="carouselExampleCaptions" data-bs-ride="carousel" class="carousel carousel-fade  mx-auto col-lg-5 col-sm-12 mb-3">
            <div class="carousel-indicators mb-0">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner nav "><!-- CONTENEDOR PADRE DEBE TENER CLASE NAV -->
                <div class="carousel-item active " data-bs-interval="2000">
                    <div class="d-flex justify-content-center">
                        <div class="nav-link" data-bs-toggle="tab" data-bs-target="#infantilB">
                            <img src="./Assets/Img/thumbnails/infantiles b.jpg" class="rounded" alt="..." height="100px" />
                            <div class="pe-none carousel-caption">
                                <h5>Infantiles B</h5>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <div class="d-flex justify-content-center">
                        <div class="nav-link" data-bs-toggle="tab" data-bs-target="#infantilA">
                            <img src="./Assets/Img/thumbnails/infantiles a.jpg" class="d-block rounded" alt="..." height="100px" />
                            <div class="pe-none carousel-caption d-none d-md-block">
                                <h5>Infantiles A</h5>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <div class="d-flex justify-content-center">
                        <div class="nav-link" data-bs-toggle="tab" data-bs-target="#cadete">
                            <img src="./Assets/Img/thumbnails/cadete 12-14.jpg" class="d-block rounded" alt="..." height="100px" />
                        </div>
                    </div>

                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


    </div>
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



<script src="Assets/Js/script.js"></script>
<?php include_once('common/footer.php') ?>