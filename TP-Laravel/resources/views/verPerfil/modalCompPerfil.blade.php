
<div class="modal-header">
    <h5 class="modal-title">Historial de Competencias de
        {{ auth()->user()->usuario }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    
        
@if (count($arreglo) > 0)
        <table class="table table-striped table-hover text-center table-light" id="datosTabla">
        @if (auth()->user()->idRol == 2)
                <thead>
                    <tr>
                        <th scope="col" class="d-none">Nombre Competencia</th>
                        <th scope="col" class="d-none">Fecha</th>
                        <th scope="col" class="d-none">Cantidad de Jueces</th>
                        <th scope="col" class="d-none">Cantidad de Competidores Puntuados</th>
                        <th scope="col">Competidor</th>
                        <th scope="col">Pas.</th>
                        <th scope="col">poomsae</th>
                        <th scope="col">Pres.</th>
                        <th scope="col">Exac</th>
                    </tr

                </thead>
                <tbody>
                    @foreach ($arreglo as $item)
                    @foreach ($item['competidoresPuntuados'] as $competidores)
                    <tr>
                        <th scope="row" class="d-none">{{ $item['fecha'] }} - {{ $item['nombre'] }}</th>
                        <td class="d-none">{{ $item['fecha'] }}</td>
                        <td class="d-none">{{ $item['cantidadJueces'] }}</td>
                        <td class="d-none">{{ $item['cantidadPuntuados'] / 2 }}</td>
                        <td>{{ $competidores['nombreyapellido'] }}</td>
                        <td>{{ $competidores['pasada'] }}</td>
                        <td>{{ $competidores['poomsae'] }}</td>
                        <td>{{ $competidores['ptosExa'] }}</td>
                        <td>{{ $competidores['ptosPre'] }}</td>
                    </tr>
                    @endforeach
                    @endforeach

                </tbody>
        </table>
        @endif
@else
        <span class="text-danger">No se ha inscrito a ninguna competencia o sigue en curso.</span>
@endif


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
</div>


