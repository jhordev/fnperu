$( document ).ready(function() {

	"use strict";

    $("#preloader_page").animate({
        'opacity': '0'
    }, 600, function(){
        setTimeout(function(){
            $("#preloader_page").css("visibility", "hidden").fadeOut();
        }, 300);
    });

    let menu_inferior = $('#menu_inferior');

    $('.btn_menu_main').click(function() {

        menu_inferior.toggle();

    });

    menu_inferior.click(function() {

        menu_inferior.toggle();

    });

});
