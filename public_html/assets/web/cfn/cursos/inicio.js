"use strict";

$( document ).ready(function() {

    $('.span_maps').click(event => {
        const url = event.currentTarget.getAttribute('data-href')
        if (url) {
            window.open(url, "_blank");
        }
    })

    // Animate on scroll for About section
    const aboutSection = document.querySelector('.about-section');
    if (aboutSection) {
        const animatedElements = aboutSection.querySelectorAll('.animate__animated');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = entry.target.getAttribute('data-delay') || 0;
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.classList.add('animate__fadeInUp');
                    }, parseInt(delay));
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        animatedElements.forEach(el => {
            el.style.opacity = '0';
            observer.observe(el);
        });
    }
});
