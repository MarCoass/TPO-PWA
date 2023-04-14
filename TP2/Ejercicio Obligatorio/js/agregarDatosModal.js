function cargarDatos(json){
    obj = JSON.parse(json);
    var texto = "Legajo: " + obj.legajo +
    "<br>Apellido: " + obj.apellido +
    "<br>Nombre: "+ obj.nombre + 
    "<br>DNI: " + obj.dni + 
    "<br>Mail: " + obj.email +
    "<br>Pais: " + obj.paisOrigen +
    "<br>Genero: " + obj.genero + 
    "<br>Graduacion: " + obj.graduacion + 
    "<br>Ranking: " + obj.rankingNacional ;
    $("#cuerpoModal").html(texto);
}