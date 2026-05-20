'use strict'

$(document).ready(() => {

    $('#cursos_table').DataTable({
        select: true,
        ajax: {
            "url": base_url + '/urbanizaciones/gettable',
            "type": "get",
            "dataSrc": "",
        },
        columns: [
            { data: 'number' },
            { data: 'name' },
            { data: 'plan' },
            { data: 'public' },
            { data: 'created' },
            { data: 'actions' }
        ],
        language: LanguageDataTable
    });

    const form = {
        element: document.getElementById('from_new'),
        name: document.getElementById('form_name')
    }

    document.getElementById('modal_new').addEventListener('shown.bs.modal', function () {
        form.name.value = ''
        form.name.focus()
    });

    form.element.addEventListener('submit', event => {

        event.preventDefault()
        openSpinner()

        const payload = new FormData(event.target)

        $.ajax({
            method: 'POST',
            url: base_url + '/urbanizaciones/create',
            data: payload,
            dataType: 'json',
            processData: false,     // tell jQuery not to process the data
            contentType: false      // tell jQuery not to set contentType
        }).done(function(data) {

            if (data == null)
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
                window.location = base_url + '/urbanizaciones/editar/' + data.id;
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
