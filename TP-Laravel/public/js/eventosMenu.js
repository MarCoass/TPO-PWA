/* código que agrega una escucha de eventos al documento, este detecta cuando se presiona una tecla 
y verifica si la tecla presionada es “m” y si la tecla Alt está presionada al mismo tiempo. 
Si ambas condiciones son verdaderas, se simulará un clic */
document.addEventListener('keyup', function (event) {
    let menuNav = document.getElementById('menuNavBar');
    if (event.altKey && event.key === 'm') {
        menuNav.click();
    }
});
