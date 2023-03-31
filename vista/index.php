<?php include_once('common/header.php') ?>
<div class="bg-success row p-3" style="--bs-bg-opacity: .25;">
    Encabezado
</div>
<div class="bg-success row p-3" style="--bs-bg-opacity: .5;">
    Fila (col-lg-12)
</div>
<div class="bg-success row p-3">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav0-tab" data-bs-toggle="tab" data-bs-target="#nav0" type="button" role="tab" aria-controls="nav0" aria-selected="true">
                <img src="Assets/Img/queespumse2.jpg" alt="" style="width: 100px;">
                Categoria 0
            </button>
            <button class="nav-link" id="nav1-tab" data-bs-toggle="tab" data-bs-target="#nav1" type="button" role="tab" aria-controls="nav1" aria-selected="false">
                <img src="Assets/Img/queespumse2.jpg" alt="" style="width: 100px;">
                Categoria 1
            </button>
        </div>
    </nav>
</div>


<div class="tab-content row" id="nav-tabContent">
    <div class="tab-pane fade show active " id="nav0" role="tabpanel" aria-labelledby="nav0-tab" tabindex="0">
        <div class="row">
            <div class="col-lg-8 col-sm-4 bg-primary p-3" style="--bs-bg-opacity: .25;">Informacion 0</div>
            <div class="col-lg-4 col-sm-8 bg-primary p-3" style="--bs-bg-opacity: .50;">Imagen expandida 0</div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-sm-8 bg-primary p-3" style="--bs-bg-opacity: .75;">Tabla 0</div>
            <div class="col-lg-4 col-sm-4 bg-primary p-3">Parrafo 0</div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav1" role="tabpanel" aria-labelledby="nav1-tab" tabindex="0">
        <div class="row">
            <div class="col-lg-8 col-sm-4 bg-primary p-3" style="--bs-bg-opacity: .25;">Informacion 1</div>
            <div class="col-lg-4 col-sm-8 bg-primary p-3" style="--bs-bg-opacity: .50;">Imagen expandida 1</div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-sm-8 bg-primary p-3" style="--bs-bg-opacity: .75;">Tabla 1</div>
            <div class="col-lg-4 col-sm-4 bg-primary p-3">Parrafo 1</div>
        </div>
    </div>



</div>


<div class="bg-success row p-3" style="--bs-bg-opacity: .25;">
    Footer
</div>
<?php include_once('common/footer.php') ?>