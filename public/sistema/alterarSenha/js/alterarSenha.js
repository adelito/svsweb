/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* 
 * Arquivo padrão de comandos que são carregados pelo sistema em todas as páginas
 */

jQuery(document).ready(function () {

    window.verifyRecaptchaCallback = function (response) {
        $('input[data-recaptcha]').val(response).trigger('change')
    }

    window.expiredRecaptchaCallback = function () {
        $('input[data-recaptcha]').val("").trigger('change')
    }

    $('#frmRecuperarSenha')
            .bootstrapValidator({
                message: 'O valor informado não é válido!',
                //live: 'submitted',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    required: true,
                    cpf: {
                        validators: {
                            notEmpty: {
                                message: 'Este campo é obrigatório!'
                            }
                        }
                    }
                }
            })
            .on('success.form.bv', function (e) {

                $('button[type="submit"]').removeAttr('disabled');
                e.preventDefault();
                var $form = $(e.target);
                var metodo = $form.attr('href');
                $.post(metodo, $form.serialize(), function (data) {
                    modalAlert(data, $form);
                    grecaptcha.reset();
                });
            });
            
    $('#cpf').mask('999.999.999-99');
    $('[for=cpf]').append('<sup class="col-red">*</sup>');
});