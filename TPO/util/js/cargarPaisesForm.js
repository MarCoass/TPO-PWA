// declaro una variable en donde tendre alojado los paises 
let lista = []

const listaPaises = document.getElementById("paises")
const inputPaises = document.getElementById("paisOrigen")

window.addEventListener("DOMContentLoaded", function () {
    // Listando paises para mostrar
    fetch('https://flagcdn.com/es/codes.json')
        .then(response => response.json()) // Convertir la respuesta a un objeto JSON
        .then(data => {
            for (var nombre in data) {
                var valor = data[nombre]
                lista.push({pais: valor, nomenclatura: nombre })
            }

        })
        .catch(error => {
            // Manejar el error si ocurre
            console.error(error);
        });
})

inputPaises.addEventListener('keyup', function(){
    borrarLi(listaPaises)
        // Obtener el valor del input
        let valor = this.value;
        // Filtrar el array lista según el valor
        let filtrado = lista.filter(item => {
          // Convertir el valor y el nombre del país a minúsculas para compararlos
          return item.pais.toLowerCase().includes(valor.toLowerCase());
        });
        // Renderizar las etiquetas li con el array filtrado
    
    renderLi(listaPaises,filtrado)
})

// funcion que renderiza las li
function renderLi(dom,lista){
    // Recorrer el array lista y crear los elementos li
    for (let item of lista) {
      // Crear un nuevo elemento li
      let li = document.createElement("li");
      // Crear el link falso
      let a = document.createElement("a");
      let img = document.createElement("img")
      // Agregar bandera
      img.src = "https://flagcdn.com/" + `${item.nomenclatura}` + ".svg"
      img.width = "27"
      // Asignar el texto usando la propiedad innerHTML
      a.innerHTML = `${item.pais}`;
      // Agregar el elemento a sus papis
      li.appendChild(img)
      li.appendChild(a)
      dom.appendChild(li);
    }
}

// Función que borra las listas generadas
function borrarLi(dom) {
    // Obtener todos los elementos li dentro del dom
    let items = dom.querySelectorAll("li");
    // Recorrer los elementos li y eliminarlos del dom
    for (let item of items) {
      dom.removeChild(item);
    }
  }
