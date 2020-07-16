$(document).ready(function () {


    $('.pg-adicionar form,.pg-alterar form').bootstrapValidator({
        message: 'O valor informado não é válido!',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            id_cliente: {
                enabled: true,
                validators: {
                    notEmpty: {
                        message: SYSTEM_MSG.MSG1
                    }
                }
            },

        }//fields
    }) .on()

        .on('success.form.bv', function (e) {
            $('.btn-salvar').attr('disabled', 'disabled');
            e.preventDefault();
            var $form = $(e.target)
            var metodo = $form.attr('href');
            $.post(metodo, $form.serialize(), function (data) {
                pageLoaderHide();
                modalAlert(data, $form);
            });
        });



});
