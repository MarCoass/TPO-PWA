<?php include_once('common/header.php') ?>
<div class="bg-success row p-3" style="--bs-bg-opacity: .25;">
    nav trucho
</div>
<div class="bg-success row p-3" style="--bs-bg-opacity: .5;">
    Poomsae reconocido individual elite
</div>

<main class="bg-dark">
    <div class="row m-3">
        <div id="carouselExampleCaptions"  data-bs-ride="carousel" class="carousel carousel-fade  mx-auto col-lg-5 col-sm-12 mb-3">
            <div class="carousel-indicators mb-0">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner nav "><!-- CONTENEDOR PADRE DEBE TENER CLASE NAV -->
                <div class="carousel-item active " data-bs-interval="2000">
                    <div class="d-flex justify-content-center">
                        <div class="nav-link" data-bs-toggle="tab" data-bs-target="#home-tab-pane">
                            <img src="./Assets/Img/1.png" class="d-block" alt="..." height="100px" />
                        </div>
                    </div>

                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <div class="d-flex justify-content-center">
                        <div class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-tab-pane">
                            <img src="./Assets/Img/2.jpg" class="d-block" alt="..." height="100px" />
                        </div>
                    </div>

                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <div class="d-flex justify-content-center">
                        <div class="nav-link" data-bs-toggle="tab" data-bs-target="#categoria3">
                        <img src="./Assets/Img/queespumse2.jpg" class="d-block" alt="..." height="100px" />
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
            <div class="tab-content">

                <div class="tab-pane fade" id="home-tab-pane">
                    <div class="row">
                        <div class="col-lg-8 col-sm-4 bg-warning border-1 border-dark p-3">
                            Informacion cateogria 1
                        </div>
                        <div class="col-lg-4 col-sm-8 bg-success p-3" style="--bs-bg-opacity: .50;">
                            <img src="Assets/Img/1.png" alt="" class="img-fluid" id="imagenExpandida">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-sm-8 bg-primary p-3" style="--bs-bg-opacity: .75;" id="tabla">Tabla</div>
                        <div class="col-lg-4 col-sm-4 bg-primary p-3" id="parrafo">Parrafo</div>
                    </div>
                </div>



                <div class="tab-pane fade" id="profile-tab-pane">
                    <div class="row">
                        <div class="col-lg-8 col-sm-4 bg-warning border-1 border-dark p-3">
                            Informacion cateogria 2
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


                <div class="tab-pane fade" id="categoria3">

                    <div class="row">
                        <div class="col-lg-8 col-sm-4 bg-success border-1 border-dark p-3">
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






<div class="bg-success row p-3" style="--bs-bg-opacity: .25;">
    Grupo 2
</div>
<script src="Assets/Js/script.js"></script>
<?php include_once('common/footer.php') ?>