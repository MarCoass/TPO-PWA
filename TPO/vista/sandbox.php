<?php include_once('./estructura/header.php') ?>

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

<script src="../util/js/cargarPaisesForm.js"></script>

<?php include_once('./estructura/footer.php') ?>