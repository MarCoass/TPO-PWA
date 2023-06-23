<div class="modal fade modalTemaDual" id="solicitudesPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modalTemaDual">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Inscripciones Pendientes de revisión de
                    {{ auth()->user()->usuario }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (count($arregloInscripciones) > 0)
                    <table class="table table-striped table-hover text-center">
                        @if (auth()->user()->idRol == 2 || auth()->user()->idRol == 3)

                            <thead>
                                <tr>
                                    <th scope="col">Nombre Competencia</th>
                                    <th scope="col">Fecha de Inscripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($arregloInscripciones as $item)
                                    <tr>
                                        <th scope="row">{{ $item['nombre'] }}</th>
                                        <td>{{ $item['fecha'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                @else
                    <span class="text-danger bold">No tiene inscripciones pendientes hacia ninguna competencia.</span>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i
                        class="bi bi-x-lg me-2"></i>Cerrar</button>
            </div>
        </div>
    </div>
</div>
