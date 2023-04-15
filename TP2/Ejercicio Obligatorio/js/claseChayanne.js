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

    paisesAceptados() {
        return ["Rusia", "Ucrania", "Estados Unidos", "Canadá", "Perú", "Chile", "Argentina", "México", "Brasil", "Bolivia", "Ecuador", "Venezuela", "Colombia", "Paraguay", "Uruguay"];
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
        if (!this.paisesAceptados().includes(this.paisOrigen)) {
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
}

