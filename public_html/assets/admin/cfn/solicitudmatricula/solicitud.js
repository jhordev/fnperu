"use strict";

var soliTable;
var estadoTable;

$(document).ready(() => {

    let select_estado = $('#select_estado');
    estadoTable = select_estado.val();

    soliTable = $('#lanzamientos_table').DataTable({
        select: true,
        ajax: {
            "url": base_url + '/solicitudmatricula/getsolicitudes',
            "type": "POST",
            "data": function ( d ) {
                d.estado = estadoTable;
            },
            "dataSrc": "",
        },
        columns: [
            { data: 'numero' },
            { data: 'code' },
            { data: 'nombre_completo' },
            { data: 'sol_dni' },
            { data: 'curso_nombre' },
            { data: 'sol_estado' },
            { data: 'sol_creacion' },
            { data: 'acciones' }
        ],
        language: LanguageDataTable
    });

    select_estado.change(function () {
        
        openSpinner();
        estadoTable = this.value;
        soliTable.ajax.reload(() => {closeSpinner()}, false);  

    });

    let modal_solicitud = $('#modal_solicitud');
    let sol_curso = $('#sol_curso');
    let sol_dni = $('#sol_dni');
    let sol_nombre = $('#sol_nombre');
    let sol_paterno = $('#sol_paterno');
    let sol_materno = $('#sol_materno');
    let sol_celular = $('#sol_celular');
    let sol_email = $('#sol_email');
    let sol_lugar = $('#sol_lugar');
    let sol_direccion = $('#sol_direccion');
    let sol_mensaje = $('#sol_mensaje');
    let sol_codigo = $('#sol_codigo');
    let sol_recepcion = $('#sol_recepcion');
    let sol_estado = $('#sol_estado');
    let sol_img_view = $('#sol_img_view');
    let ver_img_big = $('#ver_img_big');
    let move_to_pendi = $('#move_to_pendi');
    let move_to_atend = $('#move_to_atend');
    let move_to_null = $('#move_to_null');
    let btn_action_move = $('.btn_action_move');
    let table_imagenes = $('#table_imagenes tbody');
    let change_input = $('#change_input');

    $(document).on('click', '.btn_ver_solicitud', function (e) {
       
        let data = $(this).find('span.data').html();
        data = JSON.parse(data);

        console.log(data);

        if (data.sol_estado == 2) 
        {
            sol_estado.val('PENDIENTE');
            sol_estado.removeClass('text-danger');
            sol_estado.removeClass('text-success');
            sol_estado.addClass('color-warning');
            move_to_pendi.addClass('d-none');
            move_to_atend.removeClass('d-none');
            move_to_null.removeClass('d-none');
        } 
        else if (data.sol_estado == 1) 
        {
            sol_estado.val('ATENDIDO');
            sol_estado.removeClass('text-danger');
            sol_estado.addClass('text-success');
            sol_estado.removeClass('color-warning');
            move_to_pendi.removeClass('d-none');
            move_to_atend.addClass('d-none');
            move_to_null.removeClass('d-none');
        } 
        else 
        {
            sol_estado.val('ANULADO');
            sol_estado.addClass('text-danger');
            sol_estado.removeClass('text-success');
            sol_estado.removeClass('color-warning');
            move_to_pendi.removeClass('d-none');
            move_to_atend.removeClass('d-none');
            move_to_null.addClass('d-none');
        }

        change_btn_cancel.click();

        if (data.sol_imagenes == '' || data.sol_imagenes == null) 
        {
            let html = '<tr><td colspan="3" class="text-center">No hay actualizaciones de la foto del voucher</td></tr>';
            table_imagenes.html(html);
        } 
        else 
        {
            let html = '';

            let imagenes_last = data.sol_imagenes.split('-||-');

            imagenes_last.forEach((element, key) => {

                html += '<tr><td class="text-center">' + (key + 1) + '</td>';
                
                imagenes_last[key] = element.split('|-|')

                html += '=<td class="text-center fw-500"><a href="' + base_url + '/solicitudmatricula/imgvaucher/' + imagenes_last[key][0] + '" target="_blank">' + imagenes_last[key][0] + '</a></td>';
                html += '=<td class="text-center">' + imagenes_last[key][1] + '</td>';

                html += '</tr>';
            });

            table_imagenes.html(html);
            console.log(imagenes_last);
        }

        btn_action_move.attr('data-id', data.sol_id)
        change_input.attr('data-id', data.sol_id)
        sol_img_view.attr( 'src', data.href_img);
        ver_img_big.attr( 'href', data.href_img);
        sol_recepcion.val(data.sol_recepcion);
        sol_codigo.val(data.code);
        sol_curso.val(data.curso_nombre);
        sol_dni.val(data.sol_dni);
        sol_nombre.val(data.sol_nombres);
        sol_paterno.val(data.sol_apellido_paterno);
        sol_materno.val(data.sol_apellido_materno);
        sol_celular.val(data.sol_celular);
        sol_email.val(data.sol_correo);
        sol_lugar.val(data.sol_lugar_residencia);
        sol_direccion.val(data.sol_direccion_residencia);
        sol_mensaje.val(data.sol_mensaje);
        
        modal_solicitud.modal('show');
    });

    move_to_atend.click(function () {
        modal_solicitud.modal('hide');
        saveData('to_atendidos', 'true', this.getAttribute('data-id'));
    });

    move_to_pendi.click(function () {
        modal_solicitud.modal('hide');
        saveData('to_pendientes', 'true', this.getAttribute('data-id'));
    });

    move_to_null.click(function () {
        modal_solicitud.modal('hide');
        saveData('to_anulados', 'true', this.getAttribute('data-id'));
    });

    let change_btn_cambiar = $('#change_btn_cambiar');
    let change_relleno = $('#change_relleno');
    let change_btn_cancel = $('#change_btn_cancel');

    change_btn_cambiar.click(function () {
       
        change_btn_cambiar.addClass('d-none');
        change_relleno.addClass('d-none');
        change_input.removeClass('d-none');
        change_btn_cancel.removeClass('d-none');
        change_input.val('');

    });

    change_btn_cancel.click(function () {
       
        change_btn_cambiar.removeClass('d-none');
        change_relleno.removeClass('d-none');
        change_input.addClass('d-none');
        change_btn_cancel.addClass('d-none');
        change_input.val('');

    });

    change_input.change(function () {
       
        if (this.value != '' && this.value != undefined) {
            modal_solicitud.modal('hide');
            saveData('cambiar_voucher', this.files[0], this.getAttribute('data-id'))
        }
        
    });
    
});

function saveData(action = '', data = '', soliId = '') {

    openSpinner();
    let formData = new FormData();
    formData.append('action', action);
    formData.append('data', data);
    formData.append('id', soliId);

    $.ajax({
        method: 'POST',
        url: base_url + '/solicitudmatricula/save',
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
            soliTable.ajax.reload(() => {closeSpinner()}, false);  
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