$tipo = document.getElementById('tipo');
$color = document.getElementById('color');

$tipo.addEventListener('input',() => {
    if($tipo.value === 'DAN'){
        $color.disabled = true;
    }else{
        $color.disabled = false;
    }
})