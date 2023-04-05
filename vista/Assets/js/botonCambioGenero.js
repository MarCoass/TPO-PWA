/* funcion que cambia el genero de la foto (y mas adelante cambiar la tabla) 
esta funcion necesita la variable val la cual es fem o masc,
y la variable cat representa la categoria y busca en la carpeta img la correspondiente */
function btnCambioGen(val, cat) {
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

