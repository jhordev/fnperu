"use strict";

var lanzamientosTable;

$(document).ready(() => {

    let cursos_table = $('#cursos_table').DataTable({
        select: true,
        ajax: {
            "url": base_url + '/cursos/getcursosactivos',
            "type": "get",
            "dataSrc": "",
        },
        columns: [
            { data: 'numero' },
            { data: 'curso_nombre' },
            { data: 'curso_publico' },
            { data: 'curso_creacion' },
            { data: 'acciones_select' }
        ],
        language: LanguageDataTable
    });

    lanzamientosTable = $('#lanzamientos_table').DataTable({
        select: true,
        ajax: {
            "url": base_url + '/lanzamientos/getlanzamientos',
            "type": "get",
            "dataSrc": "",
        },
        columns: [
            { data: 'numero' },
            { data: 'curso_nombre' },
            { data: 'lanzamiento_costo' },
            { data: 'inicio_fin' },
            { data: 'lanzamiento_estado' },
            { data: 'lanzamiento_creacion' },
            { data: 'acciones' }
        ],
        language: LanguageDataTable
    });

    let modal_cursos = $('#modal_cursos');
    let modal_newlanzamiento = $('#modal_newlanzamiento');

    modal_cursos[0].addEventListener('shown.bs.modal', function (event) {
        cursos_table.search( '' ).draw();
    });

    let nameCurso = $('#nameCurso');
    let id_curso = $('#id_curso');
    
    $(document).on('click', '.btn_select_curso', function () {

        nameCurso.val(this.getAttribute('data-nombre'));
        id_curso.val(this.getAttribute('data-id'));

        modal_cursos.modal('hide');
        
    });

    $('#open_modal_cursos').click(function () {
        
        modal_cursos.modal('show');

    });

    let from_newlanzamiento = $('#from_newlanzamiento');

    from_newlanzamiento.submit(function(e) {

        e.preventDefault();
        openSpinner();

        $.ajax({
            method: 'POST',
            url: base_url + '/lanzamientos/newlanzamiento',
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
                modal_newlanzamiento.modal('hide');
                lanzamientosTable.ajax.reload(() => {closeSpinner()}, false);
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

    let modal_lanz_edit = $('#modal_lanz_edit');
    let id_curso_edit = $('#id_curso_edit');
    let nameCurso_edit = $('#nameCurso_edit');
    let fecha_inicio_edit = $('#fecha_inicio_edit');
    let fecha_fin_edit = $('#fecha_fin_edit');
    let costo_edit = $('#costo_edit');
    let estado_edit = $('#estado_edit');
    let creacion_edit = $('#creacion_edit');
    let idlanzamiento_edit = $('#idlanzamiento_edit');
    let btn_culminar_lanza = $('#btn_culminar_lanza');
    let btn_activar_lanza = $('#btn_activar_lanza');
    let btn_save_lanza = $('#btn_save_lanza');
    let btn_cancel_lanza = $('#btn_cancel_lanza');
    let btn_edit_lanza = $('#btn_edit_lanza');
    let btn_delete_lanza = $('#btn_delete_lanza');

    $(document).on('click', '.btn_ver_lanzamiento', function () {

        let estado = this.getAttribute('data-estado');
       
        id_curso_edit.val(this.getAttribute('data-idcurso'));
        nameCurso_edit.val(this.getAttribute('data-nombre'));
        fecha_inicio_edit.val(this.getAttribute('data-fecha_inicio'));
        fecha_fin_edit.val(this.getAttribute('data-fecha_fin'));
        costo_edit.val(this.getAttribute('data-costo'));
        estado_edit.val(estado);
        creacion_edit.val(this.getAttribute('data-creacion'));
        idlanzamiento_edit.val(this.getAttribute('data-idlanzamiento'));
        
        if (estado == 'ACTIVO') {
            btn_culminar_lanza.removeClass('d-none');
            btn_activar_lanza.addClass('d-none');
        } else {
            btn_activar_lanza.removeClass('d-none');
            btn_culminar_lanza.addClass('d-none');
        }

        btn_save_lanza.addClass('d-none');
        btn_cancel_lanza.addClass('d-none');

        btn_cancel_lanza.attr('data-estado', estado);

        btn_edit_lanza.removeClass('d-none');
        btn_delete_lanza.removeClass('d-none');

        fecha_inicio_edit.prop('disabled', true);
        fecha_fin_edit.prop('disabled', true);
        costo_edit.prop('disabled', true);

        modal_lanz_edit.modal('show');
        
    });

    let from_newlanzamiento_edit = $('#from_newlanzamiento_edit');

    btn_delete_lanza.click(function () {
       
        Swal.fire({
            icon: 'question',
            title: 'Eliminar el Lanzamiento',
            text: '¿Está seguro de borrar de forma permanente este Lanzamiento?',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            
            if (result.isConfirmed) 
            {
                openSpinner();

                let formData = new FormData(from_newlanzamiento_edit[0]);

                $.ajax({
                    method: 'POST',
                    url: base_url + '/lanzamientos/deletelanzamiento',
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
                        modal_lanz_edit.modal('hide');
                        lanzamientosTable.ajax.reload(() => {closeSpinner()}, false);
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
            }
        })
    });

    btn_culminar_lanza.click(function () {
       
        Swal.fire({
            icon: 'question',
            title: 'Culminar Lanzamiento',
            text: '¿Está seguro de culminar este Lanzamiento?',
            showCancelButton: true,
            confirmButtonText: 'Sí, culminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            
            if (result.isConfirmed) 
            {
                openSpinner();

                let formData = new FormData(from_newlanzamiento_edit[0]);

                $.ajax({
                    method: 'POST',
                    url: base_url + '/lanzamientos/culminarLanzamiento',
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
                        modal_lanz_edit.modal('hide');
                        lanzamientosTable.ajax.reload(() => {closeSpinner()}, false);
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
            }
        })
    });

    btn_activar_lanza.click(function () {
       
        Swal.fire({
            icon: 'question',
            title: 'Activar Lanzamiento',
            text: '¿Está seguro de activar este Lanzamiento?',
            showCancelButton: true,
            confirmButtonText: 'Sí, activar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            
            if (result.isConfirmed) 
            {
                openSpinner();

                let formData = new FormData(from_newlanzamiento_edit[0]);

                $.ajax({
                    method: 'POST',
                    url: base_url + '/lanzamientos/activarLanzamiento',
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
                        modal_lanz_edit.modal('hide');
                        lanzamientosTable.ajax.reload(() => {closeSpinner()}, false);  
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
            }
        })
    });

    btn_edit_lanza.click(function () {
        
        fecha_inicio_edit.prop('disabled', false);
        fecha_fin_edit.prop('disabled', false);
        costo_edit.prop('disabled', false);

        btn_save_lanza.removeClass('d-none');
        btn_cancel_lanza.removeClass('d-none');

        btn_activar_lanza.addClass('d-none');
        btn_culminar_lanza.addClass('d-none');
        btn_edit_lanza.addClass('d-none');
        btn_delete_lanza.addClass('d-none');

    });

    btn_cancel_lanza.click(function () {

        if (this.getAttribute('data-estado') == 'ACTIVO') {
            btn_culminar_lanza.removeClass('d-none');
            btn_activar_lanza.addClass('d-none');
        } else {
            btn_activar_lanza.removeClass('d-none');
            btn_culminar_lanza.addClass('d-none');
        }

        btn_save_lanza.addClass('d-none');
        btn_cancel_lanza.addClass('d-none');

        btn_edit_lanza.removeClass('d-none');
        btn_delete_lanza.removeClass('d-none');

        fecha_inicio_edit.prop('disabled', true);
        fecha_fin_edit.prop('disabled', true);
        costo_edit.prop('disabled', true);

    });

    btn_save_lanza.click(function () {
       
        Swal.fire({
            icon: 'question',
            title: 'Actualizar Lanzamiento',
            text: '¿Está seguro de actualizar este Lanzamiento?',
            showCancelButton: true,
            confirmButtonText: 'Sí, actualizar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            
            if (result.isConfirmed) 
            {
                openSpinner();

                let formData = new FormData(from_newlanzamiento_edit[0]);

                $.ajax({
                    method: 'POST',
                    url: base_url + '/lanzamientos/updateLanzamiento',
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
                        modal_lanz_edit.modal('hide');
                        lanzamientosTable.ajax.reload(() => {closeSpinner()}, false);  
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
            }
        })
    });
    
});