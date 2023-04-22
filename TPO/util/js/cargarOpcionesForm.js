document.addEventListener("DOMContentLoaded", function () {
  // Obtener referencia al select
  const selectGraduacion = document.getElementById("graduacion");
  const selectPaises = document.getElementById("paisOrigen");

  // Obtener datos del archivo JSON
  fetch("js/graduaciones.json")
    .then((response) => response.json())
    .then((data) => {
      // Iterar sobre los datos y crear opciones
      data.forEach((option) => {
        const optionElement = document.createElement("option");
        optionElement.value = option.graduacion;
        optionElement.textContent = option.graduacion;
        selectGraduacion.appendChild(optionElement);
      });
    })
    .catch((error) => console.error(error));

  // Obtener datos del archivo JSON
  fetch("js/paises.json")
    .then((response) => response.json())
    .then((data) => {
      // Iterar sobre los datos y crear opciones
      data.forEach((option) => {
        const optionElement = document.createElement("option");
        optionElement.value = option.nombrePais;
        optionElement.textContent = option.nombrePais;
        selectPaises.appendChild(optionElement);
      });
    })
    .catch((error) => console.error(error));
});
