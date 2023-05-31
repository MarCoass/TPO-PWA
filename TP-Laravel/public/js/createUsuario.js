const $selectRol = document.getElementById('rol');
const $selectEscuela = document.getElementById('idEscuela');

$selectRol.addEventListener('input', () => {
    let value = $selectRol.value;

    if (value == 1) {
        $selectEscuela.value = "";
        $selectEscuela.disabled = true;
    } else {

        $selectEscuela.disabled = false;
    }
})