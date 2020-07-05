$(document).ready(function () {

    $('#frmSelecionarPerfil')
            .bootstrapValidator({
                message: 'O valor informado não é válido!',
                //live: 'submitted',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    PERFILACESSO: {
                        validators: {
                            notEmpty: {
                                message: SYSTEM_MSG.MSG1
                            }
                        }
                    },
                }
            })
            .on('success.form.bv', function (e) {

                $('.btn-salvar').attr('disabled', 'disabled');
                e.preventDefault();
                var $form = $(e.target);
                var metodo = $form.attr('href');
                $.post(metodo, $form.serialize(), function (data) {
                    modalAlert(data, $form);
                });
            });

    /* ASTERISCO */
    $('[for=DESCRICAO]').append('<sup class="col-red">*</sup>');




});
