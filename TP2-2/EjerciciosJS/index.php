<?php include_once('estructura/header.php')?>
<main role="main" class="container-fluid mb-5 masmb">


<div class="tab-content rounded transicion" id="myTabContent">
  <div class="tab-pane fade active show" id="seccion1-pane" role="tabpanel" aria-labelledby="seccion1-tab" tabindex="0">
  <?php include_once('seccion1.php')?>
  </div>
  <div class="tab-pane fade" id="seccion2-pane" role="tabpanel" aria-labelledby="seccion2-tab" tabindex="0">
  <?php include_once('seccion2.php')?>
  </div>
  <div class="tab-pane fade" id="seccion3-pane" role="tabpanel" aria-labelledby="seccion3-tab" tabindex="0">
  <?php include_once('seccion3.php')?>
  </div>
  <div class="tab-pane fade" id="seccion4-pane" role="tabpanel" aria-labelledby="seccion4-tab" tabindex="0">
  <?php include_once('seccion4.php')?>
  </div>
</div>

</main>

<?php include_once('estructura/footer.php')?>