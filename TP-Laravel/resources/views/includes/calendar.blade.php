<h3 >Fechas de competencias</h3>
<div class="calendar"></div>
<link rel="stylesheet" href="{{ asset('css/calendario.css') }}">

{{-- Para vista movil --}}
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Ver fechas de competencias
  </button>
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="calendar"></div>
  </div>
<script src="{{ asset('js/calendario.js') }}"></script>

