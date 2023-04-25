fetch ("http://localhost/vista/Acciones/listar.php")
  .then (response => response.json ()) // Convertir la respuesta a json
  .then (data => { // Obtener el json como un objeto de JavaScript
    console.log (data); // Mostrar el objeto en la consola
    // Aquí puedes asignar el objeto a una variable o manipularlo como quieras
    let miVariable = data; // Asignar el objeto a una variable llamada miVariable
    console.log (miVariable); // Mostrar la variable en la consola
  })
  .catch (error => { // Manejar los posibles errores
    console.error (error); // Mostrar el error en la consola
  });