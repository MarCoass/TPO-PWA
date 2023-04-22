<?php include_once('./estructura/header.php') ?>
<div class="row p-3 text-light bg-seccion2">
    <div class="text-center">
        <span class="display-5">Poomsae Reconocido Elite Individual</span>
        <p class="lead">es una categoría de competición de taekwondo en la que los participantes deben ejecutar una serie de movimientos complejos y técnicamente avanzados de forma individual.</p>
        <p class="lead">Esta categoría está destinada a competidores altamente experimentados y habilidosos.</p>
    </div>
</div>

<div class="row justify-content-center text-center bg-carru">
    <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner" role="listbox" id="carouselCategorias">
            <!-- EL JS LISTA LOS ITEMS AQUÍ-->
        </div>
        <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>
</div>

<div class="text-center mt-3 mb-0 row">

    <div class="col-12 my-2">
        <?php include_once('./tab.php') ?>
    </div>

</div>


<?php include_once('./estructura/footer.php') ?>