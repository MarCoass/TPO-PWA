<div class="row p-3 text-light bg-seccion2 transicion">
    <div class="text-center">
        <span class="display-5">Seccion 1 </span>
    </div>
</div>
<div class="row text-center my-3">
    <div class="col-4">
        <button id="startButton" onclick="startCountdown()" type="button" class="btn btn-outline-success btn-lg">
            <i class="bi bi-play me-1"></i>Iniciar
        </button>
    </div>
    <div class="col-4">
        <button id="stopButton" onclick="stopCountdown()" type="button" class="btn btn-outline-danger btn-lg" disabled>
            <i class="bi bi-stop me-1"></i>Finalizar
        </button>
    </div>
    <div class="col-4">
        <button onclick="resetCountdown()" type="button" class="btn btn-outline-info btn-lg">
            <i class="bi bi-fast-forward me-1"></i>Reiniciar
        </button>
    </div>
    <div class="col-12 mt-3">
        <p id="inicio"><span id="countdown">90</span> Segundos</p>
        <p id="pasado" class="d-none text-danger"><span id="countup">0</span> OVERTIME</p>
        <p id="final" class="d-none text-success"><span id="total"></span> Segundos Totales</p>
    </div>

    <script>
        var countdownInterval, countupInterval; // CUENTAS REGRESIVAS
        var totalSeconds = 0; // SEGUNDOS TOTALES
        let finalizado = false;

        var countdown = document.getElementById("countdown"); // NUMERO CUENTA REGRESIVA INICIAL
        var countup = document.getElementById("countup"); // NÚMERO CUENTA REGRESIVA OVERTIME
        var totalSecondsSpan = document.getElementById("total"); // NÚMERO DE SEGUNDOS TOTALES

        var startButton = document.getElementById("startButton"); // BOTÓN INICAR CUENTA REGRESIVA
        var stopButton = document.getElementById("stopButton"); // BOTÓN FINALIZAR CUENTA REGRESIVA

        var inicio = document.getElementById("inicio"); // SPAN TEXTO CUENTA REGRESIVA INICIAL
        var pasado = document.getElementById("pasado"); // SPAN TEXTO CUENTA REGRESIVA OVERTIME
        var final = document.getElementById("final"); // SPAN TEXTO SEGUNDOS TOTALES

        function startCountdown() {
            var seconds = parseInt(countdown.innerHTML);
            countdown.innerHTML = seconds;

            countdownInterval = setInterval(function() {
                seconds--;
                totalSeconds++;
                countdown.innerHTML = seconds;
                if (seconds == 0) {
                    inicio.classList.add("d-none"); // OCULTAR SPAN DE CUENTA REGRESIVA INICIAL
                    pasado.classList.remove("d-none"); // MOSTRAR SPAN DE CUENTA REGRESIVA OVERTIME
                    clearInterval(countdownInterval);
                    countup.innerHTML = 0;
                    var count = 0;
                    countupInterval = setInterval(function() {
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

        function stopCountdown() {
            clearInterval(countdownInterval);
            clearInterval(countupInterval);
            totalSecondsSpan.innerHTML = totalSeconds;
            final.classList.remove("d-none");
            stopButton.disabled = true;
        }

        function resetCountdown() {
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
    </script>
</div>