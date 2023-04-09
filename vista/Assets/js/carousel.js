window.addEventListener("load", () => {
  utilizarDatosCarousel();
});

async function cargarItems() {
  try {
    const response = await fetch('./Assets/json/items_carousel.json');
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(error);
  }
}

async function utilizarDatosCarousel() {
  const items = await cargarItems();
  //console.table(items);

  armarCarousel(items.items);
}

/* Recibe por parámetro el arreglo de participantes y una palabra clave que diferencia el id de las tablas para saber a cuál insertar el contenido, previamente
vacia la tabla correspondiente para que no se acumule la información */
function armarCarousel(arreglo) {
  let itemsCarousel = "";

  verificador = true;

  arreglo.forEach(item => {
    if (verificador) {
      itemsCarousel += "<div class='carousel-item active'>";
      verificador = false;
    } else {
      itemsCarousel += "<div class='carousel-item'>";
    }
    itemsCarousel += "<div class='col-md-3 p-5'>";
    itemsCarousel += "<div class='card rounded-circle border-danger shadow-lg' onclick='utilizarDatos(\"" + item.funcion + "\")'>";
    itemsCarousel += "<img src='../vista/Assets/Img/thumbnails/" + item.imagen + "' class='img-fluid rounded-circle'>";
    itemsCarousel += "</div>";
    itemsCarousel += "<div class='display-6 mt-2'>" + item.nombre + "</div>";
    itemsCarousel += "</div></div>";
  });

  $("#carouselCategorias").prepend(itemsCarousel); // ANIDAMOS LOS ITEMS AL CAROUSEL

  moverCarousel();
}

function moverCarousel() {

  /* Funcion que usa el método querySelectorAll para obtener una lista de todos los elementos 
  con la clase .carousel-item dentro del elemento .carousel. */
  let items = document.querySelectorAll(".carousel .carousel-item");

  /*  Luego, está iterando sobre cada elemento de la lista y clonando algunos de sus elementos 
  hermanos para agregarlos al final del elemento actual. Esto es para crear un efecto de carrusel 
  con varios elementos por diapositiva. El número de elementos por diapositiva se determina 
  por la variable minPerSlide */
  items.forEach((el) => {
    const minPerSlide = 12;
    let next = el.nextElementSibling;
    for (var i = 1; i < minPerSlide; i++) {
      if (!next) {
        // wrap carousel by using first child
        next = items[0];
      }
      let cloneChild = next.cloneNode(true);
      el.appendChild(cloneChild.children[0]);
      next = next.nextElementSibling;
    }
  });

}