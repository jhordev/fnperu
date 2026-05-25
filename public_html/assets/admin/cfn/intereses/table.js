"use strict";

var interesesTable;

$(document).ready(() => {

    interesesTable = $('#intereses_table').DataTable({
        select: true,
        ajax: {
            "url": base_url + '/intereses/getintereses',
            "type": "get",
            "dataSrc": "",
        },
        columns: [
            { data: 'numero',            width: '4%'  },
            { data: 'tipo_label',        width: '7%'  },
            { data: 'curso_nombre',      width: '22%' },
            { data: 'interes_nombre',    width: '15%' },
            { data: 'interes_email',     width: '17%' },
            { data: 'interes_telefono',  width: '10%' },
            { data: 'interes_creacion',  width: '12%' },
            { data: 'estado_label',      width: '8%'  },
            { data: 'acciones',          width: '5%'  },
            { data: 'curso_tipo'                       }   // columna oculta para filtrar
        ],
        columnDefs: [
            { targets: 9, visible: false, searchable: true }
        ],
        autoWidth: false,
        language: LanguageDataTable,
        initComplete: function () {
            const api = this.api();
            const select = $('#filtro_curso');
            const seen = {};
            const names = [];

            api.rows().data().each(function (row) {
                const name = row.curso_nombre;
                if (name && !seen[name]) {
                    seen[name] = true;
                    names.push(name);
                }
            });

            names.sort(function (a, b) { return a.localeCompare(b, 'es'); });
            names.forEach(function (name) {
                select.append('<option value="' + $('<div>').text(name).html() + '">' + $('<div>').text(name).html() + '</option>');
            });
        }
    });

    /* ── Filtros por tipo ── */
    $('[data-tipo-filter]').on('click', function () {
        $('[data-tipo-filter]').removeClass('active');
        $(this).addClass('active');

        const val = $(this).data('tipo-filter');
        interesesTable.column(9).search(val === '' ? '' : '^' + val + '$', true, false).draw();
    });

    /* ── Filtro por nombre de curso ── */
    $('#filtro_curso').on('change', function () {
        const val = $(this).val();
        interesesTable.column(2).search(
            val === '' ? '' : '^' + $.fn.dataTable.util.escapeRegex(val) + '$',
            true, false
        ).draw();
    });

    let modal_edit   = $('#modal_interes_edit');
    let form_edit    = $('#from_interes_edit');
    let id_field     = $('#interes_id_edit');
    let curso_field  = $('#curso_edit');
    let nombre_field = $('#nombre_edit');
    let email_field  = $('#email_edit');
    let telefono_field = $('#telefono_edit');
    let estado_field = $('#estado_edit');
    let creacion_field = $('#creacion_edit');

    /* ── Abrir modal al hacer click en Ver ── */
    $(document).on('click', '.btn_ver_interes', function () {
        id_field.val(this.getAttribute('data-id'));
        curso_field.val(this.getAttribute('data-curso'));
        nombre_field.val(this.getAttribute('data-nombre'));
        email_field.val(this.getAttribute('data-email'));
        telefono_field.val(this.getAttribute('data-telefono') || '—');
        creacion_field.val(this.getAttribute('data-creacion'));
        estado_field.val(this.getAttribute('data-estado'));
        modal_edit.modal('show');
    });

    /* ── Guardar cambio de estado ── */
    form_edit.submit(function (e) {
        e.preventDefault();
        openSpinner();

        $.ajax({
            method: 'POST',
            url: base_url + '/intereses/updateestado',
            data: new FormData(this),
            dataType: 'json',
            processData: false,
            contentType: false
        }).done(function (data) {

            if (data && data.status === true) {
                modal_edit.modal('hide');
                interesesTable.ajax.reload(() => { closeSpinner(); location.reload(); }, false);
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

    /* ── Eliminar ── */
    $('#btn_delete_interes').click(function () {

        Swal.fire({
            icon: 'question',
            title: 'Eliminar registro',
            text: '¿Está seguro de eliminar este registro de interés?',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {
                openSpinner();

                let formData = new FormData();
                formData.append('interes_id', id_field.val());

                $.ajax({
                    method: 'POST',
                    url: base_url + '/intereses/deleteinteres',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false
                }).done(function (data) {

                    if (data && data.status === true) {
                        modal_edit.modal('hide');
                        interesesTable.ajax.reload(() => { closeSpinner(); location.reload(); }, false);
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
            }
        });
    });

});
