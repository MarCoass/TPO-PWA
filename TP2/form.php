<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario simple basico</title>
</head>
<body>
    <form id="myForm">
        <label for="legajo">Legajo:</label>
        <input type="text" id="legajo" name="legajo"><br><br>
        
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido"><br><br>
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad"><br><br>
        
        <label for="pais">País:</label>
        <input type="text" id="pais" name="pais"><br><br>
        
        <label for="genero">Género:</label>
        <select id="genero" name="genero">
            <option value="">Selecciona una opción</option>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="otro">Otro</option>
        </select><br><br>

        <label for="ranking">Ranking:</label>
        <input type="number" id="ranking" name="ranking"><br><br>

        <input type="button" value="Enviar" onclick="convertirEnJSON()">

        <script>
            function convertirEnJSON() {
                var form = document.getElementById("myForm");
                var data = new FormData(form);
                var object = {};
                data.forEach(function(value, key){
                    object[key] = value;
                });
                var json = JSON.stringify(object);
                console.log(json);
            }
        </script>




</form>
</body>
</html>
