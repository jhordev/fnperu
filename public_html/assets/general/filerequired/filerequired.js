"use strict";

var spinnerLoader;
var alertContainerRQ;

$(document).ready(function () {

    /* ALERT */
    $('body').append('<div id="AlertRequiredQ"></div>');
    alertContainerRQ = $('#AlertRequiredQ');

    /* AlertRQ.error({
        title : 'ERROR 1',
        text : '1 Ocurrió un error desconocido 1',
        type : 'warning'
    }).then((result) => {
        console.log(result);
    }); */


    $(document).on("click", ".sheriff-close", function() {
        alertContainerRQ.html('');
    });

    $(document).on("click", ".sheriff-type_warning", function() {
        alertContainerRQ.html('');
    });

    /* ALERT */

    /* SPINNER LOADER */
    spinnerLoader = $('.container_loader-spinner');
    closeSpinner();
    /* SPINNER LOADER */

});

function openSpinner() {
    spinnerLoader.removeClass('d-none');
}

function closeSpinner() {
    spinnerLoader.addClass('d-none');
}

function makeId(length) 
{
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;

    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }

   let date = new Date();
   result = result + date.getFullYear() + '' + date.getMonth() + '' + date.getDay() + '' + date.getDate() + 
   '' + date.getHours() + '' + date.getMinutes() + '' + date.getSeconds() + '' + date.getMilliseconds();

   return result;
}

class AlertRequiredQ
{
    error(alert = []) 
    {
        if (alert.type == undefined || alert.type.trim() == '') {
            alert.type = 'danger';
        }
        if (alert.text == undefined || alert.text.trim() == '') {
            alert.text = 'Ocurrió un error desconocido';
        }
        if (alert.width == undefined || alert.width.trim() == '') {
            alert.width = '0';
        }
        if (alert.title == undefined || alert.title.trim() == '') {
            alert.title = 'ERROR';
        }
        
        switch (alert.width) {
            case 'lg':
                alert.width = 'modal-lg';
                break;
    
            case 'lg-2':
                alert.width = 'sheriff-modal-width-600';
                break;
    
            default:
                alert.width = '0';
                break;
        }
    
        switch (alert.type) {
            case 'warning':
                alert.icon = '<span class="icon-notification"></span>';
                break;
    
            case 'danger':
                alert.icon = '<i class="icofont-close-circled"></i>';
                break;
                
            default:
                alert.type = 'danger';
                alert.icon = '<i class="icofont-close-circled"></i>';
                alert.text = 'Ocurrió un error desconocido';
                break;
        }
    
        let modalRQ = `
        <div class="sheriff-main sheriff-type_` + alert.type + `">
            <div class="sheriff-modal">
                <div class="sheriff-header">
                    <div class="sheriff-title">` + alert.title + `</div>
                    <div class="sheriff-close"><i class="fa-solid fa-xmark"></i></div>
                </div>
                <div class="sheriff-body">
                    <div class="sheriff-icon">` + alert.icon + `</div>
                    <div class="sheriff-content">` + alert.text + `</div>
                </div>
            </div>
        </div>`;

        alertContainerRQ.html(modalRQ);

        /* let promesa = new Promise((resolve, reject) => {
            document.querySelector('body').addEventListener('click', () => {
                resolve('Hola');
            });
        });
        return promesa; */
        return true;
    }
}

const AlertRQ = new AlertRequiredQ();



function setModalAlert(alert = [])
{
	if (alert.type == undefined) {
		alert.type = 'danger';
	}
	if (alert.text == undefined) {
		alert.text = 'Ocurrió un error desconocido';
	}
	if (alert.width == undefined) {
		alert.width = 'sm';
	}
	if (alert.btnSuccess == undefined) {
		alert.btnSuccess = false;
	}
	if (alert.btnSuccessText == undefined) {
		alert.btnSuccessText = 'Aceptar';
	}
	if (alert.btnOk == undefined) {
		alert.btnOk = false;
	}
	if (alert.title == undefined) {
		alert.title = 'ERROR';
	}
	if (alert.actionBtnSuccess == undefined) {
		alert.actionBtnSuccess = function () {
		}
	}

	alert.id = 'alert_modal_' + makeId(20);

	alert.text = alert.text.trim();

	if (alert.text == '' || alert.text == null) {
		alert.text = 'Ocurrió un error desconocido';
	}

	alert.title = alert.title.trim();

	if (alert.title == '' || alert.title == null) {
		alert.title = 'ERROR';
	}
	
	switch (alert.width) {
		case 'lg':
			alert.width = 'modal-lg';
			break;

		case 'lg-2':
			alert.width = 'sheriff-modal-width-600';
			break;

		default:
			alert.width = '';
			break;
	}

	switch (alert.type) {
		case 'warning':
			alert.icon = '<i class="fas fa-exclamation"></i>';
			break;

		case 'danger':
			alert.icon = '<i class="far fa-times-circle"></i>';
			break;

		case 'success':
			alert.icon = '<i class="far fa-check-circle"></i>';
			break;

		case 'info':
			alert.icon = '<i class="fas fa-info-circle"></i>';
			break;

		default:
			alert.type = 'danger';
			alert.icon = '<i class="far fa-times-circle"></i>';
			alert.text = 'Ocurrió un error desconocido.';
			break;
	}
	
	alert.btnSuccessHtml = '';

	if (alert.btnSuccess === true) {
		alert.btnSuccessHtml = '<button type="button" class="btn btn-success sheriff-btn_success" data-bs-dismiss="modal">' + alert.btnSuccessText + '</button>';
	}

	let modal = `
	<div class="sheriff-bg_` + alert.id + ` sheriff-bgAll d-none"></div>
	<div class="modal sheriff-modal sheriff-type_` + alert.type + `" id="` + alert.id + `" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="` + alert.id + `Label" aria-hidden="true">
		<div class="modal-dialog mt-0 ` + alert.width + `">
			<div class="modal-content">
			
				<div class="modal-header sheriff-header_modal">
					<h5 class="modal-title" id="` + alert.id + `Label">` + alert.title + `</h5>
					<button type="button" class="btn-close sheriff-btn_close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body text-center">
					<div class="sheriff-icon p-0 m-0 mb-2">` + alert.icon + `</div>
					<div class="sheriff-text">
						` + alert.text + `
					</div>
				</div>

				<div class="modal-footer sheriff-footer_modal d-block">
					<div class="row p-0 m-0">
						<div class="col-6 pl-0 pr-2 mx-0">
							<button type="button" class="sheriff-btn_cerrar" data-bs-dismiss="modal">Cerrar</button>
						</div>
						<div class="col-6 pr-0 pl-2 mx-0 text-right">
							` + alert.btnSuccessHtml + `
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>`;

	$('#container_alert_modal').append(modal);
	$('.sheriff-bg_' + alert.id).removeClass('d-none');

	$('#' + alert.id + ' .sheriff-btn_success').click(alert.actionBtnSuccess);
	$('#' + alert.id + ' .sheriff-btn_success').click(function () {
		$(this).prop('disabled', true)
	});

	$('#' + alert.id).modal('show');
	$('#' + alert.id).css('margin-top', ($(window).height() - $('#' + alert.id + ' .modal-content').height() - 100) / 2);
	$('#' + alert.id).addClass('fade');

	let myModalEl = document.getElementById(alert.id);
	myModalEl.addEventListener('hidden.bs.modal', function (event) {
		$('.sheriff-bg_' + alert.id).remove();
		$('#' + alert.id).remove();
	});
}