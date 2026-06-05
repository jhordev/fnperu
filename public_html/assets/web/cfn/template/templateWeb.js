$(document).ready(function () {
    "use strict";



    /* --- Navbar scroll effect --- */
    var navbar = $("#navbar");

    $(window).on("scroll.navbar", function () {
        navbar.toggleClass("scrolled", $(this).scrollTop() > 50);
    });

    /* --- Mobile menu state --- */
    var toggle     = $("#navbarToggle");
    var mobileMenu = $("#navbarMobile");
    var isOpen     = false;

    function openMenu() {
        isOpen = true;
        mobileMenu.addClass("open");
        toggle.addClass("active").attr("aria-expanded", "true");
    }

    function closeMenu() {
        isOpen = false;
        mobileMenu.removeClass("open");
        toggle.removeClass("active").attr("aria-expanded", "false");
    }

    toggle.on("click", function () {
        isOpen ? closeMenu() : openMenu();
    });

    /* Close on any nav link tap */
    mobileMenu.find("a").on("click", closeMenu);

    /* Close when clicking outside the navbar */
    $(document).on("click.mobilemenu", function (e) {
        if (isOpen && !$(e.target).closest("#navbar").length) {
            closeMenu();
        }
    });

    /* Close on Escape key */
    $(document).on("keydown.mobilemenu", function (e) {
        if (e.key === "Escape" && isOpen) {
            closeMenu();
            toggle.trigger("focus");
        }
    });
});
