/* EJERCICIO 1 */
/**
 * Cuenta el número de caracteres en una cadena de texto.
 * La propiedad length de un objeto representa la longitud de una cadena
 * @param {string} cadena - La cadena de texto a contar.
 * @returns {number} El número de caracteres en la cadena.
 */
function contarCaracteres(cadena) {
    return cadena.length;
  }

console.log("Funcion contarCaracteres:" + contarCaracteres("dame papitas"))

/* EJERCICIO 2 */
/**
 * Obtiene una subcadena desde el inicio de la cadena hasta una posición definida.
 * El método substring() devuelve los caracteres de una cadena que se encuentran entre dos índices especificados (desde,hasta)
 * @param {string} cadena - La cadena de la que se extraerá la subcadena.
 * @param {number} posicion - La posición hasta donde se debe extraer la subcadena.
 * @returns {string} La subcadena desde el inicio de la cadena hasta la posición especificada.
 */
function obtenerSubcadena(cadena, posicion) {
    return cadena.substring(0, posicion);
  }

console.log("Funcion obtenerSubCadena:" + obtenerSubcadena("phpTeAmoamatar",8))

/* EJERCICIO 3 */
/**
 * Esta función devuelve un arreglo de subcadenas separadas por un carácter específico.
 * el método split() elimina los caracteres de un string y devuelve lo recuperado en un array
 * @param {string} cadena - La cadena original que se va a dividir.
 * @param {string} caracter - El carácter separador que se usará para dividir la cadena.
 * @returns {Array} - Un arreglo de subcadenas separadas por el carácter especificado.
 */
function obtenerSubcadenaSeparadaPorX(cadena, caracter) {
    return cadena.split(caracter);
  }

console.log("Funcion obtenerSubCadenaSeparadaPorX:" + obtenerSubcadenaSeparadaPorX("papa0barata0la0papa","0"))

/* EJERCICIO 4 */
/**
 * Esta función retorna una determinada cantidad de veces algún texto definido y el número de la repetición separados por espacio.
 * el método trim() elimina los espacios en blanco en ambos extremos del string
 * @param {string} texto - El texto que se va a mostrar.
 * @param {number} cantidad - La cantidad de veces que se va a mostrar el texto.
 * @returns {string} - El texto con el número de repetición separado por espacio.
 */
function mostrarCantidadDeVecesUnString(texto, cantidad) {
    let resultado = '';
    for (let i = 1; i <= cantidad; i++) {
      resultado += `${i}.${texto} `;
    }
    return resultado.trim();
  }

console.log("Funcion mostrarCantidadDeVecesUnString:" + mostrarCantidadDeVecesUnString("messi",3))

/* EJERCICIO 5 */
/**
 * Esta función cuenta la cantidad de veces que aparece una palabra dada en una frase dada.
 * el método split() elimina los caracteres de un string y devuelve lo recuperado en un array
 * @param {string} frase - La frase en la que se va a buscar la palabra.
 * @param {string} palabra - La palabra que se va a buscar en la frase.
 * @returns {number} - El número de veces que aparece la palabra en la frase.
 */
function contarPalabraEnFrase(frase, palabra) {
    const palabras = frase.split(' ');
    let contador = 0;
    for (let i = 0; i < palabras.length; i++) {
      if (palabras[i] === palabra) {
        contador++;
      }
    }
    return contador;
  }

console.log("Funcion contarPalabraEnFrase:" + contarPalabraEnFrase("messi messi messi ankara messi ankara messi GOOOOOL ","messi"))

/* EJERCICIO 6 */
/**
 * Esta función elimina varios patrones no deseados dentro de una cadena de caracteres.
 * La función utiliza el método replace() para reemplazar cada ocurrencia del patrón no deseado con una cadena vacía. 
 * El método forEach() se utiliza para iterar sobre cada patrón en el arreglo y reemplazarlo en la cadena. 
 * La expresión regular "g" se utiliza para hacer coincidir todas las ocurrencias del patrón en lugar de solo la primera
 * @param {string} cadena - La cadena de caracteres que se va a limpiar.
 * @param {Array} patrones - Un arreglo de patrones que se van a eliminar de la cadena.
 * @returns {string} - La cadena resultante después de eliminar los patrones no deseados.
 */
function quitarPatronNoDeseado(cadena, patrones) {
    let resultado = cadena;
    patrones.forEach((patron) => {
      resultado = resultado.replace(new RegExp(patron, "g"), "");
    });
    return resultado;
  }

console.log("Funcion quitarPatronNoDeseado:" + quitarPatronNoDeseado("<li>Lunes</li><li>Martes</li><li>Miercoles</li><li>Jueves</li><li>Viernes</li>",["<li>","</li>"]))

/* EJERCICIO 7 */
/**
 * Esta función convierte una cadena de caracteres con patrón HTML en un arreglo de JavaScript.
 * La función utiliza el método split() para dividir la cadena en un arreglo utilizando una expresión 
 * regular que coincide con cualquier etiqueta HTML2. 
 * Luego, utiliza el método filter() para eliminar cualquier elemento vacío del arreglo resultante
 * @param {string} cadena - La cadena de caracteres con patrón HTML que se va a convertir en un arreglo de JavaScript.
 * @returns {Array} - El arreglo de JavaScript generado a partir de la cadena de caracteres con patrón HTML.
 */
function convertirCadenaAArreglo(cadena) {
    return cadena.split(/<[^>]*>/).filter(Boolean);
  }

console.log("Funcion convertirCadenaAArreglo:" + convertirCadenaAArreglo("<li>Lunes</li><li>Martes</li><li>Miercoles</li><li>Jueves</li><li>Viernes</li>"))