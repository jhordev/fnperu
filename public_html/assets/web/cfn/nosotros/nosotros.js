$( document ).ready(function() {

	"use strict";

    $('.owl-clients').owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        items: 1,
        margin: 30,
        autoplay: true,
        smartSpeed: 700,
        autoplayTimeout: 4500,
        responsive: {
            0: {
                items: 1,
                margin: 0
            },
            460: {
                items: 1,
                margin: 0
            },
            576: {
                items: 3,
                margin: 20
            },
            992: {
                items: 5,
                margin: 30
            }
        }
    });

});