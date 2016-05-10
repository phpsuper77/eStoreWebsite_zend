function IsWhole(nombrecampo,theForm)
    {
        if (theForm.value == "" || theForm.value == null)
        {
            alert("Debe insertar alg\u00fan valor en el campo " + nombrecampo);
            theForm.focus();
            return (false);
        }
        return (true);
    }
function Is_Numeric(nombrecampo,theForm){

    if (isNaN(theForm.value.replace(",","."))){
        alert("S\u00f3lo se pueden escribir n\u00fameros en el campo " + nombrecampo);
        theForm.focus();
        return (false);
    }else{
        return (true);    
    }

}

function IsInt(nombrecampo,theForm){

    if (parseInt(theForm.value)==theForm.value){
        return (true);
    }else{
        alert("S\u00f3lo se pueden escribir n\u00fameros enteros en el campo " + nombrecampo);
        theForm.focus();
        return (false);
    }

}

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
    
    var ancho = 600; 
    var alto = 350;
    $(window).resize(function(){
        // dimensiones de la ventana
        var wscr = $(window).width();
        var hscr = $(window).height();

        // estableciendo dimensiones de background
        $('#capa_sombra').css("width", wscr);
        $('#capa_sombra').css("height", hscr);
        
        // definiendo tama�o del contenedor
        $('#capa_ventana').css("width", ancho+'px');
        $('#capa_ventana').css("height", alto+'px');
        
        // obtiendo tama�o de contenedor
        var wcnt = $('#capa_ventana').width();
        var hcnt = $('#capa_ventana').height();
        
        // obtener posicion central
        var mleft = ( wscr - wcnt ) / 2;
        var mtop = ( hscr - hcnt ) / 2;
        
        // estableciendo posicion
        $('#capa_ventana').css("left", mleft+'px');
        $('#capa_ventana').css("top", mtop+'px');
    });
    
    $('#mobile-menu-tab').on('click', function(){
        $('#mobile-menu .mobile-menu-wrapper').slideToggle();
    });
    
    $(window).keyup(function(event){
           if (event.keyCode == 27) {
            closeModal();
           }
    });
    
 });     
function closeModal(){
    $('#capa_ventana').css("display",'none');
    $('#capa_sombra').css("display",'none');
    location.reload();
}

