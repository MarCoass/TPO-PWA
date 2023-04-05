/* Funcion que usa el método querySelectorAll para obtener una lista de todos los elementos 
con la clase .carousel-item dentro del elemento .carousel. */
let items = document.querySelectorAll(".carousel .carousel-item");

/*  Luego, está iterando sobre cada elemento de la lista y clonando algunos de sus elementos 
hermanos para agregarlos al final del elemento actual. Esto es para crear un efecto de carrusel 
con varios elementos por diapositiva. El número de elementos por diapositiva se determina 
por la variable minPerSlide */
items.forEach((el) => {
  const minPerSlide = 10;
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

/* funcion que cambia el genero de la foto (y mas adelante cambiar la tabla) 
esta funcion necesita la variable val la cual es fem o masc,
y la variable cat representa la categoria y busca en la carpeta img la correspondiente */
function miFuncion(val, cat) {
  /* alert(val + " - " + cat) */
  var infoFem = document.getElementById("infoFem"+cat);
  var infoMasc = document.getElementById("infoMasc"+cat);
 
  if (val == "fem") {
    document.getElementById("imagen " + cat).src =
      "../vista/Assets/Img/img/" + cat + " f.jpg";
    
      if(infoFem.classList.contains('d-none')){
        infoFem.classList.remove("d-none");
        infoMasc.classList.add("d-none");
      } 
  }
  if (val == "masc") {
    document.getElementById("imagen " + cat).src =
      "../vista/Assets/Img/img/" + cat + " m.jpg";

      if(infoMasc.classList.contains('d-none')){
        infoMasc.classList.remove("d-none");
        infoFem.classList.add("d-none");
      } 
  }
}

