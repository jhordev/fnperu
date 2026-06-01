"use strict";

var bannersTable0, bannersTable1, bannersTable2;

/* ══════════════════════════════════════════════
   DataTable genérico (todas las tabs)
══════════════════════════════════════════════ */

function initBannersTable(seccion) {
    return $('#banners_table_' + seccion).DataTable({
        ajax: { url: base_url + '/banners/getbanners?seccion=' + seccion, type: 'get', dataSrc: '' },
        columns: [
            { data: 'numero',          width: '8%'  },
            { data: 'preview',         width: '22%', orderable: false },
            { data: 'banner_imagen',   width: '28%' },
            { data: 'activo_label',    width: '12%', orderable: false },
            { data: 'banner_creacion', width: '17%' },
            { data: 'acciones',        width: '13%', orderable: false }
        ],
        autoWidth: false, language: LanguageDataTable
    });
}

/* ══════════════════════════════════════════════
   Upload handlers
══════════════════════════════════════════════ */

function handleSubir(formId, table) {
    $(formId).on('submit', function (e) {
        e.preventDefault();
        openSpinner();
        $.ajax({
            method: 'POST', url: base_url + '/banners/subir',
            data: new FormData(this), dataType: 'json', processData: false, contentType: false
        }).done(function (data) {
            if (data && data.status === true) {
                $(formId)[0].reset();
                if (table) { table.ajax.reload(null, false); }
                Swal.fire({ icon: 'success', title: '¡Subido!', timer: 2000, showConfirmButton: false });
            } else {
                AlertRQ.error({ title: data ? data.title : 'ERROR', text: data ? data.message : 'Error', type: data ? data.type : 'danger' });
            }
            closeSpinner();
        }).fail(function () {
            AlertRQ.error({ title: 'ERROR', text: 'Error desconocido', type: 'danger' });
            closeSpinner();
        });
    });
}

function handleSubirSlot(formId, table) {
    $(formId).on('submit', function (e) {
        e.preventDefault();
        openSpinner();
        $.ajax({
            method: 'POST', url: base_url + '/banners/subirslot',
            data: new FormData(this), dataType: 'json', processData: false, contentType: false
        }).done(function (data) {
            if (data && data.status === true) {
                $(formId)[0].reset();
                if (table) { table.ajax.reload(null, false); }
                Swal.fire({ icon: 'success', title: '¡Guardado!', timer: 1800, showConfirmButton: false });
            } else {
                AlertRQ.error({ title: data ? data.title : 'ERROR', text: data ? data.message : 'Error desconocido', type: data ? data.type : 'danger' });
            }
            closeSpinner();
        }).fail(function () {
            AlertRQ.error({ title: 'ERROR', text: 'Error desconocido', type: 'danger' });
            closeSpinner();
        });
    });
}

/* ══════════════════════════════════════════════
   INIT
══════════════════════════════════════════════ */

$(document).ready(function () {

    /* Hero Home es la tab activa por defecto — inicializar directo */
    bannersTable2 = initBannersTable(2);
    handleSubirSlot('#form_slot_home', bannersTable2);

    /* Otras tabs — lazy */
    $('#tab-urb-btn').one('shown.bs.tab', function () {
        bannersTable1 = initBannersTable(1);
        handleSubir('#form_subir_1', bannersTable1);
    });

    $('#tab-cursos-btn').one('shown.bs.tab', function () {
        bannersTable0 = initBannersTable(0);
        handleSubir('#form_subir_0', bannersTable0);
    });

    /* Toggle activo */
    $(document).on('click', '.btn_toggle_banner', function () {
        var id = $(this).data('id'), activo = $(this).data('activo');
        openSpinner();
        var fd = new FormData(); fd.append('banner_id', id); fd.append('activo', activo);
        $.ajax({ method: 'POST', url: base_url + '/banners/toggleactivo', data: fd, dataType: 'json', processData: false, contentType: false })
        .done(function (data) {
            if (data && data.status === true) {
                if (bannersTable0) { bannersTable0.ajax.reload(null, false); }
                if (bannersTable1) { bannersTable1.ajax.reload(null, false); }
                if (bannersTable2) { bannersTable2.ajax.reload(null, false); }
            } else { AlertRQ.error({ title: 'ERROR', text: 'No se pudo actualizar', type: 'danger' }); }
            closeSpinner();
        }).fail(function () { AlertRQ.error({ title: 'ERROR', text: 'Error desconocido', type: 'danger' }); closeSpinner(); });
    });

    /* Eliminar */
    $(document).on('click', '.btn_delete_banner', function () {
        var id = $(this).data('id'), img = $(this).data('img');
        Swal.fire({ icon: 'question', title: 'Eliminar banner', text: '¿Seguro que deseas eliminarlo?', showCancelButton: true, confirmButtonText: 'Sí, eliminar', cancelButtonText: 'Cancelar' })
        .then(function (result) {
            if (!result.isConfirmed) { return; }
            openSpinner();
            var fd = new FormData(); fd.append('banner_id', id); fd.append('banner_img', img);
            $.ajax({ method: 'POST', url: base_url + '/banners/eliminar', data: fd, dataType: 'json', processData: false, contentType: false })
            .done(function (data) {
                if (data && data.status === true) {
                    if (bannersTable0) { bannersTable0.ajax.reload(null, false); }
                    if (bannersTable1) { bannersTable1.ajax.reload(null, false); }
                    if (bannersTable2) { bannersTable2.ajax.reload(null, false); }
                    Swal.fire({ icon: 'success', title: 'Eliminado', timer: 1600, showConfirmButton: false });
                } else { AlertRQ.error({ title: 'ERROR', text: 'No se pudo eliminar', type: 'danger' }); }
                closeSpinner();
            }).fail(function () { AlertRQ.error({ title: 'ERROR', text: 'Error desconocido', type: 'danger' }); closeSpinner(); });
        });
    });

});
