<div class="p-3 row">
    <div class="col text-center">
        <div class="row">
            <button class="col btn btn-success disabled" id="botonAnterior"><span class="ft-bold display-5">{{ $darEstados[0]}}</span></button>
            <button class="col btn btn-success active" id="botonActual"><span class="ft-bold display-5">{{ $darEstados[1]}}</span></button>
            <button class="col btn btn-success disabled" id="botonSiguiente"><span class="ft-bold display-5">{{ $darEstados[2]}}</span></button>
        </div>
        <h3 class="display-5">Estado de Puntuación</h3>
        <div class="alert alert-success mx-auto mt-3 border border-success d-flex align-items-center justify-content-center"
            role="alert" style="width: 50%">
            <h5 class="mt-1">Competidor: <span class="text-decoration-underline">{{ $reloj->competenciaCompetidor->competidor->nombre }} {{ $reloj->competenciaCompetidor->competidor->apellido }}</span></h5>
        </div>
        <table class="table table-bordered" id="tabla-jueces">
            <thead>
                <tr>
                    <th scope="col">Juez</th>
                    <th scope="col">1er Puntaje</th>
                    <th scope="col">2do Puntaje</th>
                </tr>
            </thead>
            <tbody id="tbody-jueces">
                @for ($i = 0; $i < $reloj->cantJueces; $i++)
                    <tr class="rowJuez{{ $i }}">
                        <th id="nombreJuez{{ $i }}" class="align-middle">Esperando juez...</th>
                        <td id="primeraPasadaJuez{{ $i }}">
                            <table class="table  mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border-2 border-danger border-top border-start bg-danger bg-gradient bg-opacity-75">Exactitud</th>
                                        <th scope="col" class="border-2 border-primary border-top border-end bg-primary bg-gradient bg-opacity-75">Presentación</th>
                                      </tr>
                                </thead>
                                <tbody>
                                    <td id="exactitudPrimeraPasadaJuez{{ $i }}" class="border-2 border-danger border-bottom border-start">...</td>
                                    <td id="presentacionPrimeraPasadaJuez{{ $i }}" class="border-2 border-primary border-bottom border-end">...</td>
                                </tbody>
                            </table>
                        </td>
                        <td id="primeraSegundaJuez{{ $i }}">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border-2 border-danger border-top border-start bg-danger bg-gradient bg-opacity-75">Exactitud</th>
                                        <th scope="col" class="border-2 border-primary border-top border-end bg-primary bg-gradient bg-opacity-75">Presentación</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <td id="exactitudSegundaPasadaJuez{{ $i }}" class="border-2 border-danger border-bottom border-start">...</td>
                                    <td id="presentacionSegundaPasadaJuez{{ $i }}" class="border-2 border-primary border-bottom border-end">...</td>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
