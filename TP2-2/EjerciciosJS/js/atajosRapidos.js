/* código que agrega una escucha de eventos al documento, este detecta cuando se presiona una tecla 
y verifica si la tecla presionada es “m” y si la tecla Alt está presionada al mismo tiempo. 
Si ambas condiciones son verdaderas, se simulará un clic */
document.addEventListener('keyup', function (event) {
    if (event.altKey && event.key === 'm') {
        document.getElementById('menuNavBar').click();
    }
});

/* Código que toma el pathname y lo convierte en string para luego tomar el nombre del archivo.php */
var title = String(window.location.pathname)
var seccion = title.slice(title.lastIndexOf("/") + 1, title.lastIndexOf("."));
/* Itera las 4 secciones y le aplica la clase active al link de la pagina actual */
for (var i = 1; i < 5; i++) {
    var activo = document.getElementById("seccion" + i)
    if (activo.id === seccion) {
        activo.classList.add("active");
    }
}