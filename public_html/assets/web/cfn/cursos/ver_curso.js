"use strict";

$(document).ready(function () {

    /* ── Botón Matricúlate (cuando hay lanzamiento) ── */
    let btn_matricula     = $('#btn_matricula');
    let modal_newsolicitud = $('#modal_newsolicitud');

    btn_matricula.click(function () {
        modal_newsolicitud.modal('show');
    });

    $('#from_newsolicitud').submit(function (e) {
        e.preventDefault();
        openSpinner();

        $.ajax({
            method: 'POST',
            url: base_url + '/solicitudmatricula/enviar',
            data: new FormData(this),
            dataType: 'json',
            processData: false,
            contentType: false
        }).done(function (data) {

            if (data && data.status === true) {
                closeSpinner();
                Swal.fire({ title: 'Solicitud Enviada', icon: 'success' }).then(() => { location.reload(); });
            } else {
                AlertRQ.error({
                    title: data ? data.title : 'ERROR',
                    text:  data ? data.message : 'Ocurrió un error desconocido',
                    type:  data ? data.type  : 'danger'
                });
                closeSpinner();
            }

        }).fail(function () {
            AlertRQ.error({ title: 'ERROR', text: 'Ocurrió un error desconocido', type: 'danger' });
            closeSpinner();
        });
    });

    /* ── Formulario de interés (cuando NO hay lanzamiento activo) ── */
    $('#from_interes').submit(function (e) {
        e.preventDefault();
        openSpinner();

        $.ajax({
            method: 'POST',
            url: base_url + '/cursos/registrarinteres',
            data: new FormData(this),
            dataType: 'json',
            processData: false,
            contentType: false
        }).done(function (data) {

            if (data && data.status === true) {
                closeSpinner();
                $('#modal_interes').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: '¡Registrado!',
                    text: 'Te avisaremos en cuanto abramos la matrícula para este curso.',
                    confirmButtonText: 'Entendido'
                });
            } else {
                AlertRQ.error({
                    title: data ? data.title : 'ERROR',
                    text:  data ? data.message : 'Ocurrió un error desconocido',
                    type:  data ? data.type  : 'danger'
                });
                closeSpinner();
            }

        }).fail(function () {
            AlertRQ.error({ title: 'ERROR', text: 'Ocurrió un error desconocido', type: 'danger' });
            closeSpinner();
        });
    });

});
