"use strict";

$(document).ready(function () {

    $('#form_login').submit(function (e) {
       
        e.preventDefault();
        openSpinner();

        $.ajax({
            method: 'POST',
            url: base_url + '/login/user',
            data: new FormData(this),
            dataType: 'json',
            processData: false,     // tell jQuery not to process the data
            contentType: false      // tell jQuery not to set contentType
        }).done(function(data) {
            
            if (data == null || data == undefined) 
            { 
                AlertRQ.error({
                    title : 'ERROR',
                    text : 'Ocurrió un error desconocido',
                    type : 'danger'
                });

                closeSpinner();
            }
            else if(data.status === true) 
            {
                window.location = base_url;
            }
            else if(data.status === false)
            {
                AlertRQ.error({
                    title : data.title,
                    text :  data.message,
                    type :  data.type
                });

                closeSpinner();
            }
            else
            { 
                AlertRQ.error({
                    title : 'ERROR',
                    text : 'Ocurrió un error desconocido',
                    type : 'danger'
                });

                closeSpinner();
            }

        }).fail(function() {

            AlertRQ.error({
                title : 'ERROR',
                text : 'Ocurrió un error desconocido',
                type : 'danger'
            });

            closeSpinner();
        });

    });

});