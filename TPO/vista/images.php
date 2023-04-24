<?php include_once('./estructura/header.php') ?>
<div class="row p-3 text-light bg-seccion2">
    <div class="text-center">
        <span class="display-5">Imágenes Random</span>
    </div>
</div>

<div class="row my-3 d-flex justify-content-center d-none" id="contenedorImagenes">
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

<!-- IMAGENES FAKE -->
<div class="row ms-5 my-3 d-flex justify-content-center" id="contenedorImagenesFake">
    <div class="col-4">
        <figure class="figure">
            <svg class="bd-placeholder-img rounded" width="280" height="280" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#868e96"></rect>
            </svg>
            <figcaption class="figure-caption text-end ">
                <a href='#' class=' placeholder-glow text-decoration-none text-secondary' data-bs-toggle='modal' data-bs-target='#modalImagen'>
                    <p class="placeholder-glow">
                        <span class="placeholder col-12"></span>
                    </p>
                </a>
            </figcaption>
        </figure>
    </div>
    <div class="col-4">
        <figure class="figure">
            <svg class="bd-placeholder-img rounded" width="280" height="280" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#868e96"></rect>
            </svg>
            <figcaption class="figure-caption text-end">
                <a href='#' class=' placeholder-glow text-decoration-none text-secondary' data-bs-toggle='modal' data-bs-target='#modalImagen'>
                    <p class="placeholder-glow">
                        <span class="placeholder col-12"></span>
                    </p>
                </a>
            </figcaption>
        </figure>
    </div>
    <div class="col-4">
        <figure class="figure">
            <svg class="bd-placeholder-img rounded" width="280" height="280" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#868e96"></rect>
            </svg>
            <figcaption class="figure-caption text-end">
                <a href='#' class=' placeholder-glow text-decoration-none text-secondary' data-bs-toggle='modal' data-bs-target='#modalImagen'>
                    <p class="placeholder-glow">
                        <span class="placeholder col-12"></span>
                    </p>
                </a>
            </figcaption>
        </figure>
    </div>
    <div class="col-4">
        <figure class="figure">
            <svg class="bd-placeholder-img rounded" width="280" height="280" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#868e96"></rect>
            </svg>
            <figcaption class="figure-caption text-end">
                <a href='#' class=' placeholder-glow text-decoration-none text-secondary' data-bs-toggle='modal' data-bs-target='#modalImagen'>
                    <p class="placeholder-glow">
                        <span class="placeholder col-12"></span>
                    </p>
                </a>
            </figcaption>
        </figure>
    </div>
    <div class="col-4">
        <figure class="figure">
            <svg class="bd-placeholder-img rounded" width="280" height="280" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#868e96"></rect>
            </svg>
            <figcaption class="figure-caption text-end">
                <a href='#' class=' placeholder-glow text-decoration-none text-secondary' data-bs-toggle='modal' data-bs-target='#modalImagen'>
                    <p class="placeholder-glow">
                        <span class="placeholder col-12"></span>
                    </p>
                </a>
            </figcaption>
        </figure>
    </div>
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