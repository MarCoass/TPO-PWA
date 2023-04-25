<?php

include_once "../../configuracion.php";

$objCompetidor = new C_Estado();

echo json_encode($objCompetidor->buscar("true"));




?>
