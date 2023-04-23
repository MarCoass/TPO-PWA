<?php include_once('./estructura/header.php') ?>
<div class="row p-3 text-light bg-seccion2">
    <div class="text-center">
        <span class="display-5">Imágenes Random</span>
    </div>
</div>

<div class="row my-3 d-flex justify-content-center align-items-center" id="contenedorImagenes">
    <!--
        <div class="col-4">
            <figure class="figure">
                <img src="..." class="figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption text-end">
                    <a href='#' class='text-decoration-none text-secondary' data-bs-toggle='modal' data-bs-target='#modalImagen'>A caption for the above image.</a>
                </figcaption>
            </figure>
        </div>
    -->
</div>

<div class="modal fade" id="modalImagen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información de la Imagen <span class="text-uppercase" id="nombreRandom"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>ID del Albúm: <span id="idAlbumImagen"></span></p>
                <p>ID de la Imagen: <span id="idImagen"></span></p>
                <p>Título: <span id="tituloImagen"></span></p>
                <p>Thumbnail URL: <span id="thumbUrlImagen"></span></p>
                <p>URL: <span id="urlImagen"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar Modal</button>
            </div>
        </div>
    </div>
</div>


<script src="../util/js/imagenes.js"></script>
<?php include_once('./estructura/footer.php') ?>