document.addEventListener("DOMContentLoaded", function () {
  // Obtener referencia al select
  const selectGraduacion = document.getElementById("graduacion");
  const selectPaises = document.getElementById("lipaises");
  let lista = [];

  // Obtener datos del archivo JSON
  fetch("../util/json/formulario/graduaciones.json")
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

  // Listando paises para mostrar
  fetch('https://flagcdn.com/es/codes.json')
    .then(response => response.json()) // Convertir la respuesta a un objeto JSON
    .then(data => {
      
      for (var nombre in data) {
        var valor = data[nombre]
        lista.push({ pais: valor, nomenclatura: nombre })
      }

      lista.forEach((list) => {
        
        const optionElement = document.createElement("option");
        optionElement.setAttribute("data-value",list.pais);
        optionElement.value = list.pais
        selectPaises.appendChild(optionElement);

      });
    })
    .catch(error => {
      // Manejar el error si ocurre
      console.error(error);
    })



});
