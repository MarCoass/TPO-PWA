// obtiene los elementos del icono y del número de notificaciones
let icono = document.querySelector(".bi-bell");
let notiCantidad = document.getElementById("notiCantidad");

// define una función para verificar el contenido de notiCantidad y cambiar el display del icono
function checkNotiCantidad() {
    // si hay un número en notiCantidad, muestra el icono
    if (notiCantidad.textContent > 0) {
        icono.style.color = "gold";
    } else {
        // si no hay un número en notiCantidad, oculta el icono
        icono.style.color = "black";
    }
}

// llama a la función checkNotiCantidad cada 3 segundos usando setInterval
setInterval(checkNotiCantidad, 3000);


const idUsuarioActual = document.getElementById('idUsuarioActual').value;
let url = '/misSolicitudes/' + idUsuarioActual; // guarda la url en una variable
function obtenerDatos() {
    fetch(url) // usa la variable url
        .then(response => response.json()) // convierte la respuesta en un objeto JSON
        .then(data => {
            // usa los datos para actualizar la página
            // puedes usar un bucle for para crear una lista de elementos <li> con cada notificación
            let lista = "";
            let cantNotif = 0;
            for (let i = 0; i < data.length; i++) {
                if (data[i].estadoSolicitud === 3) {
                    cantNotif++;
                    let mensaje = generarMensaje("se actualizo ", "tu ", data[i]); // usa una función para generar el mensaje
                    lista += `<div class="d-flex p-2 btn btn-outline-success">
                                <i class="bi bi-hand-thumbs-up mt-4 h2 align-middle"></i>
                                <li class="rounded p-2">
                                <h6>${mensaje}</h6>
                                <button class="btn btn-outline-dark notiBoton" data-id=${data[i].idSolicitud}>
                                <i class="bi bi-eye-slash me-2"></i>Marcar como leído</button>
                                </li>
                                </div>`; // usa una plantilla literal para crear el elemento <li>
                }
                if (data[i].estadoSolicitud === 2) {
                    cantNotif++;
                    let mensaje = generarMensaje("Se rechazo tu solicitud de ", "cambiar de ", data[i]); // usa una función para generar el mensaje
                    lista += `<div class="d-flex p-2 btn btn-outline-danger">
                                <i class="bi bi-hand-thumbs-down mt-4 h2 align-middle"></i>
                                <li class="rounded p-2">
                                <h6>${mensaje}</h6>
                                <button class="btn btn-outline-dark notiBoton" data-id=${data[i].idSolicitud}>
                                <i class="bi bi-eye-slash me-2"></i>Marcar como leído</button>
                                </li>
                                </div>`; // usa una plantilla literal para crear el elemento <li>
                }

            }
            // por ejemplo, puedes usar el método innerHTML para cambiar el contenido de un elemento HTML
            document.getElementById("notiCantidad").innerHTML = cantNotif; // muestra el número de notificaciones
            // actualiza el elemento <ul> con la lista creada
            if (cantNotif == 0) {
                lista += `<li class="rounded p-2"><h6>No hay Notificaciones que mostrar</h6></li>`; // usa una plantilla literal para crear el elemento <li>
                document.getElementById("notiCantidad").innerHTML = ""; // muestra el número de notificaciones
            }
            document.querySelector(".dropdown-menu").innerHTML = lista;
            // obtiene todos los botones o enlaces con la clase leer
            let botones = document.querySelectorAll(".notiBoton");
            // recorre cada botón o enlace y le agrega un evento de clic
            botones.forEach(function (boton) {
                boton.addEventListener("click", function () {
                    //alert("tocaste boton")
                    // obtiene el id de la solicitud del atributo data-id
                    let id = boton.dataset.id;
                    // crea la url de la solicitud con el id
                    let url = "/solicitudLeida/" + id;
                    // envía la solicitud al servidor usando fetch
                    fetch(url, {
                        method: "POST", // usa el método POST para enviar los datos
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content, // envía el token CSRF para validar la solicitud
                        },
                    })
                        .then((response) => {
                            // verifica si la respuesta fue exitosa
                            if (response.ok) {
                                // haz algo con la respuesta, por ejemplo mostrar un mensaje o actualizar la página
                                //alert("Solicitud marcada como leída");
                                boton.remove(); // elimina el botón o enlace de la página
                                obtenerDatos();
                            } else {
                                // maneja los posibles errores
                                console.error(response.statusText);

                            }
                        })
                        .catch((error) => {
                            // maneja los posibles errores
                            console.error(error);
                        });
                });
            });
        })
        .catch(error => {
            // maneja los posibles errores
            console.error(error);
        });
}

/* se puede reciclar la funcion pero fiaca xd */
function generarMensaje(txt1, txt2, data) {
    let mensaje = txt1;
    if (data.escuela != null) {
        mensaje += txt2 + "escuela a <b>" + data.escuela.nombre + "</b>";
    }
    if (data.escuela != null && data.graduacion != null) {
        mensaje += " y ";
    }
    if (data.graduacion != null) {
        mensaje += txt2 + "graduacion a <b>" + data.graduacion.nombre + "</b>";
    }
    return mensaje;
}

// llama a la función obtenerDatos cada 3 segundos usando setInterval
/* setInterval(obtenerDatos, 3000); */
obtenerDatos();
