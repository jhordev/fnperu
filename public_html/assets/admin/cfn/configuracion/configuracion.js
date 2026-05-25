$(document).ready(function () {

    /* ── Toggle (boolean) ── */
    $('.config-toggle').on('change', function () {
        var $toggle = $(this);
        var key     = $toggle.data('key');
        var value   = $toggle.is(':checked') ? '1' : '0';

        saveConfig(key, value, 'boolean', function (ok) {
            if (!ok) {
                $toggle.prop('checked', value === '0');
            }
        });
    });

    /* ── Text inputs ── */
    $('.btn-config-save').on('click', function () {
        var $btn    = $(this);
        var key     = $btn.data('key');
        var inputId = $btn.data('target');
        var value   = $('#' + inputId).val().trim();

        if (value === '') {
            Swal.fire({ icon: 'warning', title: 'Campo vacío', text: 'El campo no puede estar vacío.', toast: true, position: 'top-end', timer: 2000, showConfirmButton: false });
            return;
        }

        saveConfig(key, value, 'text', null, $btn);
    });

    /* ── Helper ── */
    function saveConfig(key, value, type, onFail, $btn) {
        var $loader = $btn || null;

        if ($loader) $loader.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i>');

        $.ajax({
            url: base_url + '/configuracion/update',
            method: 'POST',
            data: { key: key, value: value, type: type },
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    Swal.fire({ icon: 'success', title: 'Guardado', text: res.msg, timer: 1800, showConfirmButton: false, toast: true, position: 'top-end' });
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: res.msg });
                    if (typeof onFail === 'function') onFail(false);
                }
            },
            error: function () {
                Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo conectar al servidor.' });
                if (typeof onFail === 'function') onFail(false);
            },
            complete: function () {
                if ($loader) $loader.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk"></i>');
            }
        });
    }

});
