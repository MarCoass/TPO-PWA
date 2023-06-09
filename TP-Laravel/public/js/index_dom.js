import { cambio_de_tema } from "./tema.js";
import { competidores_tabla } from "./tablaCompetidores.js";
import { tabla_usuarios } from "./tablaUsuarios.js";
import { tabla_solicitud } from "./tablaSolicitudes.js";
import "./eventosMenu.js";
import { tabla_CompetenciaCompetidores } from "./tablaCompetenciaCompetidores.js";
import { tabla_competencia } from "./tablaCompetencias.js";
import { tabla_graduacion } from "./tablaGraduaciones.js";

//Gestion de usuarios tabla
tabla_usuarios;

//Gestion de solicitudes tabla
tabla_solicitud;

//tabla de competidores
competidores_tabla;

//tabla competidores de la competencia
tabla_CompetenciaCompetidores;

//TABLA DE COMPETENCIAS NO VOLVER A BORRAR
tabla_competencia;

// tabla graduaciones
tabla_graduacion;
/*
Si o si poner http://127.0.0.1:800/ruta sino no anda, os advierte su querido Braian <3
  $.ajax({
  url: 'http://127.0.0.1:8000/paises', // URL del archivo o ruta que manejará la solicitud en el servidor
  method: 'GET', // Método HTTP utilizado para la solicitud
  success: function (response) {
    console.log(response)
  },
});*/

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

$("#competencia").change(function () {
    //console.log($("#competencia").val());
    $.ajax({
        type: "GET",
        url: "/opciones_categoria",
        data: {
            competencia: $("#competencia").val(),//id de la competencia
        },

        dataType: "json",
        success: function (data) {

           // console.log(data)
            if (data.length !== 0) {
                $("#categoria").empty();
                $("#categoria").append(
                    '<option value="" disabled selected data-error="Por favor seleccione una categoria">Selecciona una categoria.</option>'
                );
                $.each(data, function (key, value) {
                    var genero = value.genero=='1'?'Masculino':'Femenino'

                    $("#categoria").append(
                        '<option value="' +
                            value.idCategoria +
                            '">' +
                            value.nombre + " " + genero +
                            "</option>"
                    );
                });
            } else {
                //aca ya termino la competencia
               //alert('No quedan categorias.')

           /*      $.ajax({
                    type: "GET",
                    url: "http://127.0.0.1:8000/setear_ranking",
                    data: {
                        idCompetencia: $("#competencia").val(),//id de la competencia
                    },
                    success: function (data) {

                        if (data.respuesta) {
                            console.log('ranking SETEADO');

                        }else{
                            console.log('Ya no se puede setear');
                        }

                    }

                }); */


            }
        },
    });
});


