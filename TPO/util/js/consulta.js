
let listaBD = [];


fetch ("http://localhost/TPO-PWA/TPO/vista/Acciones/listarPais.php")
  .then (response => response.json ()) // Convertir la respuesta a json
  .then (data => { // Obtener el json como un objeto de JavaScript
    console.log (data); // Mostrar el objeto en la consola
    listaBD = data;
  })
  .catch (error => { // Manejar los posibles errores
    console.error (error); // Mostrar el error en la consola
  });