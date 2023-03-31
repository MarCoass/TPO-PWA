<?php header('Content-Type: text/html; charset=utf-8');
header ("Cache-Control: no-cache, must-revalidate ");

/////////////////////////////
// CONFIGURACION APP//
/////////////////////////////

$PROYECTO ='TPO-PWA';

//variable que almacena el directorio del proyecto
$ROOT =$_SERVER['DOCUMENT_ROOT']."/$PROYECTO/";

include_once($ROOT.'util/funciones.php');

// Variable que define la pagina de autenticacion del proyecto
//$INICIO = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/vista/Login.php";

// variable que define la pagina principal del proyecto (menu principal)
$PRINCIPAL = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/vista/index.php";


$GLOBALS['ROOT']=$ROOT;

?>

<script>
  var  base_url = "http://<?php echo $_SERVER['HTTP_HOST'] ?>/<?php echo $PROYECTO ?>/"
</script>