

alerta = $('#alerta-error');

function hide(){
    alerta.addClass('slideOutLeft');
}

setTimeout(() => {
    hide();
}, 4000);

alerta.click(hide); 
