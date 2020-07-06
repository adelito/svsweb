$(document).ready(function () {

    $('#telefone').mask('(99) 9999-9999');
    $('#celular').mask('(99) 99999-9999');
    $('#cpf').mask('999.999.999-99');

    $('[for=nome]').append('<sup class="col-red">*</sup>');
    $('[for=cpf]').append('<sup class="col-red">*</sup>');
    $('[for=id_setor]').append('<sup class="col-red">*</sup>');
    $('[for=celular]').append('<sup class="col-red">*</sup>');
    $('[for=email]').append('<sup class="col-red">*</sup>');
    $('[for=tipo_usuario]').append('<sup class="col-red">*</sup>');
    $('.no-red').find('.col-red').html('');


    $('.pg-adicionar form,.pg-alterar form').bootstrapValidator({
        message: 'O valor informado não é válido!',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nome: {
                enabled: true,
                validators: {
                    notEmpty: {
                        message: SYSTEM_MSG.MSG1
                    }
                }
            },
            email: {
                enabled: true,
                validators: {
                    notEmpty: {
                        message: SYSTEM_MSG.MSG1
                    }
                }
            },
            celular: {
                enabled: true,
                validators: {
                    notEmpty: {
                        message: SYSTEM_MSG.MSG1
                    }
                }
            },
            id_setor: {
                enabled: true,
                validators: {
                    notEmpty: {
                        message: SYSTEM_MSG.MSG08
                    },
                }
            },
            cpf: {
                enabled: true,
                validators: {
                    notEmpty: {
                        message: SYSTEM_MSG.MSG1
                    },
                    cpfVal: {
                        message: SYSTEM_MSG.MSG18
                    }
                }
            },
            tipo_usuario: {
                enabled: true,
                validators: {
                    notEmpty: {
                        message: SYSTEM_MSG.MSG08
                    }
                }
            },
        }//fields
    })

            .on('success.form.bv', function (e) {
                $('.btn-salvar').attr('disabled', 'disabled');
                e.preventDefault();
                var $form = $(e.target);
                var metodo = $form.attr('href');
                $.post(metodo, $form.serialize(), function (data) {
                    pageLoaderHide();
                    modalAlert(data, $form);
                });
            });


    $('.multiSelect').multiSelect({
        selectableOptgroup: true,
        selectableHeader: "<div class='custom-header'>Recurso(s) Disponível(is):</div>",
        selectionHeader: "<div class='custom-header'>Recurso(s) Selecionado(s):</div>"

    });

});