<div class="p-3 row" style="margin-bottom: 100px">
    <div class="col text-center">
        <h3 class="display-5">Estado de puntuacion</h3>
        <p>Competidor:<span id="nombreCompetidor">Esperando competidor...</span></p>
        <table class="table table-bordered" id="tabla-jueces">
            <thead>
                <tr>
                    <th scope="col">Juez</th>
                    <th scope="col">1er Puntaje</th>
                    <th scope="col">2do Puntaje</th>
                </tr>
            </thead>
            <tbody id="tbody-jueces">
                @for ($i = 0; $i < $cantJueces; $i++)
                    <tr class="rowJuez{{$i}}">
                        <td id="nombreJuez{{$i}}">Esperando juez...</td>
                        <td class="" id="primeraPasadaJuez{{$i}}">
                            <table class="table">
                                <thead class="m-auto">
                                    <tr>
                                        <th scope="col">Exactitud</th>
                                        <th scope="col">Presentacion</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <td id="exactitudPrimeraPasadaJuez{{$i}}">...</td>
                                    <td id="presentacionPrimeraPasadaJuez{{$i}}">...</td>
                                </tbody>
                            </table>
                        </td>
                        <td class=""  id="primeraSegundaJuez{{$i}}">
                            <table class="table">
                                <thead class="m-auto">
                                    <tr>
                                        <th scope="col">Exactitud</th>
                                        <th scope="col">Presentacion</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <td id="exactitudSegundaPasadaJuez{{$i}}">...</td>
                                    <td id="presentacionSegundaPasadaJuez{{$i}}">...</td>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>