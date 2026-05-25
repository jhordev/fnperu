"use strict";

var bannersTable0, bannersTable1;

function initBannersTable(seccion) {
    var tableId  = '#banners_table_' + seccion;
    var instance = $('#banners_table_' + seccion).DataTable({
        ajax: {
            url: base_url + '/banners/getbanners?seccion=' + seccion,
            type: 'get',
            dataSrc: ''
        },
        columns: [
            { data: 'numero',        width: '4%'  },
            { data: 'preview',       width: '22%', orderable: false },
            { data: 'banner_imagen', width: '33%' },
            { data: 'activo_label',  width: '12%', orderable: false },
            { data: 'banner_creacion', width: '16%' },
            { data: 'acciones',      width: '13%', orderable: false }
        ],
        autoWidth: false,
        language: LanguageDataTable
    });
    return instance;
}

$(document).ready(function () {

    bannersTable0 = initBannersTable(0);

    /* Inicializar tab Urbanizaciones sólo al activarse (evita AJAX doble) */
    $('#tab-urb-btn').one('shown.bs.tab', function () {
        bannersTable1 = initBannersTable(1);
    });

    /* ── Subir banner ── */
    function handleSubir(formId, table) {
        $(formId).on('submit', function (e) {
            e.preventDefault();
            openSpinner();

            $.ajax({
                method: 'POST',
                url: base_url + '/banners/subir',
                data: new FormData(this),
                dataType: 'json',
                processData: false,
                contentType: false
            }).done(function (data) {
                if (data && data.status === true) {
                    $(formId)[0].reset();
                    if (table) { table.ajax.reload(null, false); }
                    Swal.fire({ icon: 'success', title: '¡Subido!', text: 'Banner agregado correctamente.', timer: 2200, showConfirmButton: false });
                } else {
                    AlertRQ.error({
                        title: data ? data.title   : 'ERROR',
                        text:  data ? data.message : 'Error desconocido',
                        type:  data ? data.type    : 'danger'
                    });
                }
                closeSpinner();
            }).fail(function () {
                AlertRQ.error({ title: 'ERROR', text: 'Error desconocido', type: 'danger' });
                closeSpinner();
            });
        });
    }

    handleSubir('#form_subir_0', bannersTable0);

    /* Para tab Urbanizaciones, el form se enlaza después de inicializar la tabla */
    $('#tab-urb-btn').one('shown.bs.tab', function () {
        handleSubir('#form_subir_1', bannersTable1);
    });

    /* ── Toggle activo ── */
    $(document).on('click', '.btn_toggle_banner', function () {
        var id     = $(this).data('id');
        var activo = $(this).data('activo');
        openSpinner();

        var fd = new FormData();
        fd.append('banner_id', id);
        fd.append('activo',    activo);

        $.ajax({
            method: 'POST', url: base_url + '/banners/toggleactivo',
            data: fd, dataType: 'json', processData: false, contentType: false
        }).done(function (data) {
            if (data && data.status === true) {
                if (bannersTable0) { bannersTable0.ajax.reload(null, false); }
                if (bannersTable1) { bannersTable1.ajax.reload(null, false); }
            } else {
                AlertRQ.error({ title: 'ERROR', text: 'No se pudo actualizar el estado', type: 'danger' });
            }
            closeSpinner();
        }).fail(function () {
            AlertRQ.error({ title: 'ERROR', text: 'Error desconocido', type: 'danger' });
            closeSpinner();
        });
    });

    /* ── Eliminar ── */
    $(document).on('click', '.btn_delete_banner', function () {
        var id  = $(this).data('id');
        var img = $(this).data('img');

        Swal.fire({
            icon: 'question',
            title: 'Eliminar banner',
            text: '¿Seguro que deseas eliminar este banner? Esta acción no se puede deshacer.',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(function (result) {
            if (!result.isConfirmed) { return; }
            openSpinner();

            var fd = new FormData();
            fd.append('banner_id',  id);
            fd.append('banner_img', img);

            $.ajax({
                method: 'POST', url: base_url + '/banners/eliminar',
                data: fd, dataType: 'json', processData: false, contentType: false
            }).done(function (data) {
                if (data && data.status === true) {
                    if (bannersTable0) { bannersTable0.ajax.reload(null, false); }
                    if (bannersTable1) { bannersTable1.ajax.reload(null, false); }
                    Swal.fire({ icon: 'success', title: 'Eliminado', timer: 1800, showConfirmButton: false });
                } else {
                    AlertRQ.error({ title: 'ERROR', text: 'No se pudo eliminar', type: 'danger' });
                }
                closeSpinner();
            }).fail(function () {
                AlertRQ.error({ title: 'ERROR', text: 'Error desconocido', type: 'danger' });
                closeSpinner();
            });
        });
    });

});
