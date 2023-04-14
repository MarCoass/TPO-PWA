class Competidor {
    constructor(legajo, apellido, nombre, email, edad, pais, genero, ranking) {
      this.legajo = legajo;
      this.apellido = apellido;
      this.nombre = nombre;
      this.email = email;
      this.edad = edad;
      this.pais = pais;
      this.genero = genero;
      this.ranking = ranking;
    }
  
    static paisesAceptados() {
      return ["Argentina", "Brasil", "Chile", "Colombia", "México", "Perú"];
    }
  
    validarLegajo() {
      const regexLegajo = /^[a-zA-Z]{3}\d{6}$/;
      return regexLegajo.test(this.legajo);
    }
  
    validarApellido() {
      return this.apellido.length <= 100;
    }
  
    validarNombre() {
      return this.nombre.length <= 100;
    }
  
    validarEmail() {
      const regexEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
      return regexEmail.test(this.email);
    }
  
    validarEdad() {
      return this.edad >= 6;
    }
  
    validarPais() {
      return Competidor.paisesAceptados().includes(this.pais);
    }
  
    validarGenero() {
      const generosAceptados = ["Masculino", "Femenino", "Otro"];
      return generosAceptados.includes(this.genero);
    }
  
    validarRanking() {
      const regexRanking = /^\d{1,3}(\.\d{1})?$/;
      return regexRanking.test(this.ranking) && parseFloat(this.ranking) >=0 && parseFloat(this.ranking) <=900;
    }
  }
  
  const competidor1 = new Competidor("ABC123456", "Pérez", "Juan", "juanperez@gmail.com", 25, "Argentina", "Masculino", "300");
  const competidor2 = new Competidor("DEF123456", "Gómez", "María", "mariagomez@gmail.com", 30, "México", "Femenino", "500");
  const competidor3 = new Competidor("GHI123456", "González", "Pedro", "pedrogonzalez@gmail.com", 40, "Chile", "Otro", "800");
  
  console.log(competidor1);
  console.log(competidor2);
  console.log(competidor3);