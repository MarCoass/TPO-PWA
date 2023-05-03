<?php
include_once "../../configuracion.php";
/* listarPais.php retorna un arreglo de todos los países de la BD */
$objPais = new C_Pais();
echo json_encode($objPais->buscar(null));
