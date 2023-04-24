<?php
  // Obtenemos los datos enviados por la función $.ajax()
  $datosJSON = $_POST['datos'];

  // Convertimos los datos JSON a formato PHP
  $datos = json_decode($datosJSON);

  // Guardamos los datos en el archivo competidores.json
  file_put_contents('../util/json/competidoresGuardados.json', json_encode($datos));

  // Devolvemos una respuesta para indicar que todo ha salido bien
  echo "Datos guardados correctamente";
?>
