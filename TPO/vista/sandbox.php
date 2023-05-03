<?php   include_once('./estructura/header.php')  ?>

<style>
#paises {
    position: absolute;
    height: 300px;
    width: 20em;
}

#paises li {
    list-style: none;
}

#paises a {
    text-decoration: none;
}



</style>

<form class="row justify-content-center" action="">
    <div class="col-6">
        <input class="form-control" type="text" name="paisOrigen" id="paisOrigen" list>
        <div>
            <ul id="paises" class="overflow-auto bg-secondary">
    
            </ul>
        </div>

    </div>
</form>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalResultadoCarga">
  Launch demo modal
</button>

<!-- MODAL -->
<div class="modal fade" id="modalResultadoCarga" tabindex="-1" aria-labelledby="modalResultadoCarga" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-success" id="modalTitulo">Competidor cargado</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="cuerpoModal">
                El competidor fue cargado correctamente.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="location.reload()">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL -->
<!-- <script src="../util/js/cargarPaisesForm.js"></script> -->
<script src="../util/js/consulta.js"></script>
<script>
     $('#modalResultadoCarga').modal('show')
</script>
<?php include_once('./estructura/footer.php')  ?>