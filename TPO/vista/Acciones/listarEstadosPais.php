<?php
include_once "../../configuracion.php";
$data = data_submitted();
/* listarEstadoPais.php retorna un arreglo de estados filtrados por el idpais que recibe como parámetro */
$objEstado = new C_Estado();
echo json_encode($objEstado->traerEstadosPorPais($data));

?>
