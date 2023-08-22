
<div class="modal-header">
    <h5 class="modal-title">Historial de Competencias de
        {{ auth()->user()->usuario }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    
        
        @if (count($arreglo) > 0)
        <table class="table table-striped table-hover text-center" id="datosTabla">
            @if (auth()->user()->idRol == 2)
                <thead>
                    {{-- <tr>
                        <th scope="col">Nombre Competencia</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Cantidad de Jueces</th>
                        <th scope="col">Cantidad de Competidores Puntuados</th>
                    </tr> --}}
                    <tr>
                        <th scope="col">Nombre Competencia</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Cantidad de Jueces</th>
                        <th scope="col">Cantidad de Competidores Puntuados</th>
                        <th scope="col">Competidor</th>
                        <th scope="col">pasada</th>
                        <th scope="col">poomsae</th>
                        <th scope="col">presentacion</th>
                        <th scope="col">exactitud</th>
                    </tr

                </thead>
                <tbody>
                    @foreach ($arreglo as $item)
                        <tr>
                                
                        @foreach ($item['competidoresPuntuados'] as $competidores)
                                <th scope="row">{{ $item['nombre'] }}</th>
                                <td>{{ $item['fecha'] }}</td>
                                <td>{{ $item['cantidadJueces'] }}</td>
                                <td>{{ $item['cantidadPuntuados'] / 2 }}</td>
                                <td>{{ $competidores['nombreyapellido'] }}</td>
                                <td>{{ $competidores['pasada'] }}</td>
                                <td>{{ $competidores['poomsae'] }}</td>
                                <td>{{ $competidores['ptosPre'] }}</td>
                                <td>{{ $competidores['ptosExa'] }}</td>
                        @endforeach
                        </tr>
                    @endforeach
                    
                </tbody>

            @else
                @if (auth()->user()->idRol == 3)
                    <thead>
                        <tr>
                            <th scope="col">Nombre Competencia</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">1er Poomsae</th>
                            <th scope="col">2do Poomsae</th>
                            <th scope="col">Puntaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arreglo as $item)
                            <tr>
                                <th scope="row">{{ $item['nombre'] }}</th>
                                <td>{{ $item['fecha'] }}</td>
                                <td>{{ $item['poomsae1'] }}</td>
                                <td>{{ $item['poomsae2'] }}</td>
                                <td>{{ $item['puntaje'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            @endif
        </table>
    @else
        <span class="text-danger">No se ha inscrito a ninguna competencia o sigue en curso.</span>
    @endif




</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
</div>


