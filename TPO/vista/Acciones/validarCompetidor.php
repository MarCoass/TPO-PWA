<?php
include_once "../../configuracion.php";
$data = data_submitted();
/* validarCompetidor.php recibe un DU o Legajo el cual debe verificarse que no haya coincidencias en la BD, retornará true en caso de encontrar una */
$objCompetidor = new C_Competidor();
echo json_encode($objCompetidor->validarCompetidor($data));
