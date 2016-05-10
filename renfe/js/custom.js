$(document).ready(function() {
    var w = $(window).innerWidth();
    var h = $(window).innerHeight();
    
    $('#homepage-wrapper').css('width', w);
    $('#homepage-wrapper').css('height', h);
    $('#page-wrapper').css('width', w);
    $('#page-wrapper').css('height', h);
    $('#home-content-wrapper').css('margin-top', h*0.05);
    $('#home-content-wrapper').css('height', h*0.64);
    $('#home-content-wrapper').css('margin-top', h*0.03);
    
    var bh = $('#home-content-wrapper .book').height();
    $('#home-content-wrapper .home-start').css('margin-top', 70*bh/570);
    $('.home-start h5').css('font-size', 40*bh/570);
    $('.home-start h2').css('font-size', 50*bh/570);
    $('.home-start p').css('font-size', 18*bh/570);
    $('a.btn-start').css('font-size', 28*bh/570);
    var dw = $('.diary-footer').width();
    $('.diary-footer').css('height', dw*269/1159);
    
    $( window ).resize(function() {
        var w = $(window).innerWidth();
        var h = $(window).innerHeight();
        
        $('#homepage-wrapper').css('width', w);
        $('#homepage-wrapper').css('height', h);
        $('#page-wrapper').css('width', w);
        $('#page-wrapper').css('height', h);
        $('#home-content-wrapper').css('margin-top', h*0.05);
        $('#home-content-wrapper').css('height', h*0.64);
        $('#home-content-wrapper').css('margin-top', h*0.03);
        
        var bh = $('#home-content-wrapper .book').height();
        $('#home-content-wrapper .home-start').css('margin-top', 70*bh/570);
        $('.home-start h5').css('font-size', 40*bh/570);
        $('.home-start h2').css('font-size', 50*bh/570);
        $('.home-start p').css('font-size', 18*bh/570);
        $('a.btn-start').css('font-size', 28*bh/570);
        
        var dw = $('.diary-footer').width();
        $('.diary-footer').css('height', dw*269/1159);
    });
    
    jQuery('#page-wrapper').scroll(function(){
        var e=jQuery(this).scrollTop();
        if(e>=100){
            jQuery("#header").addClass("fixed-header");
            jQuery('.blank-header').css('display', 'block');
            jQuery('.scroll-top-wrapper').fadeIn();
        } else if(e<100){
            jQuery("#header").removeClass("fixed-header")
            jQuery('.blank-header').css('display', 'none');
            jQuery('.scroll-top-wrapper').fadeOut();
        }
    });
    jQuery('.scroll-top-wrapper a').click(function () {
        jQuery('#page-wrapper').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    jQuery('.scroll-top-wrapper').hide();
    
    $('#main-content-wrapper .train .train-image a').on('click', function(){
        $('#main-content-wrapper .train .train-image a').each(function(idx, obj){
            $(obj).removeClass('active');
            $(obj).parent().parent().find('.route-wrapper').hide();
        });
        $(this).addClass("active");
        $(this).parent().parent().find('.route-wrapper').slideToggle();
    });
    $('.train .route-wrapper li a').on('click', function(){
        window.location.href = "edit.html";
    });
    
    if ( $('.flexslider').length > 0 ) {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: false
        });
    }
});

/*

jQuery(document).scroll(function(){
    var e=jQuery(this).scrollTop();
    if(e>=50){
        jQuery("#header").addClass("fixed-header")
    } else if(e<50){
        jQuery("#header").removeClass("fixed-header")
    }
});

  scroll top
 jQuery(document).ready(function(){
var IE='\v'=='v';
// hide #back-top first
jQuery("#back-top").hide();
// fade in #back-top
jQuery(function () {
jQuery(window).scroll(function () {
if (!IE) {
if (jQuery(this).scrollTop() > 100) {
jQuery('#back-top').fadeIn();
} else {
jQuery('#back-top').fadeOut();
}
}
else {
if (jQuery(this).scrollTop() > 100) {
jQuery('#back-top').show();
} else {
jQuery('#back-top').hide();
}
}
});
// scroll body to 0px on click
jQuery('#back-top a').click(function () {
jQuery('body,html').animate({
scrollTop: 0
}, 800);
return false;
});
}); 
*/