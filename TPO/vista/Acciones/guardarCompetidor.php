<?php
include_once "../../configuracion.php";
$data = data_submitted();
/* guardarCompetidor.php retorna true o false dependiendo de si la carga del Competidor fue exitosa */
$objCompetidor = new C_Competidor();
echo json_encode($objCompetidor->alta($data));
?>