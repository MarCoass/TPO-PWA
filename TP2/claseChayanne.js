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
        this.validarDatos(); // También puede comentarse y usarse después de crear los objetos
    }

    validarDatos() {
        // Validación del legajo
        if (!/^[A-Z]{3}\d{7}$/.test(this.legajo)) {
            throw new Error("El legajo debe tener 9 caracteres: 3 letras y 7 números.");
        }
        // Validación del apellido y nombre
        if (this.apellido.length > 100 || this.nombre.length > 100) {
            throw new Error("El apellido y nombre no pueden superar los 100 caracteres.");
        }
        // Validación del email
        if (!/\S+@\S+\.\S+/.test(this.email)) {
            throw new Error("El email no es válido.");
        }
        // Validación de la edad
        const hoy = new Date();
        const edad = hoy.getFullYear() - this.fechaNacimiento.getFullYear();
        if (edad < 6) {
            throw new Error("El competidor debe tener al menos 6 años.");
        }
        // Validación del país de origen
        const paisesAceptados = ["Rusia", "Ucrania", "Estados Unidos", "Canada", "Perú", "Chile", "Argentina", "México", "Brasil", "Bolivia", "Ecuador", "Venezuela", "Colombia", "Paraguay", "Uruguay"];
        if (!paisesAceptados.includes(this.paisOrigen)) {
            throw new Error("El país de origen no está entre los países aceptados.");
        }
        // Validación del género
        if (this.genero !== "masculino" && this.genero !== "femenino") {
            throw new Error("El género debe ser masculino o femenino.");
        }
        // Validación del ranking
        if (isNaN(this.rankingNacional) || this.rankingNacional < 0 || this.rankingNacional > 900) {
            throw new Error("El ranking debe ser un número entre 0 y 900.");
        }
    }

    verPerfil() {
        return {
            legajo: this.legajo,
            apellido: this.apellido,
            nombre: this.nombre,
            du: this.du,
            fechaNacimiento: this.fechaNacimiento.toLocaleDateString(),
            paisOrigen: this.paisOrigen,
            graduacion: this.graduacion,
            rankingNacional: this.rankingNacional,
            email: this.email,
            genero: this.genero,
        };
    }

    static paisesAceptados() {
        return ["Rusia", "Ucrania", "Estados Unidos", "Canadá", "Perú", "Chile", "Argentina", "México", "Brasil", "Bolivia", "Ecuador", "Venezuela", "Colombia", "Paraguay", "Uruguay"];
    }
}

const datosCompetidor1 = {
    legajo: "ABC1234567",
    apellido: "Centurión",
    nombre: "Braian",
    du: "12345678",
    fechaNacimiento: "2001-04-08",
    paisOrigen: "Chile",
    graduacion: "2do GUP",
    rankingNacional: 750,
    email: "braian.cent@example.com",
    genero: "masculino",
};

const datosCompetidor2 = {
    legajo: "DEF2345678",
    apellido: "Coassin",
    nombre: "María",
    du: "23456789",
    fechaNacimiento: "2001-08-25",
    paisOrigen: "Argentina",
    graduacion: "1er DAN",
    rankingNacional: 600.5,
    email: "mar.coassin@example.com",
    genero: "femenino",
};

const datosCompetidor3 = {
    legajo: "GHI3456789",
    apellido: "Farfan",
    nombre: "Matias",
    du: "34567890",
    fechaNacimiento: "1995-03-15",
    paisOrigen: "Colombia",
    graduacion: "5to GUP",
    rankingNacional: 350,
    email: "matias.farfan@example.com",
    genero: "masculino",
};

const competidor1 = new Competidor(datosCompetidor1);
const competidor2 = new Competidor(datosCompetidor2);
const competidor3 = new Competidor(datosCompetidor3);

console.table(competidor1.verPerfil());
console.table(competidor2.verPerfil());
console.table(competidor3.verPerfil());

