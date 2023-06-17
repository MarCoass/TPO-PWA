<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Subir imagen de perfil</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('actualizarImagenPerfil') }} " enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group mb-3">
                        <label for="formFile" class="form-label">Seleccione una imagen</label>
                        <input class="form-control" accept=".jpg,.png,.jpeg" type="file" name="imagenPerfil"
                            id="imagenPerfil">
                            <input type="hidden" name="idUsuario" value="{{ auth()->user()->id }}">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>


            </div>
        </div>
    </div>
</div>
