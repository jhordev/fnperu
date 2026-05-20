"use strict";

$(document).ready(() => {

    $('#cursos_table').DataTable({
        select: true,
        ajax: {
            "url": base_url + '/cursos/getcursosactivos',
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

    let from_newcurso = $('#from_newcurso');

    document.getElementById('modal_newcurso').addEventListener('shown.bs.modal', function (event) {
        from_newcurso.find('#nameCurso').focus().val('');
    });

    from_newcurso.submit(function(e) {

        e.preventDefault();
        openSpinner();

        $.ajax({
            method: 'POST',
            url: base_url + '/cursos/newcurso',
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
                window.location = base_url + '/cursos/editar/' + data.id;
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