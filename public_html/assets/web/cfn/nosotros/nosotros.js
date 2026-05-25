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

    // Animate on scroll
    const animatedElements = document.querySelectorAll('.animate__animated');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const anim = entry.target.getAttribute('data-animation') || 'fadeInUp';
                const delay = entry.target.getAttribute('data-delay') || 0;
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.classList.add('animate__' + anim);
                }, parseInt(delay));
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        observer.observe(el);
    });

});