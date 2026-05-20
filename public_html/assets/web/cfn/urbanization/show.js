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

            if (data == null)
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
                }).then(() => {

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

    function updateSlider() {
        const actual = sliderItems[sliderConfig.actual]
        const actualOverlap = overlap[sliderConfig.actual]

        if (actual.getAttribute('data-is-video') === '1') {
            mainItemImg.addClass('d-none')
            mainItemIframe.attr('src', actual.getAttribute('data-src'))
            mainItemImg.attr('src', '')
            mainItemIframe.removeClass('d-none')
        } else {
            mainItemIframe.addClass('d-none')
            mainItemImg.attr('src', actual.getAttribute('data-src'))
            mainItemIframe.attr('src', '')
            mainItemImg.removeClass('d-none')
        }

        overlap.each((index, value) => {
            value.classList.remove('overlap_out')
        })

        actualOverlap.classList.add('overlap_out')

        const description = actual.getAttribute('data-description').trim()

        if (description !== '') {
            $('#main_description').html('<b>DESCRIPCIÓN: </b>' + description)
        } else {
            $('#main_description').html('')
        }
    }

    const sliderItems = $('#container_items .item')
    const mainItemIframe = $('#main_carousel #main_item iframe')
    const mainItemImg = $('#main_carousel #main_item img')
    const overlap = $('.overlap')

    const sliderConfig = {
        total: sliderItems.length,
        actual: 1000
    }

    function nextSlider()
    {
        sliderConfig.actual++

        if (sliderConfig.actual >= sliderConfig.total) {
            sliderConfig.actual = 0
        }

        updateSlider()
    }

    function previousSlider()
    {
        sliderConfig.actual--

        if (sliderConfig.actual < 0) {
            sliderConfig.actual = sliderConfig.total - 1
        }

        updateSlider()
    }

    nextSlider()

    $('#icon_next').click(nextSlider)
    $('#icon_prev').click(previousSlider)

    $('#btn_next').click(nextSlider)
    $('#btn_prev').click(previousSlider)

    overlap.click(event => {

        const indexActual = parseInt(event.currentTarget.getAttribute('data-index'))

        if (sliderConfig.actual !== indexActual) {
            sliderConfig.actual = indexActual
            updateSlider()
        }
    })

});
