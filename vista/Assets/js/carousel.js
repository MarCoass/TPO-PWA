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

