<div class="modal" id="modalCategoriaTerminada" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pasadas terminadas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="leaf h4">El competidor <span id="nombreDelCompetidor"></span> ya ha sido juzgado</p>

          <h3>El puntaje final es:</h3>
          <h1>
            <span class="border p-2" id="decirPuntajeFinal"> ... </span>
          </h1>

        </div>
        <div class="modal-footer">
          <a href="{{route("index_reloj")}}"><button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ir a Relojes</button></a>
        </div>
      </div>
    </div>
  </div>