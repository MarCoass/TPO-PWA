<?php
include_once "../../configuracion.php";

/* listarCompetidor.php se convierte en un estilo de json el cual se puede consumir con fetch para usarlo en un array en javascript */

$objCompetidor = new C_Competidor();
/* busca todos los datos */
$json = $objCompetidor->buscar("");
/* parsea a json */
$new = json_encode($json);
/* Imprime en la pagina */
echo $new;


?>
