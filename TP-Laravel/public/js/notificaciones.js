// obtiene los elementos del icono y del número de notificaciones
let icono = document.querySelector(".bi-bell");
let notiCantidad = document.getElementById("notiCantidad");

// define una función para verificar el contenido de notiCantidad y cambiar el display del icono
function checkNotiCantidad() {
    // si hay un número en notiCantidad, muestra el icono
    if (notiCantidad != null && notiCantidad.textContent > 0) {
        icono.style.color = "gold";
    } else {
        // si no hay un número en notiCantidad, oculta el icono
        icono.style.color = "black";
    }
}

// llama a la función checkNotiCantidad cada 3 segundos usando setInterval
setInterval(checkNotiCantidad, 3000);

