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

        <label for="du">DNI:</label>
        <input type="number" id="edad" name="edad"><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad"><br><br>
        
        <label for="paisOrigen">País:</label>
        <input type="text" id="paisOrigen" name="paisOrigen"><br><br>
        
        <label for="genero">Género:</label>
        <select id="genero" name="genero">
            <option value="">Selecciona una opción</option>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="otro">Otro</option>
        </select><br><br>

        <label for="graduacion">Graduacion:</label>
        <select id="graduacion" name="graduacion">
        </select><br><br>

        <label for="rankingNacional">Ranking:</label>
        <input type="number" id="rankingNacional" name="rankingNacional"><br><br>

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
            // Leer datos del archivo JSON
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var myObj = JSON.parse(this.responseText);
                    // Crear selector en el DOM
                    var x = document.getElementById("graduacion");
                    for (var i = 0; i < myObj.length; i++) {
                        var option = document.createElement("option");
                        option.text = myObj[i].graduacion;
                        x.add(option);
                    }
                }
            };
            xmlhttp.open("GET", "graduaciones.json", true);
            xmlhttp.send();
            
            

        </script>

        <hr>





</form>
</body>
</html>
