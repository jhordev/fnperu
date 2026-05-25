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
    var mobileClose = $("#mobileClose");
    var isOpen     = false;

    function openMenu() {
        isOpen = true;
        mobileMenu.addClass("open");
        toggle.addClass("active").attr("aria-expanded", "true");
        $("body").css("overflow", "hidden");
    }

    function closeMenu() {
        isOpen = false;
        mobileMenu.removeClass("open");
        toggle.removeClass("active").attr("aria-expanded", "false");
        $("body").css("overflow", "");
    }

    toggle.on("click", function () {
        isOpen ? closeMenu() : openMenu();
    });

    mobileClose.on("click", closeMenu);

    /* Close when clicking the dark backdrop (outside the panel) */
    mobileMenu.on("click", function (e) {
        if ($(e.target).is(mobileMenu)) {
            closeMenu();
        }
    });

    /* Close on any nav link tap */
    mobileMenu.find("a").on("click", closeMenu);

    /* Close on Escape key */
    $(document).on("keydown.mobilemenu", function (e) {
        if (e.key === "Escape" && isOpen) {
            closeMenu();
            toggle.trigger("focus");
        }
    });
});
