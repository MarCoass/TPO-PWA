class Competidor {
    constructor(datos) {
        this.legajo = datos.legajo;
        this.apellido = datos.apellido;
        this.nombre = datos.nombre;
        this.du = datos.du;
        this.fechaNacimiento = new Date(datos.fechaNacimiento);
        this.paisOrigen = datos.paisOrigen;
        this.graduacion = datos.graduacion;
        this.rankingNacional = datos.rankingNacional;
        this.email = datos.email;
        this.genero = datos.genero;
    }

    verPerfil() {
        return "Hola! Me llamo " + this.nombre + " " + this.apellido + ", nací el " + this.fechaNacimiento.toLocaleDateString() + " en " + this.paisOrigen + " y mi DNI es: " + this.du + ", \n Estoy en el puesto Nº: " + this.rankingNacional + " en el Ranking Nacional, mi graduación es: " + this.graduacion + ", \n Mi género es: " + this.genero + " y mi LEGAJO " + this.legajo + "\n";
    }
}

class ControlCompetidor {
    constructor() { }

    paisesAceptados() {
        return ["Rusia", "Ucrania", "Estados Unidos", "Canadá", "Perú", "Chile", "Argentina", "México", "Brasil", "Bolivia", "Ecuador", "Venezuela", "Colombia", "Paraguay", "Uruguay"];
    }

    validarDatos(datos) {
        var erroresArray = [];

        this.validarLegajo(datos.legajo, erroresArray);
        this.validarDU(datos.du, erroresArray);
        this.validarNombreyApellido(datos.nombre, datos.nombre, erroresArray);
        this.validarEmail(datos.email, erroresArray);
        this.validarFecha(datos.fechaNacimiento, erroresArray);
        this.validarPaises(datos.paisOrigen, this.paisesAceptados(), erroresArray);
        this.validarGenero(datos.genero, erroresArray);
        this.validarRanking(datos.rankingNacional, erroresArray);

        return erroresArray;
    }

    validarLegajo(legajo, errores) {
        // Validación del legajo
        if (legajo.length > 0) {
            if (!(/^[A-Z]{3}\d{7}$/.test(legajo))) {
                errores.push("CONTROL ERROR: Legajo " + legajo + " incorrecto");
            }
        } else {
            errores.push("CONTROL ERROR: Legajo " + legajo + " vacío");
        }
    }
    validarDU(du, errores) {
        if (du.length > 0) {
            if (du.length > 8) {
                errores.push("CONTROL ERROR: Documento Único " + du + " incorrecto, supera los 8 números");
            }
        } else {
            errores.push("CONTROL ERROR: Documento Único " + du + " vacío");
        }
    }
    validarNombreyApellido(nombre, apellido, errores) {
        // Validación del apellido y nombre
        var nombreCompleto = nombre + apellido;
        if (nombreCompleto.length > 0) {
            if (nombreCompleto.length > 100) {
                errores.push("CONTROL ERROR: Nombre " + nombre + " o Apellido " + apellido + " incorrecto, exceden los 100 caracteres");
            }
        } else {
            errores.push("CONTROL ERROR: Nombre y Apellidos " + nombreCompleto + " vacíos");
        }
    }
    validarEmail(correo, errores) {
        // Validación del email
        if (correo.length > 0) {
            if (!/\S+@\S+\.\S+/.test(correo)) {
                errores.push("CONTROL ERROR: Correo " + correo + " incorrecto");
            }
        } else {
            errores.push("CONTROL ERROR: Correo " + correo + " vacío");
        }
    }
    validarFecha(fechaNacimiento, errores) {
        // Validación de la edad
        const hoy = new Date();
        const fecha = new Date(fechaNacimiento);
        const edad = hoy.getFullYear() - fecha.getFullYear();
        if (edad < 6) {
            errores.push("CONTROL ERROR: Fecha de Nacimiento " + fecha + " incorrecto, tiene que ser mayor a 6 años");
        }
    }
    validarPaises(paisOrigen, paisesAceptados, errores) {
        // Validación del país de origen
        if (paisOrigen.length > 0) {
            if (!paisesAceptados.includes(paisOrigen)) {
                errores.push("CONTROL ERROR:  País de Origen " + paisOrigen + " incorrecto");
            }
        } else {
            errores.push("CONTROL ERROR: País de Origen " + paisOrigen + " vacío");
        }
    }
    validarGenero(genero, errores) {
        // Validación del género
        if (genero !== "masculino" && genero !== "femenino") {
            errores.push("CONTROL ERROR:  Género " + genero + " incorrecto, sólo puede ser MASCULINO o FEMENINO");
        }
    }
    validarRanking(rankingNacional, errores) {
        // Validación del ranking
        if (!isNaN(rankingNacional)) {
            if (rankingNacional < 0 || rankingNacional > 900) {
                errores.push("CONTROL ERROR:  Ranking Nacional " + rankingNacional + " incorrecto, es un número mayor a 900");
            }
        } else {
            errores.push("CONTROL ERROR:  Ranking Nacional " + rankingNacional + " incorrecto, no es un número");
        }
    }

    armarErrores(errors) {
        var estructuraErrores = "";
        errors.forEach(function (errorActual) {
            estructuraErrores += "<div class='alert alert-danger' role='alert'>" + errorActual + "</div>";
        });
        return estructuraErrores
    }

    armarCompetidorNuevo(data) {
        var estructuraCompetidor = "";
        estructuraCompetidor += "<div class='alert alert-info' role='alert'>";
        estructuraCompetidor += "Nombre Completo: " + data.nombre + " " + data.apellido + " - DU: " + data.du + "<br>";
        estructuraCompetidor += "CORREO: " + data.correo + " - FECHA NACIMIENTO: " + data.fechaNacimiento + " <br>";
        estructuraCompetidor += "PAÍS DE ORIGEN: " + data.paisOrigen + " - GÉNERO: " + data.genero + "<br>";
        estructuraCompetidor += "GAL: " + data.legajo + " - RANKING NACIONAL: " + data.rankingNacional + "<br>";
        estructuraCompetidor += "</div>";
        return estructuraCompetidor;
    }

    crearCompetidor(datos, competidores) {
        var errores = this.validarDatos(datos);
        var contenidoRetorno = "";

        if (errores.length > 0) { // SI HUBO ERRORES LOS MOSTRAMOS
            contenidoRetorno += this.armarErrores(errores);
        } else { // SINO CREAMOS EL NUEVO COMPETIDOR, RETORNAMOS UNA ESTRUCTURA HTML CON SUS DATOS Y LO SETEAMOS AL LOCALSTORAGE
            contenidoRetorno += this.armarCompetidorNuevo(datos);
            nuevoCompetidor = new Competidor(datos);
            competidores.push(nuevoCompetidor) // AGREGAMOS PARA EL SETEO
            localStorage.setItem("competidores", JSON.stringify(competidores)); // GUARDADISIMO MI REY
        }

        console.log(contenidoRetorno)

        return contenidoRetorno
    }
}

