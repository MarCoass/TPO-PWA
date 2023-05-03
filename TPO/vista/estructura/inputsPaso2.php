<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="legajo">GAL:</label>
    <input class="form-control verificable" type="text" id="legajo" name="legajo" autocomplete="off" pattern="^[A-Z]{3}\d{7}$" placeholder="Ej: ABC1234567" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Campo necesario, necesita 3 letras mayúsculas seguidas de 7 números</div>
    <div class="verificacion-invalid-feedback">Este GAL ya está registrado.</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="rankingNacional">Ranking:</label>
    <input class="form-control" type="number" min="0" id="rankingNacional" name="rankingNacional" pattern="^(?!900\.(?:00)?[1-9])(?!0*(?:\.0+)?$)([0-8]?\d{0,2}|900)(?:\.\d{1,2})?$" autocomplete="off" max="900" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Ingrese un numero entre 0 y 900</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="graduacion">Graduacion:</label>
    <select class="form-control" id="graduacion" name="graduacion" required>
        <option value="" disabled selected data-error="Por favor seleccione una graduacion válida">Selecciona una opción</option>
    </select>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>

<div class="my-3 ml-3 row justify-content-center">
    <button type="button" class="btn btn-outline-primary col-md-4 col-sm-6 col-xs-8 me-2" onclick="showTab('paso1', 0, 'cambiar')">
        <i class="bi bi-arrow-left me-2"></i>Volver
    </button>
    <button type="submit" class="btn btn-outline-success col-md-4 col-sm-6 col-xs-8">
        <i class="bi bi-cloud-arrow-up-fill me-2"></i>Guardar
    </button>
</div>