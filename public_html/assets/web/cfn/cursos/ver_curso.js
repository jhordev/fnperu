"use strict";

$( document ).ready(function() {

    let btn_matricula = $('#btn_matricula');
    let modal_newsolicitud = $('#modal_newsolicitud');

    btn_matricula.click(function () {
       
        modal_newsolicitud.modal('show');
        
    });

    $('#from_newsolicitud').submit(function (e) {
       
        e.preventDefault();
        openSpinner();

        let formData = new FormData(this);

        $.ajax({
            method: 'POST',
            url: base_url + '/solicitudmatricula/enviar',
            data: formData,
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
                closeSpinner(); 
                    
                Swal.fire({
                    title: 'Solicitud Enviada',
                    icon: 'success'
                }).then((result) => {

                    location.reload();

                });
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