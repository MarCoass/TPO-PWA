<div class="seccion_item">
    <a href="#" data-bs-toggle="modal" data-bs-target="#inscripcionJuez" class="seccion-item_link">
        <div class="seccion-item_bg"></div>
        <div class="seccion-item_title">
           Inscripción. <!-- JUEZ -->
        </div>
    </a>
    <div class="modal fade" id="inscripcionJuez" tabindex="-1" aria-labelledby="inscripcionJuezLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('store_competencia_juez') }}">

        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="inscripcionJuezLabel">Inscripcion Juez</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                    <div class="form-group">
                    <label for="juez">Juez</label>
                    <select class="form-control" id="juez" name="juez" required>
                        @foreach ($jueces as $row)
                        @if($row->id == auth()->user()->id){
                        <option value="{{ $row->id }}">{{ $row->nombre }} {{ $row->apellido }}</option>
                        @endif
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="competencia">Competencia</label>
                        <select class="form-control" id="competencia" name="competencia" required>
                            @if(!isset($competencias) || count($competencias) == 0)
                                <option value="" disabled selected>No hay competencias habilitadas. Vuelva más tarde.</option>
                            @else
                                @foreach ($competencias as $row)
                                @php
                                    $existe = App\Models\CompetenciaJuez::where('idCompetencia', $row->idCompetencia)->where('idJuez',auth()->user()->id)->first();
                                @endphp
                                    @if (!$existe)
                                    <option value="{{$row->idCompetencia}}">{{$row->nombre}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
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
