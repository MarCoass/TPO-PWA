<?php
include_once "../../configuracion.php";
/* listarPais.php se convierte en un estilo de json el cual se puede consumir con fetch para usarlo en un array en javascript */
$objPais = new C_Pais();
echo json_encode($objPais->buscar(null));
