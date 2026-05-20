"use strict";
var cursoId;

$(document).ready(() => {

    let btn_action = $('.btn_action');
    cursoId = $('#idCurso').remove().html();

    let btn_edit_cancel = $('#btn_edit_cancel');

    let btn_edit_save = $('#btn_edit_save');
    let view_edit_cancel = $('#view_edit_cancel');
    let input_edit_nombre = $('#input_edit_nombre');

    let input_edit_img = $('#input_edit_img');
    let apartado_view_img = $('.apartado_view_img');
    let btn_edit_cancel_img = $('#btn_edit_cancel_img');

    $('#edit_nombre').click(() => {

        btn_action.addClass('d-none');
        btn_edit_cancel.removeClass('d-none');
        input_edit_nombre.removeClass('d-none');
        view_edit_cancel.addClass('d-none');
        input_edit_nombre.find('input').prop('disabled', false).focus().val(view_edit_cancel.text());
        btn_edit_save.removeClass('d-none');

    });

    let btn_video_cancel = $('#btn_video_cancel');

    let view_video_edit = $('#view_video_edit');
    let input_video_nombre = $('#input_video_nombre');
    let btn_edit_video_save = $('#btn_edit_video_save');

    $('#edit_video').click(() => {

        btn_action.addClass('d-none');
        btn_video_cancel.removeClass('d-none');
        input_video_nombre.removeClass('d-none');
        view_video_edit.addClass('d-none');
        input_video_nombre.find('input').prop('disabled', false).focus().val('');
        btn_edit_video_save.removeClass('d-none');
        charater_input_video.html('(0/150)');

    });

    btn_video_cancel.click(() => {
       
        btn_video_cancel.addClass('d-none');
        btn_action.removeClass('d-none');
        input_video_nombre.addClass('d-none');
        view_video_edit.removeClass('d-none');
        btn_edit_video_save.addClass('d-none');

    });

    btn_edit_video_save.click((e) => {
        
        saveData('video', input_video_nombre.find('input').val());

    });

    btn_edit_cancel.click(() => {
       
        btn_edit_cancel.addClass('d-none');
        btn_action.removeClass('d-none');
        input_edit_nombre.addClass('d-none');
        view_edit_cancel.removeClass('d-none');
        btn_edit_save.addClass('d-none');

    });

    btn_edit_save.click((e) => {
        
        saveData('name', input_edit_nombre.find('input').val());

    });

    let curso_nombre = $('#curso_nombre');
    let curso_video = $('#curso_video');
    let charater_input_name = $('#charater_input_name');
    let charater_input_video = $('#charater_input_video');

    curso_video.keyup(function () {
       
        charater_input_video.html('(' + this.value.length + '/150)');
        
    });

    curso_nombre.keyup(function () {
       
        charater_input_name.html('(' + this.value.length + '/150)');
        
    });

    let text_area_intro_uno = $('#text_area_intro_uno');
    let charater_input_intro_uno = $('#charater_input_intro_uno')

    text_area_intro_uno.keyup(function () {
       
        charater_input_intro_uno.html('(' + this.value.length + '/490)');
        
    });

    let text_area_intro_dos = $('#text_area_intro_dos');
    let charater_input_intro_dos = $('#charater_input_intro_dos')

    text_area_intro_dos.keyup(function () {
       
        charater_input_intro_dos.html('(' + this.value.length + '/490)');
        
    });

    let nameBeneficio = $('#nameBeneficio');
    let charater_input_beneficio = $('#charater_input_beneficio')

    nameBeneficio.keyup(function () {
       
        charater_input_beneficio.html('(' + this.value.length + '/190)');
        
    });

    let nameMaterial = $('#nameMaterial');
    let charater_input_material = $('#charater_input_material')

    nameMaterial.keyup(function () {
       
        charater_input_material.html('(' + this.value.length + '/190)');
        
    });

    $('#btn_add_img').click(() => {

        apartado_view_img.addClass('d-none');
        btn_action.addClass('d-none');
        input_edit_img.removeClass('d-none').find('input').prop('disabled', false);
        btn_edit_cancel_img.removeClass('d-none');

    });

    btn_edit_cancel_img.click(() => {

        apartado_view_img.removeClass('d-none');
        btn_action.removeClass('d-none');
        input_edit_img.addClass('d-none').find('input').val('').prop('disabled', true);
        btn_edit_cancel_img.addClass('d-none');

    });

    input_edit_img.find('input').change(function(e) {

        if (this.value.trim() !== '') {
            saveData('image', this.files[0]);
        }

    });

    let input_edit_brochure = $('#input_edit_brochure');
    let btn_edit_cancel_brochure = $('#btn_edit_cancel_brochure');
    let ver_brochure_btn = $('#ver_brochure_btn');

    $('#btn_add_brochure').click(function () {
       
        btn_action.addClass('d-none');
        input_edit_brochure.removeClass('d-none').find('input').val('').prop('disabled', false);
        btn_edit_cancel_brochure.removeClass('d-none');
        ver_brochure_btn.addClass('d-none');

    });

    btn_edit_cancel_brochure.click(function () {
       
        btn_action.removeClass('d-none');
        input_edit_brochure.addClass('d-none');
        btn_edit_cancel_brochure.addClass('d-none');
        ver_brochure_btn.removeClass('d-none');
        
    });

    input_edit_brochure.find('input').change(function(e) {

        if (this.value.trim() !== '') {
            saveData('brochure', this.files[0]);
        }

    });

    $('#btn_publicar').click((e) => {

        Swal.fire({
            icon: 'question',
            title: 'Publicar el Curso',
            text: 'Al publicar el curso cualquier persona va a poder visualizarla en la página web',
            showCancelButton: true,
            confirmButtonText: 'Sí, publicar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            
            if (result.isConfirmed) {
                saveData('publicar', true);
            }
        })

    });

    $('#btn_ocultar').click((e) => {

        Swal.fire({
            icon: 'question',
            title: 'Ocultar el Curso',
            text: 'Al ocultar el curso nadie va a poder visualizarla en la página web',
            showCancelButton: true,
            confirmButtonText: 'Sí, ocultar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            
            if (result.isConfirmed) {
                saveData('ocultar', true);
            }
        });

    });

    $('#btn_publicar_video').click((e) => {

        Swal.fire({
            icon: 'question',
            title: 'Superponer el Video',
            text: '¿Está seguro de superponer el video sobre la imagen principal?',
            showCancelButton: true,
            confirmButtonText: 'Sí, superponer',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            
            if (result.isConfirmed) {
                saveData('publicar_video', true);
            }
        })

    });

    $('#btn_ocultar_video').click((e) => {

        Swal.fire({
            icon: 'question',
            title: 'Superponer el Imagen',
            text: '¿Está seguro de NO superponer el video sobre la imagen principal?',
            showCancelButton: true,
            confirmButtonText: 'Sí, no superponer',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            
            if (result.isConfirmed) {
                saveData('ocultar_video', true);
            }
        });

    });

    let btn_save_intro_uno = $('#btn_save_intro_uno');
    let btn_cancel_intro_uno = $('#btn_cancel_intro_uno');
    let text_view_intro_uno = $('#text_view_intro_uno');

    $('#btn_edit_intro_uno').click(function () {
       
        text_area_intro_uno.removeClass('d-none').prop('disabled', false).focus().val(text_view_intro_uno.text());
        btn_action.addClass('d-none');
        btn_save_intro_uno.removeClass('d-none');
        btn_cancel_intro_uno.removeClass('d-none');
        text_view_intro_uno.addClass('d-none');
        
    });

    btn_cancel_intro_uno.click(function () {
       
        text_area_intro_uno.addClass('d-none');
        btn_action.removeClass('d-none');
        btn_save_intro_uno.addClass('d-none');
        btn_cancel_intro_uno.addClass('d-none');
        text_view_intro_uno.removeClass('d-none');
        
    });

    btn_save_intro_uno.click(function (e) {
       
        saveData('intro_uno', text_area_intro_uno.val());

    });

    let btn_save_intro_dos = $('#btn_save_intro_dos');
    let btn_cancel_intro_dos = $('#btn_cancel_intro_dos');
    let text_view_intro_dos = $('#text_view_intro_dos');

    $('#btn_edit_intro_dos').click(function () {
       
        text_area_intro_dos.removeClass('d-none').prop('disabled', false).focus().val(text_view_intro_dos.text());
        btn_action.addClass('d-none');
        btn_save_intro_dos.removeClass('d-none');
        btn_cancel_intro_dos.removeClass('d-none');
        text_view_intro_dos.addClass('d-none');
        
    });

    btn_cancel_intro_dos.click(function () {
       
        text_area_intro_dos.addClass('d-none');
        btn_action.removeClass('d-none');
        btn_save_intro_dos.addClass('d-none');
        btn_cancel_intro_dos.addClass('d-none');
        text_view_intro_dos.removeClass('d-none');
        
    });

    btn_save_intro_dos.click(function (e) {
       
        saveData('intro_dos', text_area_intro_dos.val());

    });

    document.getElementById('modal_newmaterial').addEventListener('shown.bs.modal', function (event) {
        nameMaterial.focus().val('');
        charater_input_material.html('(0/190)');
    });

    document.getElementById('modal_newbeneficio').addEventListener('shown.bs.modal', function (event) {
        nameBeneficio.focus().val('');
        charater_input_beneficio.html('(0/190)');
    });

    let nameModulo = $('#nameModulo');

    document.getElementById('modal_newmodulo').addEventListener('shown.bs.modal', function (event) {
        nameModulo.focus().val('');
    });

    let btn_add_matetial = $('#btn_add_matetial');

    btn_add_matetial.click(function () {
       
        saveData('add_material', nameMaterial.val());
        
    });

    let btn_add_beneficio = $('#btn_add_beneficio');

    btn_add_beneficio.click(function () {
       
        saveData('add_beneficio', nameBeneficio.val());
        
    });

    let btn_add_modulo = $('#btn_add_modulo');

    btn_add_modulo.click(function () {
       
        saveData('add_modulo', nameModulo.val());
        
    });

    let materiales_list = $('#materiales_list');

    new Sortable(materiales_list[0], {
        handle: '.material_each i',
        animation: 150,
        dragClass: 'ocultar_drag',
        store: {
            set: (sortable) => {
                saveData('orden_material', sortable.toArray().join('-'))
            }
        }
    });

    let beneficios_list = $('#beneficios_list');

    new Sortable(beneficios_list[0], {
        handle: '.bienes_each i',
        animation: 150,
        dragClass: 'ocultar_drag',
        store: {
            set: (sortable) => {
                saveData('orden_bienes', sortable.toArray().join('-'))
            }
        }
    });

    let accordion_modulos = $('#accordion_modulos');

    new Sortable(accordion_modulos[0], {
        handle: '.accordion-item_modulos i.for_move',
        animation: 150,
        dragClass: 'ocultar_drag',
        store: {
            set: (sortable) => {
                saveData('orden_modulos', sortable.toArray().join('-'))
            }
        }
    });

    let accordion_body_indicadores = $('.accordion_body_indicadores');

    for (let index = 0; index < accordion_body_indicadores.length; index++) 
    {
        new Sortable(accordion_body_indicadores[index], {
            handle: '.indicador_each i',
            animation: 150,
            dragClass: 'ocultar_drag',
            store: {
                set: (sortable) => {
                    saveData('orden_indicadores', sortable.toArray().join('-'))
                }
            }
        });
    }

    $('.btn_delete_indicador').click(function () {
       
        Swal.fire({
            icon: 'question',
            title: 'Eliminar Indicador',
            text: '¿Está seguro de borrar de forma permanente el Indicador elegido?',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-danger fw-500 me-3 fs-18',
                cancelButton: 'btn btn-info fw-500 fs-18'
            },
            buttonsStyling: false
        }).then((result) => {

            if (result.isConfirmed) {
                let idMaterial = this.getAttribute('data-id');
                saveData('delete_indicador', idMaterial);
            }
        });
        
    });

    $('.btn_delete_material').click(function () {
       
        Swal.fire({
            icon: 'question',
            title: 'Eliminar Material',
            text: '¿Está seguro de borrar de forma permanente el material elegido?',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-danger fw-500 me-3 fs-18',
                cancelButton: 'btn btn-info fw-500 fs-18'
            },
            buttonsStyling: false
        }).then((result) => {

            if (result.isConfirmed) {
                let idMaterial = this.getAttribute('data-id');
                saveData('delete_material', idMaterial);
            }
        });
        
    });

    $('.btn_delete_bien').click(function () {
       
        Swal.fire({
            icon: 'question',
            title: 'Eliminar Bien',
            text: '¿Está seguro de borrar de forma permanente el bien elegido?',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-danger fw-500 me-3 fs-18',
                cancelButton: 'btn btn-info fw-500 fs-18'
            },
            buttonsStyling: false
        }).then((result) => {

            if (result.isConfirmed) {
                let idMaterial = this.getAttribute('data-id');
                saveData('delete_bien', idMaterial);
            }
        });
        
    });

    let modal_newindicador = $('#modal_newindicador');
    let nameIndicador = $('#nameIndicador');

    modal_newindicador[0].addEventListener('shown.bs.modal', function (event) {
        nameIndicador.focus().val('');
    });

    let btn_add_indicador = $('#btn_add_indicador');

    btn_add_indicador.click(function () {
        
        saveData('add_indicador', nameIndicador.val() + '--||--' + this.getAttribute('data-id'));
        
    });

    $('.btn_new_indicador').click(function (e) {
       
        e.preventDefault();
        btn_add_indicador.attr('data-id', this.getAttribute('data-id'))
        modal_newindicador.modal('show')

        setTimeout(() => {
            $(this.parentElement).click();
        }, 400);
        
    });

    $('.btn_delete_modulo').click(function (e) {
       
        e.preventDefault();

        setTimeout(() => {
            $(this.parentElement).click();
        }, 400);

        Swal.fire({
            icon: 'question',
            title: 'Eliminar Módulo',
            text: '¿Está seguro de borrar de forma permanente el módulo elegido?',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-danger fw-500 me-3 fs-18',
                cancelButton: 'btn btn-info fw-500 fs-18'
            },
            buttonsStyling: false
        }).then((result) => {
            
            if (result.isConfirmed) {
                let idModulo = this.getAttribute('data-id');
                saveData('delete_modulo', idModulo);
            }
        });
        
    });

    $('#btn_delete_curso').click(function (e) {
       
        e.preventDefault();

        Swal.fire({
            icon: 'question',
            title: 'Eliminar Curso',
            text: '¿Está seguro de borrar de forma permanente el curso actual?',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-danger fw-500 me-3 fs-18',
                cancelButton: 'btn btn-info fw-500 fs-18'
            },
            buttonsStyling: false
        }).then((result) => {
            
            if (result.isConfirmed) {
                saveData('delete_curso', true);
            }
        });
        
    });

});

function saveData(action = '', data = '') {

    openSpinner();
    let formData = new FormData();
    formData.append('action', action);
    formData.append('data', data);
    formData.append('id', cursoId);

    $.ajax({
        method: 'POST',
        url: base_url + '/cursos/save',
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

            if (action != 'orden_material' && action != 'orden_bienes' && action != 'orden_modulos' && action != 'orden_indicadores') {
                closeSpinner();
            } else {
                window.location.reload();
            }
        }
        else if(data.status === true) 
        {
            if (action != 'orden_material' && action != 'orden_bienes' && action != 'orden_modulos' && action != 'orden_indicadores') {
                window.location.reload();
            } else {
                closeSpinner();
            }
        }
        else if(data.status === false)
        {
            AlertRQ.error({
                title : data.title,
                text :  data.message,
                type :  data.type
            });

            if (action != 'orden_material' && action != 'orden_bienes' && action != 'orden_modulos' && action != 'orden_indicadores') {
                closeSpinner();
            } else {
                window.location.reload();
            }
        }
        else
        { 
            AlertRQ.error({
                title : 'ERROR',
                text : 'Ocurrió un error desconocido',
                type : 'danger'
            });

            if (action != 'orden_material' && action != 'orden_bienes' && action != 'orden_modulos' && action != 'orden_indicadores') {
                closeSpinner();
            } else {
                window.location.reload();
            }
        }

    }).fail(function() {

        AlertRQ.error({
            title : 'ERROR',
            text : 'Ocurrió un error desconocido',
            type : 'danger'
        });

        if (action != 'orden_material' && action != 'orden_bienes' && action != 'orden_modulos' && action != 'orden_indicadores') {
            closeSpinner();
        } else {
            window.location.reload();
        }
    });
}