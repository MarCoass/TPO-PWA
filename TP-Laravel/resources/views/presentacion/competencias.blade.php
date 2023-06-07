@extends('layouts/layout')

@section('titulo')
    Competencias
@endsection

@section('encabezado')
    Competencias
@endsection

@section('contenido')
    <div class="row mx-auto" data-masonry='{"percentPosition": true }'>
        @foreach ($competencias as $competencia)
            <div class="card m-4" style="width: 18rem;">
                @if ($competencia->flyer != '')
                    <img src="{{ asset('storage/' . $competencia->flyer) }}" class="card-img-top" alt="...">
                @else
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="100%"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="#55595c"></rect><text x="20%" y="50%"
                            fill="#eceeef" dy=".3em">{{ $competencia->nombre }}</text>
                    </svg>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $competencia->nombre }}</h5>
                    <p class="card-text">Fecha: {{ $competencia->fecha }}.</p>
                    <p class="card-text">Estado: Abierto a @if ($competencia->estadoJueces == 1)
                            competidores.
                        @else
                            jueces.
                        @endif
                    </p>

                    <a href="{{ route('verPresentacion', ['id' => $competencia->idCompetencia]) }}"
                        class="btn btn-outline-info">Ir a presentacion.</a>
                </div>
            </div>
        @endforeach

    </div>
    <div class="contenedor-btn-volver ">
        <button type="button" id="botones" class="btn btn-outline-secondary mt-3" onclick="history.back()"><i
                class="bi bi-arrow-left me-2"></i>Volver</button>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
    integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
</script>
