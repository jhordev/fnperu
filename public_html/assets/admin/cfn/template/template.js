"use strict";

$(document).ready(function (){

    $(".vertical-nav-menu").metisMenu();

    $(".close-sidebar-btn").click(function() {

        var t = $(this).attr("data-class");
        $(".app-container").toggleClass(t);
        $(".app-header-left .logo-src").toggleClass('d-none');
        var n = $(this);
        n.hasClass("is-active") ? n.removeClass("is-active") : n.addClass("is-active")
        
    });

    $(".mobile-toggle-nav").click(function() {
        $(this).toggleClass("is-active"),
        $(".app-container").toggleClass("sidebar-mobile-open")
    });

});