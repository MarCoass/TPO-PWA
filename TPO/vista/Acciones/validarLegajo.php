<?php
include_once "../../configuracion.php";
$data = data_submitted();
/* listarCompetidor.php se convierte en un estilo de json el cual se puede consumir con fetch para usarlo en un array en javascript */
$objCompetidor = new C_Competidor();
echo json_encode($objCompetidor->validarLegajo($data));
