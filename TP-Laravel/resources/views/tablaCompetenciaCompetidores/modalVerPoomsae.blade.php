 <div class="modal-header">
     <h5 class="modal-title">Poomses de Competidor {{ $competidor[0]->nombre }} {{ $competidor[0]->apellido }}</h5>
     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
 </div>
 <div class="modal-body">
     @foreach ($poomsae as $row)
         <h3>Pasada Numero {{ $row->pasadas }}</h3>
         <b> Nombre de Poomsae:</b> {{ $row->nombre }}
     @endforeach
 </div>
 <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
 </div>
