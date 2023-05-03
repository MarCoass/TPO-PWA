var countdownInterval, countupInterval; // CUENTAS REGRESIVAS
var totalSeconds = 0; // SEGUNDOS TOTALES

var countdown = document.getElementById("countdown"); // NUMERO CUENTA REGRESIVA INICIAL
var countup = document.getElementById("countup"); // NÚMERO CUENTA REGRESIVA OVERTIME
var totalSecondsSpan = document.getElementById("total"); // NÚMERO DE SEGUNDOS TOTALES

var startButton = document.getElementById("startButton"); // BOTÓN INICAR CUENTA REGRESIVA
var stopButton = document.getElementById("stopButton"); // BOTÓN FINALIZAR CUENTA REGRESIVA

var inicio = document.getElementById("inicio"); // SPAN TEXTO CUENTA REGRESIVA INICIAL
var pasado = document.getElementById("pasado"); // SPAN TEXTO CUENTA REGRESIVA OVERTIME
var final = document.getElementById("final"); // SPAN TEXTO SEGUNDOS TOTALES

export function startCountdown() {
    
    var seconds = parseInt(countdown.innerHTML);
    countdown.innerHTML = seconds;

    countdownInterval = setInterval(function () {
        seconds--;
        totalSeconds++;
        countdown.innerHTML = seconds;
        if (seconds == 0) {
            inicio.classList.add("d-none"); // OCULTAR SPAN DE CUENTA REGRESIVA INICIAL
            pasado.classList.remove("d-none"); // MOSTRAR SPAN DE CUENTA REGRESIVA OVERTIME
            clearInterval(countdownInterval);
            countup.innerHTML = 0;
            var count = 0;
            countupInterval = setInterval(function () {
                count++;
                totalSeconds++;
                countup.innerHTML = count;
            }, 1000);

            totalSecondsSpan.innerHTML = totalSeconds;
            pasado.classList.remove("d-none");
        }
    }, 1000);

    startButton.disabled = true;
    stopButton.disabled = false;
}

export function stopCountdown() {
    clearInterval(countdownInterval);
    clearInterval(countupInterval);
    totalSecondsSpan.innerHTML = totalSeconds;
    final.classList.remove("d-none");
    stopButton.disabled = true;
}

export function resetCountdown() {
    clearInterval(countdownInterval);
    clearInterval(countupInterval);
    countdown.innerHTML = 90; // REINICIAMOS LOS SEGUNDOS DE LA CUENTA REGRESIVA INICIAL
    countup.innerHTML = 0; // REINICIAMOS LOS SEGUNDOS DEL OVERTIME
    startButton.disabled = false; // HABILITAMOS BOTON DE INICIAR
    stopButton.disabled = true; // DESHABILITAMOS BOTON DE FINALIZAR
    totalSeconds = 0; // REINICIAMOS LOS SEGUNDOS TOTALES
    final.classList.add("d-none"); // OCULTAMOS SPAN DE SEGUNDOS TOTALES
    inicio.classList.remove("d-none"); // MOSTRAR SPAN DE CUENTA REGRESIVA INICIAL
    pasado.classList.add("d-none"); // OCULTAR SPAN DE CUENTA REGRESIVA OVERTIME
}