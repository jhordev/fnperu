"use strict";

$(document).ready(() => {

    $('#talleres_table').DataTable({
        select: true,
        ajax: {
            "url": base_url + '/talleres/gettalleres',
            "type": "get",
            "dataSrc": "",
        },
        columns: [
            { data: 'numero' },
            { data: 'curso_nombre' },
            { data: 'curso_brochure' },
            { data: 'curso_publico' },
            { data: 'curso_creacion' },
            { data: 'acciones' }
        ],
        language: LanguageDataTable
    });

    let from_newtaller = $('#from_newtaller');

    document.getElementById('modal_newtaller').addEventListener('shown.bs.modal', function (event) {
        from_newtaller.find('#nameTaller').focus().val('');
    });

    from_newtaller.submit(function(e) {

        e.preventDefault();
        openSpinner();

        $.ajax({
            method: 'POST',
            url: base_url + '/talleres/newtaller',
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
                window.location = base_url + '/talleres/editar/' + data.id;
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