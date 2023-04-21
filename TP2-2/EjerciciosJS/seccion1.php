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

    <script src="./js/botonCuentaRegresiva.js"></script>
</div>