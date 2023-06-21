<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="gal">GAL: <span class="spinner-border spinner-border-sm d-none"></span></label>
    <input class="form-control validarEspecial" {{ $galDesactivado }} value="{{ $competidor->gal }}" type="text"
        id="gal" name="gal" autocomplete="off" pattern="^[A-Z]{3}\d{7}$" maxlength="10"
        placeholder="Ej: ABC1234567" required>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Campo necesario, necesita 3 letras mayúsculas seguidas de 7 números</div>
    <span class="text-secondary">El GAL sólo está disponible para Cinturones Negros.</span>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="competencia">Competencia:</label>
    <select class="form-control validar" id="competencia" name="competencia" required>
        <option value="" disabled selected data-error="Por favor seleccione una Competencia válida">Selecciona una
            Competencia.</option>
        @foreach ($competencias as $row)
            <option value="{{ $row->idCompetencia }}">{{ $row->nombre }}</option>
        @endforeach
    </select>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opción válida.</div>
</div>

<div class="col-12 row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
        <div class="form-check text-center mt-4">
            <input class="form-check-input" type="checkbox" name="checkGraduacion" id="checkGraduacion">
            <label class="form-check-label" for="checkGraduacion">
                Seleccionar si desea actualizar su graduación.
            </label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
        <label class="form-label" for="graduacion">Graduacion:</label>

        <select class="form-control validar" disabled id="idGraduacion" name="idGraduacion" required>
            <option value="" disabled selected data-error="Por favor seleccione una graduacion válida">Selecciona
                una graduación.</option>
            @for ($i = 0; $i < count($graduaciones); $i++)
                @if ($i == 0)
                    <option value="{{ $graduaciones[$i]->idGraduacion }}" selected> {{ $graduaciones[$i]->nombre }} -
                        {{ $graduaciones[$i]->color }}</option>
                @else
                    <option value="{{ $graduaciones[$i]->idGraduacion }}"> {{ $graduaciones[$i]->nombre }} -
                        {{ $graduaciones[$i]->color }}</option>
                @endif
            @endfor
        </select>
        <div class="valid-feedback">
            ¡Correcto!
        </div>
        <div class="invalid-feedback">Seleccione una opcion valida.</div>
    </div>
</div>

<input type="number" name="graduacionActual" id="graduacionActual" hidden
    value="{{ $graduaciones[0]->idGraduacion }}">

<div class="col-12 row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
        <div class="form-check text-center mt-4">
            <input class="form-check-input" type="checkbox" name="checkEscuela" id="checkEscuela">
            <label class="form-check-label" for="checkEscuela">
                Seleccionar si desea actualizar su escuela.
            </label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  pt-3">
        <label class="form-label" for="graduacion">Escuela:</label>

        <select class="form-control validar" disabled id="idEscuela" name="idEscuela" required>
            <option value="" disabled selected data-error="Por favor seleccione una graduacion válida">Selecciona
                una graduación.</option>
            @for ($i = 0; $i < count($escuelas); $i++)
                @if ($i == 0)
                    <option value="{{ $escuelas[$i]->idEscuela }}" selected> {{ $escuelas[$i]->nombre }}</option>
                @else
                    <option value="{{ $escuelas[$i]->idEscuela }}"> {{ $escuelas[$i]->nombre }}</option>
                @endif
            @endfor
        </select>
        <div class="valid-feedback">
            ¡Correcto!
        </div>
        <div class="invalid-feedback">Seleccione una opcion válida.</div>
    </div>
</div>

<div class="col-md-12 my-3 d-flex justify-content-center align-items-center">
    <button type="button" id="botonVolver" class="btn btn-outline-primary w-25 me-2" onclick="showTab('paso1', 0)">
        <i class="bi bi-arrow-left me-2"></i>Volver
    </button>
    <button type="submit" id="botonGuardarCompetidor" class="btn btn-outline-success w-25">
        <span class="spinner-border spinner-border-sm d-none"></span> <i
            class="bi bi-cloud-arrow-up-fill me-2"></i>Guardar
    </button>
</div>

<script>
    // Obtener referencias a los elementos del DOM
    var graduacionSelect = document.getElementById('idGraduacion');
    var galInput = document.getElementById('gal');

    // Agregar un event listener al cambio de selección de graduación
    graduacionSelect.addEventListener('change', function() {
        // Obtener el texto de la opción seleccionada
        var selectedOptionText = this.options[this.selectedIndex].text;

        // Verificar si el texto contiene "Cinturón negro"
        if (selectedOptionText.includes('Cinturón negro')) {
            // Habilitar el primer campo de entrada
            galInput.disabled = false;
        } else {
            // Deshabilitar el primer campo de entrada
            galInput.disabled = true;
        }
    });
    
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener referencias a los elementos
        var checkGraduacion = document.getElementById("checkGraduacion");
        var idGraduacion = document.getElementById("idGraduacion");
        var checkEscuela = document.getElementById("checkEscuela");
        var idEscuela = document.getElementById("idEscuela");

        // Evento de cambio en el checkbox de graduación
        checkGraduacion.addEventListener("change", function() {
            if (this.checked) {
                idGraduacion.disabled = false;
            } else {
                idGraduacion.disabled = true;
            }
        });

        // Evento de cambio en el checkbox de escuela
        checkEscuela.addEventListener("change", function() {
            if (this.checked) {
                idEscuela.disabled = false;
            } else {
                idEscuela.disabled = true;
            }
        });
    });
</script>
