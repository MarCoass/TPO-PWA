<?php
include_once "../../configuracion.php";

/* listarPais.php se convierte en un estilo de json el cual se puede consumir con fetch para usarlo en un array en javascript */

$objPais = new C_Pais();
/* busca todos los datos */
$json = $objPais->buscar("");
/* parsea a json */
$new = json_encode($json);
/* Imprime en la pagina */
echo $new;


?>
