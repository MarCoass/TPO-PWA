<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="gal">GAL: <span class="spinner-border spinner-border-sm d-none"></span></label>
    <input class="form-control validarEspecial" type="text" id="gal" name="gal" autocomplete="off" pattern="^[A-Z]{3}\d{7}$" maxlength="10" placeholder="Ej: ABC1234567" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Campo necesario, necesita 3 letras mayúsculas seguidas de 7 números</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="ranking">Ranking:</label>
    <input class="form-control validar" type="number" min="0" id="ranking" name="ranking" pattern="^(?!900\.(?:00)?[1-9])(?!0*(?:\.0+)?$)([0-8]?\d{0,2}|900)(?:\.\d{1,2})?$" autocomplete="off" max="900" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Ingrese un numero entre 0 y 900</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="graduacion">Graduacion:</label>
    <select class="form-control validar" id="idGraduacion" name="idGraduacion" required>
        <option value="" disabled selected data-error="Por favor seleccione una graduacion válida">Selecciona una graduación.</option>
        @foreach ($graduaciones as $row)
        <option value="{{$row->idGraduacion}}">{{$row->nombre}} - {{$row->color}}</option>
        @endforeach
    </select>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="competencia">Competencia:</label>
    <select class="form-control validar" id="competencia" name="competencia" required>
        <option value="" disabled selected data-error="Por favor seleccione una Competencia válida">Selecciona una Competencia.</option>
        @foreach ($competencias as $row)
        <option value="{{$row->idCompetencia}}">{{$row->nombre}}</option>
        @endforeach
    </select>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>

<div class="col-md-12 my-3 d-flex justify-content-center align-items-center">
    <button type="button" id="botonVolver" class="btn btn-outline-primary w-25 me-2" onclick="showTab('paso1', 0)">
        <i class="bi bi-arrow-left me-2"></i>Volver
    </button>
    <button type="submit" id="botonGuardarCompetidor" class="btn btn-outline-success w-25">
        <span class="spinner-border spinner-border-sm d-none"></span> <i class="bi bi-cloud-arrow-up-fill me-2"></i>Guardar
    </button>
</div>
