let Modal = null;

$(document).ready(function () {

        $('[for=ID_STATUS_MOVIMENTACAO]').append('<sup class="col-red">*</sup>');


        if ($('#ID_STATUS_MOVIMENTACAO').val() === "6"||$('#ID_STATUS_MOVIMENTACAO').val() === "7"  ) {
            $('#ID_STATUS_MOVIMENTACAO').attr("disabled","disabled");
            $('.btn-salvar').hide();


        }
    });
//----------------------------------------------------------------------------------



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
                // ID_EXERCICIO: {
                //     validators: {
                //         notEmpty: {
                //             message: SYSTEM_MSG.MSG1
                //         }
                //     }
                // },
                // // ID_NATUREZA: {
                // //     validators: {
                // //         notEmpty: {
                // //             message: SYSTEM_MSG.MSG1
                // //         }
                // //     }
                // // },
                // // ID_MODIFICACAO_ORGAMENTARIA: {
                // //     validators: {
                // //         notEmpty: {
                // //             message: SYSTEM_MSG.MSG1
                // //         }
                // //     }
                // // },
                // ID_ORGAO_ORIGEM: {
                //     validators: {
                //         notEmpty: {
                //             message: SYSTEM_MSG.MSG1
                //         }
                //     }
                // } ,
                // ID_ORGAO_DESTINO: {
                //     validators: {
                //         notEmpty: {
                //             message: SYSTEM_MSG.MSG1
                //         }
                //     }
                // } ,
                // ID_UNIDADE_ORGAMENTARIA_ORIGEM: {
                //     validators: {
                //         notEmpty: {
                //             message: SYSTEM_MSG.MSG1
                //         }
                //     }
                // } ,
                // ID_UNIDADE_ORGAMENTARIA_DESTINO: {
                //     validators: {
                //         notEmpty: {
                //             message: SYSTEM_MSG.MSG1
                //         }
                //     }
                // },
                // ID_ACAO_ORIGEM: {
                //     validators: {
                //         notEmpty: {
                //             message: SYSTEM_MSG.MSG1
                //         }
                //     }
                // },
                // ID_ACAO_DESTINO: {
                //     validators: {
                //         notEmpty: {
                //             message: SYSTEM_MSG.MSG1
                //         }
                //     }
                // },

                // ID_GRUPO: {
                //     validators: {
                //         notEmpty: {
                //             message: SYSTEM_MSG.MSG1
                //         }
                //     }
                // },
                // ID_STATUS_MOVIMENTACAO: {
                //     validators: {
                //         notEmpty: {
                //             message: SYSTEM_MSG.MSG1
                //         }
                //     }
                // }
                // VALOR: {
                //     validators: {
                //         notEmpty: {
                //             message: SYSTEM_MSG.MSG1
                //         }
                //     }
                // }



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

