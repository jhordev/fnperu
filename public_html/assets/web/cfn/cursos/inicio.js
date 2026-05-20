"use strict";

$( document ).ready(function() {

    $('.span_maps').click(event => {
        const url = event.currentTarget.getAttribute('data-href')
        if (url) {
            window.open(url, "_blank");
        }
    })
});
