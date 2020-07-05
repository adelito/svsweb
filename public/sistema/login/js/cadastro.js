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

    $('#frmLogin')
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
                    CPF: {
                        validators: {
                            notEmpty: {
                                message: SYSTEM_MSG.MSG1
                            },
                            cpfVal:{
                                message: SYSTEM_MSG.MSG19
                            }
                        }
                    },
                    EMAIL: {
                        validators: {
                            notEmpty: {
                                message: SYSTEM_MSG.MSG1
                            },
                            regexp: {
                                regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                                message: SYSTEM_MSG.MSG21
                            }
                        }
                    },
                    CADASTRO: {
                        validators: {
                            notEmpty: {
                                message: SYSTEM_MSG.MSG1
                            }
                        }
                    },                    
                    SENHA: {
                        validators: {
                            notEmpty: {
                                message: SYSTEM_MSG.MSG1
                            },
                            validaSenha: {
                                message: 'A senha deve conter no mínimo 6 caracteres e deve possuir letras e números'
                            }
                        }
                    },
                    DATA_NASCIMENTO: {
                        validators: {
                            notEmpty: {
                                message: SYSTEM_MSG.MSG1
                            },
                             date: {
                                format: 'DD/MM/YYYY',
                                message: SYSTEM_MSG.Adicional_5
                             }
                        }
                    },
                    CONFIRMARSENHA: {
                        validators: {
                            notEmpty: {
                                message: SYSTEM_MSG.MSG1
                            },
                            identical: {
                                field: 'SENHA',
                                message: "As senhas não correspondem"
                            },
                            validaSenha: {
                                message: 'A senha deve conter no mínimo 6 caracteres e deve possuir letras e números'
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

    $('#CPF').mask('999.999.999-99');
    $('#DATA_NASCIMENTO').mask('99/99/9999');
    $('#CADASTRO').mask('9?99999999');
    $('[for=usuario]').append('<sup class="col-red">*</sup>');
    $('[for=DATA_NASCIMENTO]').append('<sup class="col-red">*</sup>');
    $('[for=CONFIRMARSENHA]').append('<sup class="col-red">*</sup>');
    $('[for=SENHA]').append('<sup class="col-red">*</sup>');
    $('[for=CADASTRO]').append('<sup class="col-red">*</sup>');
    $('[for=CPF]').append('<sup class="col-red">*</sup>');
    $('[for=EMAIL]').append('<sup class="col-red">*</sup>');
});





