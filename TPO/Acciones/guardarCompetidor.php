<?php
include_once "../configuracion.php";
$data = data_submitted();
print_r($data);
$objCompetidor = new C_Competidor();
//echo json_encode($objCompetidor->alta($data));
?>