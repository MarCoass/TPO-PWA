// EJERCICIO 15
/* Dado un arreglo de números enteros, crear una función que retorne el mismo arreglo con los valores elevados al cubo. */
function arregloAlCubo(arreglo) {
    var arregloCubo = [];

    for (var i = 0; i < arreglo.length; i++) {
        arregloCubo.push(arreglo[i] ** 3);
    }

    return arregloCubo;
}

var numeros1 = [1, 2, 3, 4, 5];
var numerosAlCubo = arregloAlCubo(numeros1);
console.log("EJ15: Arreglo de números al cubo: " + numerosAlCubo); // [1, 8, 27, 64, 125]

// EJERCICIO 16
/* Dado un arreglo de números enteros, crear una función que retorne el mismo arreglo con los valores elevados al cubo. */
function arregloMinMax(arreglo) {
    var min = Math.min(...arreglo);
    var max = Math.max(...arreglo);

    return { min: min, max: max };
}

var numeros2 = [1.5, 2.8, 3.2, 4.7, 5.1];
var minMax = arregloMinMax(numeros2);
console.log("EJ16: Menor Número: " + minMax.min); // 1.5
console.log("EJ16: Mayor Número: " + minMax.max); // 5.1

// EJERCICIO 17
/* Crear una función que dado un arreglo de números devuelva un objeto con dos arreglos. En
uno de ellos debe contener los valores menores a un valor dado y en el otro debe contener
los valores mayores o iguales al valor dado.*/
function menoresYmayores(arreglo, referencia) {
    var menores = [];
    var mayoresIguales = [];

    for (var i = 0; i < arreglo.length; i++) {
        if (arreglo[i] < referencia) {
            menores.push(arreglo[i]);
        } else {
            mayoresIguales.push(arreglo[i]);
        }
    }

    return { menores: menores, mayoresIguales: mayoresIguales };
}

var numeros3 = [1, 2, 3, 4, 5];
var referencia1 = 3;
var valores1 = menoresYmayores(numeros3, referencia1);
console.log("EJ17: Números menores a " + referencia1 + ": " + valores1.menores); // [1, 2]
console.log("EJ17: Números mayor o iguales a " + referencia1 + ": " + valores1.mayoresIguales); // [3, 4, 5]

// EJERCICIO 18
/* Mejorar la función del ejercicio anterior para que los valores de los arreglos del objeto
retornado estén ordenados crecientemente (los que son menores al valor dado) y
decrecientemente (los que son mayores al valor dado.*/
function menoresYmayores2(arreglo, referencia) {
    var menores = [];
    var mayoresIguales = [];

    for (var i = 0; i < arreglo.length; i++) {
        if (arreglo[i] < referencia) {
            menores.push(arreglo[i]);
        } else {
            mayoresIguales.push(arreglo[i]);
        }
    }

    menores.sort(function (a, b) { return a - b });
    mayoresIguales.sort(function (a, b) { return b - a });

    return { menores: menores, mayoresIguales: mayoresIguales };
}

var numeros4 = [5, 1, 4, 2, 3];
var referencia2 = 3;
var valores2 = menoresYmayores2(numeros4, referencia2);
console.log("EJ18: Números mayor o iguales a " + referencia2 + " ordenados crecientemente: " + valores2.menores); // [1, 2]
console.log("EJ18: Números mayor o iguales a " + referencia2 + " ordenados decrecientemente: " + valores2.mayoresIguales); // [5, 4, 3]

// EJERCICIO 19
/* Crear una función que elimine los valores duplicados de un arreglo. Mejorar el código del
ejercicio 19 para que los arreglos del objeto retornado no tengan valores duplicados. */
function eliminarDuplicados(arreglo) {
    var sinDuplicados = arreglo.filter(function (valor, indice, self) {
        return self.indexOf(valor) === indice;
    });

    return sinDuplicados;
}

var numeros5 = [1, 2, 3, 4, 4, 5, 5];
var sinDuplicados1 = eliminarDuplicados(numeros5);
console.log("EJ19 Arreglo simple sin duplicados: " + sinDuplicados1); // [1, 2, 3, 4, 5]

// EJERCICIO 20
/* Crear una función que elimine valores duplicados de cualquier arreglo, con diferentes valores
y tipos de datos. */
function eliminarDuplicadosVariados(arreglo) {
    return Array.from(new Set(arreglo));
}

const arreglo = [1, 2, 3, 2, 'hola', 'hola', true, false, true];
const sinDuplicados2 = eliminarDuplicadosVariados(arreglo);
console.log("EJ20 Arreglo variado sin duplicados: " + sinDuplicados2); // [1, 2, 3, "hola", true, false]

// EJERCICIO 21
/*Crear una función para obtener el promedio de un arreglo de números. */
function obtenerPromedio(arr) {
    const suma = arr.reduce((total, numero) => total + numero);
    const promedio = suma / arr.length;

    return promedio;
}

const numeros6 = [1, 2, 3, 4, 5];
const promedio = obtenerPromedio(numeros6);
console.log("EJ21 Promedio de números: " + promedio); // 3