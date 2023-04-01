<?php include_once('common/header.php') ?>

<div class="bg-success row p-3" style="--bs-bg-opacity: .25;">
    nav trucho
</div>
<div class="bg-success row p-3" style="--bs-bg-opacity: .5;">
    Poomsae reconocido individual elite
</div>

<main class="bg-dark">
    <div class="row m-3">
        <div id="carouselExampleCaptions" data-bs-ride="carousel" class="carousel carousel-fade  mx-auto col-lg-5 col-sm-12 mb-3">
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
                        <div class="col-lg-8 col-sm-4 bg-warning p-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eu purus et est viverra imperdiet eu et quam. Donec et erat vehicula, euismod tortor nec, consequat urna. Duis commodo scelerisque magna eget tempor. Nulla iaculis sagittis pulvinar. Fusce molestie nec neque sit amet volutpat. Donec porta non erat quis elementum. Integer scelerisque ante leo, sed ornare turpis facilisis vitae. Praesent in tellus massa. In non metus tincidunt neque aliquam aliquet at sed urna.

                            Pellentesque eleifend id diam in dictum. Etiam non ante non ligula pellentesque efficitur vel sed est. Aliquam at augue in leo scelerisque dictum sit amet ac leo. Morbi ac ante eros. Quisque ornare purus at mollis viverra. Nulla suscipit elementum sem non iaculis. Suspendisse volutpat augue sed sapien ullamcorper, nec faucibus nibh condimentum. Praesent ante velit, sollicitudin a est ut, porttitor finibus quam. Sed gravida sollicitudin tristique. Nunc euismod dolor odio, a mattis velit viverra eu.
                        </div>
                        <div class="col-lg-4 col-sm-8 bg-success p-3" style="--bs-bg-opacity: .50;">
                            <img src="Assets/Img/1.png" alt="" class="img-fluid" id="imagenExpandida">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-sm-8 bg-primary p-3" style="--bs-bg-opacity: .75;" id="tabla">
                            <table class="table text-center m-auto bg-light rounded" style="width: 650px;">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <div class="">N°</div>
                                        </th>
                                        <th scope="col">
                                            <div class="">Lugar</div>
                                        </th>
                                        <th scope="col">
                                            <div class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                                </svg> Nombre</div>
                                        </th>
                                        <th scope="col">
                                            <div class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                                </svg> Puntaje</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                        <th scope="row">183</th>
                                        <th>Neuquén</th>
                                        <td>Julián Serrano</td>
                                        <th>5,13</th>
                                        <th class="position-relative"><span class="position-absolute top-50 start-75 translate-middle badge bg-danger">1° Lugar</span></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">342</th>
                                        <th>Tucumán</th>
                                        <td>Joaquín Pelusso</td>
                                        <th>4,89</th>
                                        <th class="position-relative"><span class="position-absolute top-50 start-75 translate-middle badge bg-danger">2° Lugar</span></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">57</th>
                                        <th>Formosa</th>
                                        <td>Pepe Argento</td>
                                        <th>4,5</th>
                                        <th class="position-relative"><span class="position-absolute top-50 start-75 translate-middle badge bg-danger">3° Lugar</span></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">129</th>
                                        <th>Jujuy</th>
                                        <td>Cristóbal Belmar Careau</td>
                                        <th>4,17</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-4 col-sm-4 bg-primary p-3" id="parrafo">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin velit tellus, euismod a dapibus nec, pellentesque vitae arcu. Nunc id mi ac justo venenatis congue. Donec nec ligula lectus. Nulla facilisi. Aenean tempor eros sit amet metus molestie mollis. Suspendisse potenti. Nunc at lacinia nibh.</div>
                    </div>
                </div>



                <div class="tab-pane fade" id="profile-tab-pane">
                    <div class="row">
                        <div class="col-lg-8 col-sm-4 bg-warning p-3">
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






<div class="bg-success row p-3" style="--bs-bg-opacity: .25;">
    Grupo 2
</div>
<script src="Assets/Js/script.js"></script>
<?php include_once('common/footer.php') ?>