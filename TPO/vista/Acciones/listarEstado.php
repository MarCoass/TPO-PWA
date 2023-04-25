<?php
include_once "../../configuracion.php";

/* listarEstado.php se convierte en un estilo de json el cual se puede consumir con fetch para usarlo en un array en javascript */

$objEstado = new C_Estado();
/* busca todos los datos */
$json = $objEstado->buscar("");
/* parsea a json */
$new = json_encode($json);
/* Imprime en la pagina */
echo $new;


?>
