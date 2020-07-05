$(document).ready(function () {

    //$('[for=DESCRICAO]').append('<sup class="col-red">*</sup>');

    $('#VALOR_CONCESSAO').maskMoney({decimal: ',', thousands: '.', precision: 2});

    $('#DATA_CONCESSAO').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        weekStart: 0,
        time: false
    }).on('change', function (e, date) {
        $('#DATA_CONCESSAO').bootstrapMaterialDatePicker('setMinDate', date);
    });


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
                ID_GRUPO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_FONTE: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_ACAO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_USP: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_UNIDADE_GESTORA: {
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
            $valorTemp = $('#VALOR_SOLICITADO').val();
            $('#VALOR_SOLICITADO').val($('#VALOR_SOLICITADO').val().replace(/\.|-/gm,''));
            $valorTemp1 = $('#VALOR_RECEBIDO').val();
            $('#VALOR_RECEBIDO').val($('#VALOR_RECEBIDO').val().replace(/\.|-/gm,''));
            e.preventDefault();
            var $form = $(e.target);
            var metodo = $form.attr('href');
            $.post(metodo, $form.serialize(), function (data) {
                $('#VALOR_SOLICITADO').val($valorTemp);
                $('#VALOR_RECEBIDO').val($valorTemp1);
                modalAlert(data, $form);
                $('html').click(function () {
                    $('.showSweetAlert').addClass('visible');
                })
            });
        });
});
