/* Recibe por parámetro cual género debe mostrar, se encarga de ocultar uno y mostrar el otro según corresponda, hace lo mismo con las imágenes*/
function btnCambioGen(val) {
  if (val === "fem") {
    if ($("#infoFem").hasClass('d-none')) {
      $("#infoFem").removeClass('d-none');
      $("#infoMasc").addClass('d-none');

      $("#imagenFem").removeClass('d-none');
      $("#imagenMasc").addClass('d-none');
    }
  }
  if (val === "masc") {
    if ($("#infoMasc").hasClass('d-none')) {
      $("#infoMasc").removeClass('d-none');
      $("#infoFem").addClass('d-none');

      $("#imagenMasc").removeClass('d-none');
      $("#imagenFem").addClass('d-none');
    }
  }
}

