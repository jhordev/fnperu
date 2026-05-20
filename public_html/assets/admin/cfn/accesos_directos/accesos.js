"use strict";

$(document).ready(() => {

    let modal_cambiarImagen = $('#modal_cambiarImagen');
    let action_categoria = $('.action_categoria');
    let modal_cambiarImagenLabel = $('#modal_cambiarImagenLabel');
    let input_img = $('#input_img');
    let from_cambiarImagen = $('#from_cambiarImagen');
    let img_view_cat = $('#img_view_cat');
    let input_id_cat = $('#input_id_cat');

    action_categoria.click(function (e) {
       
        modal_cambiarImagenLabel.html(this.getAttribute('data-nombre'));
        input_id_cat.val(this.getAttribute('data-id'));
        
        if (this.getAttribute('data-img') != '') {
            img_view_cat.attr('src', assets_url + '/moodle/images/categorias/' + this.getAttribute('data-img'));
        } else {
            img_view_cat.attr('src', assets_url + '/web/images/general/no-image-no-oficial.png');
        }
        modal_cambiarImagen.modal('show');
        
    });

    input_img.change(function (e) {
    
        if (this.value != '') 
        {
            openSpinner();

            let formData = new FormData(from_cambiarImagen[0]);

            $.ajax({
                method: 'POST',
                url: base_url + '/accesosdirectosmoodle/changeimg',
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
                    location.reload();
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

    });
});