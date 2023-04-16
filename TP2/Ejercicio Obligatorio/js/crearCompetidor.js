const formulario = document.getElementById("cargaParticipante");

/*formulario.addEventListener("submit", (event) => {
  event.preventDefault(); // Evita que el formulario se envíe de forma convencional

  const datos = new FormData(formulario); // Obtiene los datos del formulario

  // Crea un objeto json
  const datosJSON = {};

  // Itera sobre los datos y agrega cada par clave-valor al objeto JSON
  for (let [clave, valor] of datos.entries()) {
    datosJSON[clave] = valor;
  }

  var nuevoCompetidor = new Competidor(datosJSON);

});*/

function crearCompetidor() {
  const datos = new FormData(formulario); // Obtiene los datos del formulario
  // Crea un objeto json
  const datosJSON = {};

  // Itera sobre los datos y agrega cada par clave-valor al objeto JSON
  for (let [clave, valor] of datos.entries()) {
    datosJSON[clave] = valor;
  }

  var nuevoCompetidor = new Competidor(datosJSON);
}
