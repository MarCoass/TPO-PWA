<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="apellido">Apellido:</label>
    <input class="form-control" type="text" id="apellido" name="apellido" maxlength="50" pattern="^(?=.{3,})([A-ZÁÉÍÓÚÜÑ][a-záéíóúüñ]{2,})(?:\s[A-ZÁÉÍÓÚÜÑ][a-záéíóúüñ]{2,})?$" placeholder="Ej: Lopez" autocomplete="off" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">La primer letra de cada apellido debe ser mayúscula</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="nombre">Nombre:</label>
    <input class="form-control" type="text" id="nombre" name="nombre" maxlength="50" pattern="^(?=.{3,})([A-ZÁÉÍÓÚÜÑ][a-záéíóúüñ]{2,})(?:\s[A-ZÁÉÍÓÚÜÑ][a-záéíóúüñ]{2,})?$" placeholder="Ej: Lautaro" autocomplete="off" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">La primer letra de cada nombre debe ser mayúscula</div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pt-3">
    <label class="form-label" for="dni">DNI:</label>
    <input class="form-control " type="text" name="dni" id="dni" pattern="[0-9]{8}" autocomplete="off" maxlength="8" placeholder="Ej: 23456789" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Deben ser 8 números</div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="fechaNacimiento">Nacimiento:</label>
    <input class="form-control" type="date" min="1900-01-01" id="fechaNacimiento" name="fechaNacimiento" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Ingresa tu fecha de nacimiento!</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="email">Email:</label>
    <input class="form-control" type="email" id="email" name="email" autocomplete="off" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="Ej: persona@correo.com" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Ej: persona@correo.com</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="paisOrigen">País:</label>
    <input class="form-control" type="text" id="paisOrigen" name="paisOrigen" list="lipaises" required>
    <datalist id="lipaises">
    </datalist>

    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="genero">Género:</label>
    <select class="form-control" id="genero" name="genero" required>
        <option value="" disabled selected data-error="Por favor seleccione un genero">Selecciona una opción</option>
        <option value="masculino">Masculino</option>
        <option value="femenino">Femenino</option>
    </select>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>

<div class="my-3 ml-3 row justify-content-center">
    <button type="button" class="btn btn-outline-primary col-md-4 col-sm-6 col-xs-8" onclick="showTab('paso2', 'link2', 'link1')">
        <i class="bi bi-arrow-right me-2"></i>Siguiente
    </button>
</div>