<?php
include_once "../../configuracion.php";
/* listarCompetidor.php retorna un arreglo de todos los competidores habidos por haber de la BD */
$objCompetidor = new C_Competidor();
echo json_encode($objCompetidor->listarCompetidores());

?>
