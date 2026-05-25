"use strict";

$(document).ready(() => {

    let cursos_list = $('#cursos_list');

    new Sortable(cursos_list[0], {
        handle: '.cursos_each i',
        animation: 150,
        dragClass: 'ocultar_drag',
        store: {
            set: (sortable) => {
                
                openSpinner();
                let formData = new FormData();
                formData.append('data', sortable.toArray().join('-'));

                $.ajax({
                    method: 'POST',
                    url: base_url + '/talleres/ponerorden',
                    data: formData,
                    dataType: 'json',
                    processData: false,     // tell jQuery not to process the data
                    contentType: false      // tell jQuery not to set contentType
                }).done(function(data) {
                    
                    if (data == null || data == undefined) 
                    { 
                        window.location.reload();
                    }
                    else if(data.status === true) 
                    {
                        closeSpinner();
                    }
                    else
                    {
                        window.location.reload();
                    }

                }).fail(function() {

                    window.location.reload();

                });
                
            }
        }
    });

});