

//ESTO ES EL ESPACIADO AUTOMATICO DEL MENU CUANDO SE ABRE O CIERRA

content_body = $('#navPush');

function push_content(){

    if(content_body.length == '1'){

        if(estado_suiche === 'false'){

            content_body[0].style.paddingLeft = '15px';
        }else{

            content_body[0].style.paddingLeft = '70px';
        }

    }
}

//
//
// ESTO ES EL MENU DEL SITEMA
//
//



suiche        = $('nav > .body > .item.main');
body          = $('nav > .body');
body_childs   = $('nav > .body').children();

if(Cookies.get('navbar_status') !== undefined){

    estado_suiche = Cookies.get('navbar_status');
}else{

    estado_suiche = 'true';
}


function cambiar_estado_suiche(){

    console.log(estado_suiche);

    if(estado_suiche == 'false'){

        Cookies.set('navbar_status', 'true');
        estado_suiche = 'true';
    }else{

        Cookies.set('navbar_status', 'false');
        estado_suiche = 'false';
    }

    animar_menu();

    console.log(estado_suiche);
}

function animar_menu(){

    let childs_q = body_childs.length - 1;
    let height   = (childs_q * 60) + 50;

    if(estado_suiche == 'true'){

        body.height(height + 'px');
    }else{

        body.height('50px');
    }

    push_content();
}

suiche.click(cambiar_estado_suiche);
animar_menu();

setTimeout(() => {
    body.addClass('transition');
    content_body[0].style.transition = 'padding-left .4s ease-in';
},100);


//
//
// ESTO ES EL MENU DE USUARIO (mu = menu usuario)
//
//

//menu abierto o cerrado
mu_estado    = true;
mu_abrir     = $('header > .usuario');
mu_cerrar    = $('header > .usuario > .menu > .title > .cerrar');
mu_menu      = $('header > .usuario > .menu');
mu_contenido = $('header > .usuario > .menu > .contenido');

function cambiar_mu(){

    //abrir
    if(mu_estado == false){

        hijos   = mu_contenido.children();
        hijos_q = hijos.length;

        altura  = (50 * hijos_q) + 45;

        mu_menu.width('250px');
        setTimeout(function(){
            mu_menu.height(altura + 'px');
        }, 100);
        mu_abrir.addClass('abierto');

        mu_estado = true;
        setTimeout(function(){
            mu_cerrar.one('click', cambiar_mu);
        }, 50);

    }

    //cerrar
    else if(mu_estado == true){

        setTimeout(function(){
            mu_menu.width('150px');
        }, 100);
        mu_menu.height('40px');
        mu_abrir.removeClass('abierto');

        mu_estado = false;
        setTimeout(function(){mu_abrir.one('click', cambiar_mu);}, 50);
    }
}

cambiar_mu();




$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

(function() {
'use strict';
window.addEventListener('load', function() {
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.getElementsByClassName('validar');
  // Loop over them and prevent submission
  var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
}, false);
})();
