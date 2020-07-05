$(document).ready(function () {
    
    $('[for=ID_ESFERA_ORCAMENTARIA]').append('<sup class="col-red">*</sup>');
    $('[for=ID_TIPO_RECEITA]').append('<sup class="col-red">*</sup>');
    $('[for=ID_EXERCICIO]').append('<sup class="col-red">*</sup>');
    $('[for=ID_PROGRAMA]').append('<sup class="col-red">*</sup>');
    $('[for=VALOR_INICIAL]').append('<sup class="col-red">*</sup>');


    $('#VALOR_INICIAL').maskMoney({decimal: ',', thousands: '', precision: 2});
    $('#EXCESSO_ARRECADACAO_REC').maskMoney({decimal: ',', thousands: '', precision: 2});
    $('#EXCESSO_ARRECADACAO_PREV').maskMoney({decimal: ',', thousands: '', precision: 2});
    $('#VALOR_ATUAL').maskMoney({decimal: ',', thousands: '', precision: 2});


    $('.pg-adicionar form,.pg-alterar form')
        .bootstrapValidator({
            message: 'O valor informado não é válido!',
            //live: 'submitted',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                ID_TIPO_RECEITA: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_ESFERA_ORCAMENTARIA: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_EXERCICIO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_PROGRAMA: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                VALOR_INICIAL: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                }
            }
        })
        .on('success.form.bv', function (e) {
            $('.btn-salvar').attr('disabled', 'disabled');
            e.preventDefault();
            var $form = $(e.target);
            var metodo = $form.attr('href');
            $.post(metodo, $form.serialize(), function (data) {
                modalAlert(data, $form);
                $('html').click(function () {
                    $('.showSweetAlert').addClass('visible');
                })
            });
        });
});
