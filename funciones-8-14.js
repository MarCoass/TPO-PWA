//EJERCICIO 8
/* Función que te permita obtener un número aleatorio entre 0 y 1000. */
function aleatorioEntero() {
  let num = Math.round(Math.random() * 1000); //Math.round para redondear al entero mas cercano.
  return num;
}

/*Funcion que obtiene un número aleatorio entre 0 y 1 con 2 decimales.*/
function aleatorioDecimal() {
  let num = (Math.random() * 1).toFixed(2); //toFixed redondea a 2 decimales
  num = parseFloat(num); //lo pasa a float
  return num;
}

//EJERCICIO 9
/*Función que determina si un número es decimal. */

function esDecimal(num) {
  let esDecimal = num % 1 !== 0; //divide por 1, si el resto es diferente de 0 significa que es float
  return esDecimal;
}

//EJERCICIO 10
/**Conversor de grados Celsius a Fahrenheit. */
function celsiusAFahrenheit(tempCelcius) {
  let tempFahrenheit = tempCelcius * 1.8 + 32;
  return tempFahrenheit;
}

/**Conversor de Fahrenheit a Celsius */
function fahrenheitACelsius(tempFahrenheit) {
  let tempCelcius = (tempFahrenheit - 32) *5/9;
  return tempCelcius;
}

//EJERCICIO 11
/**Función que permite obtener el resultado de aplicar un descuento en porcentaje a un valor dado. */
function aplicarDescuento(total, desc) {
  let aux = (total * desc) / 100;
  let resultado = total - aux;
  return resultado;
}

//EJERCICIO 12
/** Funcion que dada una fecha de nacimiento permite obtener la edad de la persona */
function obtenerEdad(fechaNac) {
  let fechaActual = new Date();
  let edad = fechaActual.getFullYear() - fechaNac.getFullYear();
  let mes = fechaActual.getMonth() - fechaNac.getMonth(); //saca la diferencia entre los meses
  //si la dif de meses es menor a 0 o es el mismo mes pero el dia actual es menor al de la fecha de nacimiento, se resta un año
  if (mes < 0 || (mes === 0 && fechaActual.getDate() < fechaNac.getDate())) {
    edad--;
  }
  return edad;
}

//EJERCICIO 13
/**Función que permite decir si una cadena de caracteres cumple con un formato
 *aceptable de email, esto es, más de 2 caracteres para el identificador, el simbolo @ y
 *dominios de correo aceptables. Podés utilizar expresiones regulares */
function emailValido(email) {
  const expresionRegular = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return expresionRegular.test(email);
}

//EJERCICIO 14
/**
 * Función que permite decir que una cadena de caracteres contiene un nombre y un
 * apellido. Como premisas iniciales, considere que no puede contener caracteres especiales,
 *puede contener mayúsculas y minúsculas y cada palabra debe estar separada por un espacio
 */
function nombreApellidoValido(texto) {
  const expresionRegular = /^[a-zA-Z]+\s[a-zA-Z]+$/;
  return expresionRegular.test(texto);
}
