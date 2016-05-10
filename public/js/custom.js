function nuevoAjax()
{ 
    var xmlhttp=false; 
    try 
    { 
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
    }
    catch(e)
    { 
        try
        { 
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
        } 
        catch(E) { xmlhttp=false; }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

    return xmlhttp; 
}

function cargarFragmento(fragment_url, element_id) {
    var aleatorio=Math.random();
    peticion2=nuevoAjax();
    var element = document.getElementById(element_id);
    element.innerHTML = '<p><img src="img/ajax_load.gif" /></p>';
    peticion2.open("GET", fragment_url+'&e='+aleatorio);
    peticion2.onreadystatechange = function() {
        if (peticion2.readyState == 4) {
        element.innerHTML = peticion2.responseText; 
        } 
    } 
    peticion2.send(null); 
}
$(document).ready(function(){
    //parametros principales
    
    var contenidoHTML = '<button onclick=\"closeModal()\">Cerrar</button>';
    
    var ancho = 900; 
    var alto = 450;
    $(window).resize(function(){
        // dimensiones de la ventana
        var wscr = $(window).width();
        var hscr = $(window).height();

        // estableciendo dimensiones de background
        $('#capa_sombra').css("width", wscr);
        $('#capa_sombra').css("height", hscr);
        
        // definiendo tamaño del contenedor
        $('#capa_ventana').css("width", ancho+'px');
        $('#capa_ventana').css("height", alto+'px');
        
        // obtiendo tamaño de contenedor
        var wcnt = $('#capa_ventana').width();
        var hcnt = $('#capa_ventana').height();
        
        // obtener posicion central
        var mleft = ( wscr - wcnt ) / 2;
        var mtop = ( hscr - hcnt ) / 2;
        
        // estableciendo posicion
        $('#capa_ventana').css("left", mleft+'px');
        $('#capa_ventana').css("top", mtop+'px');
    });
    
    $('#forgot_password').on('click', function(){
        var email = $('#email').val();
        if ( email == "" ) {
            alert("Por favor, introduzca su dirección de correo electrónico!");
            return;
        }
        $('#is_forgot').val('1');
        $('#loginForm').submit();
    });
    
    $('#mobile-menu-tab').on('click', function(){
        $('#mobile-menu .mobile-menu-wrapper').slideToggle();
    });
    
    $(window).keyup(function(event){
           if (event.keyCode == 27) {
            closeModal();
           }
    });
    
    if(navigator.userAgent.indexOf("MSIE") > 0 ) {
        var textColor = '#777777'; //custom color

        $('[placeholder]').each(function() {
            $(this).attr('tooltip', $(this).attr('placeholder')); //buffer

            if ($(this).val() === '' || $(this).val() === $(this).attr('placeholder')) {
                $(this).css('color', textColor).css('font-style','italic');
                $(this).val($(this).attr('placeholder')); //IE8 compatibility
            }

            $(this).attr('placeholder',''); //disable default behavior

            $(this).focus(function() {
                if ($(this).val() === $(this).attr('tooltip')) {
                    $(this).val('');
                }
            });

            $(this).keydown(function() {
                $(this).css('font-style','normal').css('color','#000');
            });

            $(this).blur(function() {
                if ($(this).val()  === '') {
                    $(this).val($(this).attr('tooltip')).css('color', textColor).css('font-style','italic');
                }
            });
        });
    }
    
 });
function openModal(num){
        
    var wscr = $(window).width();
    var hscr = $(window).height();
    cargarFragmento(num + '?d=1','capa_ventana');
    $('#capa_sombra').css("width", wscr);
    $('#capa_sombra').css("height", hscr);
    $('#capa_ventana').css("display",'block');
    $('#capa_sombra').css("display",'block');
    $('#capa_ventana').show(1000);
    $('#capa_sombra').show(2000);
    
    $(window).resize();
};          
function closeModal(){
    $('#capa_ventana').css("display",'none');
    $('#capa_sombra').css("display",'none');
}