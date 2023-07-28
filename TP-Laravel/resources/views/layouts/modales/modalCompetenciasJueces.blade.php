<div class="seccion_item">
    <a href="#" data-bs-toggle="modal" data-bs-target="#inscripcionJuez" class="seccion-item_link">
        <div class="seccion-item_bg"></div>
        <div class="seccion-item_title">
            Inscripción.
            <!-- JUEZ -->
        </div>
    </a>
    <div class="modal fade modalTemaDual" id="inscripcionJuez" tabindex="-1" aria-labelledby="inscripcionJuezLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('store_competencia_juez') }}">

                <div class="modal-content modalTemaDual">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="inscripcionJuezLabel">Inscripcion Juez</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="juez">Usted sera registrado como</label>
                            <input type="text" id="juez" name="juez" value="{{ auth()->user()->id }}" hidden>
                            <input class="form-control" type="text"
                                value="{{ auth()->user()->nombre }} {{ auth()->user()->apellido }}" readonly disabled>
                        </div>
                        <div class="form-group">
                            <label for="competencia">Competencia a la que desea inscribirse</label>
                            <select class="form-control" id="competencia" name="competencia" required>
                                @if (!isset($competenciasDisponibles) || count($competenciasDisponibles) == 0)
                                    <option value="" disabled selected>No hay competencias habilitadas. Vuelva más
                                        tarde.</option>
                                @else
                                    @foreach ($competenciasDisponibles as $row)
                                        <option value="{{ $row->idCompetencia }}">{{ $row->nombre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <br>
                        <p class="lead">Tu institucion registrada es: <b>{{ auth()->user()->escuela->nombre }}</b></p>
                        @if ($tieneCompetenciasRegistradas != null)
                            <div class="d-flex align-self-end">
                                <p class="col">Si desea actualizar su institucion puede: </p>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    abrir opciones
                                </button>
                            </div>
                        @endif
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <p>Seleccione la escuela a la que desea cambiar:</p>
                                <div class="form-group">
                                    <select name="newEscuela" id="newEscuela" class="form-select" required>
                                        @if (!isset($escuelas) || empty($escuelas))
                                            <option value="" selected>No hay escuelas cargadas. Contactar
                                                administrador.</option>
                                        @else
                                            <option value="0" selected>No cambiar de escuela.</option>
                                            @foreach ($escuelas as $escuela)
                                                <option value="{{ $escuela->idEscuela }}">{{ $escuela->nombre }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="valid-feedback">
                                    ¡Correcto!
                                </div>
                                <div class="invalid-feedback">Seleccione una opcion válida.</div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Generar Inscripcion</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
