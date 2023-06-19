<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="apellido">Apellido:</label>
    <input class="form-control validar" type="text" id="apellido" name="apellido" maxlength="50" pattern=".+" placeholder="Ej: Lopez" value="{{ $competidor->apellido }}" autocomplete="off" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Debe ingresar un apellido.</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="nombre">Nombre:</label>
    <input class="form-control validar" type="text" id="nombre" name="nombre" maxlength="50" pattern=".+" placeholder="Ej: Lautaro" value="{{ $competidor->nombre }}" autocomplete="off" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Debe ingresar un nombre.</div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pt-3">
    <label class="form-label" for="du">DU: <span class="spinner-border spinner-border-sm d-none"></span></label>
    <input class="form-control" type="text" name="du" id="du" pattern="[0-9]{8}" autocomplete="off" readonly maxlength="8" value="{{ $competidor->du }}" placeholder="Ej: 23456789" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Deben ser 8 números</div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pt-3">
    <label class="form-label" for="fechaNacimiento">Nacimiento:</label>
    <input class="form-control validar" type="date" min="1900-01-01" max="{{ date('Y-m-d',strtotime('- 6 year'.date('Y-m-d'))); }}" value="{{ $competidor->fechaNacimiento }}" id="fechaNacimiento" name="fechaNacimiento" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Ingresa tu fecha de nacimiento!</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="correo">Email: <span class="spinner-border spinner-border-sm d-none"></span></label>
    <input class="form-control" type="email" id="correo" name="correo" autocomplete="off" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" value="{{ auth()->user()->correo }}" readonly placeholder="Ej: persona@correo.com" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Ej: persona@correo.com</div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pt-3">
    <label class="form-label" for="pais">País:</label>
    <input type='text' class="form-control tt-input validar" name="pais" id="pais" required>

    <input type='hidden' name="idPais" id="idPais">
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opción válida.</div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pt-3">
    <label class="form-label" for="estado">Estado:</label>
    <input type='text' class="form-control tt-input validar" name="estado" id="estado" required>
    <input type='hidden' name="idEstado" id="idEstado">
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opción válida.</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pt-3">
    <label class="form-label" for="genero">Género:</label>
    <select class="form-control validar" id="genero" name="genero" required>
        <option value="" disabled selected data-error="Por favor seleccione un género">Selecciona una opción</option>
        <option value="0" @if ($competidor->genero === 0) selected @endif>Masculino</option>
        <option value="1" @if ($competidor->genero === 1) selected @endif>Femenino</option>
    </select>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opción válida.</div>
</div>

<input type="number" value="{{$competidor->idCompetidor}}" name="idCompetidor" id="idCompetidor" readonly hidden>

<div class="col-md-12 my-3 d-flex justify-content-center align-items-center">
    <button id="botonSiguiente" type="button" class="btn btn-outline-primary w-25" onclick="showTab('paso2', 100)">
        <i class="bi bi-arrow-right me-2"></i>Siguiente
    </button>
</div>
