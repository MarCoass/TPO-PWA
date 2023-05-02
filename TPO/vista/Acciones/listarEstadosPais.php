<?php
include_once "../../configuracion.php";
$data = data_submitted();
/* listarEstado.php se convierte en un estilo de json el cual se puede consumir con fetch para usarlo en un array en javascript */
$objEstado = new C_Estado();
echo json_encode($objEstado->traerEstadosPorPais($data));

?>
