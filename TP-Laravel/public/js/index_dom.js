import { cambio_de_tema } from "./tema.js";
import "./eventosMenu.js";

//Temas
if (localStorage.getItem("background") == null) {
    cambio_de_tema("light");
} else {
    cambio_de_tema(localStorage.getItem("background"));
}

document.getElementById("cambiarVista_negro").addEventListener("click", () => {
    cambio_de_tema("dark");
});
document.getElementById("cambiarVista_blanco").addEventListener("click", () => {
    cambio_de_tema("light");
});



//Carga los competidores segun la categoria
$("#categoria").on("click", function () {
    $.ajax({
        type: "GET",
        url: "/opciones_competidor",
        data: {
            competencia: $("#competencia").val(),
            categoria: $("#categoria").val(),
        },

        dataType: "json",
        success: function (data) {
            //console.log(data);
            $("#competidor").empty();
            $("#competidor").append(
                '<option value="" disabled selected data-error="Por favor seleccione un competidor">Selecciona un competidor.</option>'
            );
            $.each(data, function (key, value) {
                $("#competidor").append(
                    '<option value="' +
                        value.idCompetidor +
                        '">' +
                        value.nombre +
                        " " +
                        value.apellido +
                        "</option>"
                );
            });
        },
    });
});




