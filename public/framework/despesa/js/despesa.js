$(document).ready(function () {

    $valorTemp = 0;
    $('[for=DESCRICAO]').append('<sup class="col-red">*</sup>');

    $('#ID_TIPO_DESPESA').change(function () {

        if ($('#ID_TIPO_DESPESA').val() === "10") {
            $('#DIV_SUBTIPO').show();
        } else {
            $('#DIV_SUBTIPO').hide();
        }
    });

    $('#ID_SUBTIPO_DESPESA').change(function () {
        if (($('#ID_SUBTIPO_DESPESA').val() === "123")) {
            $('.DIV_SUBTIPO_NTE').show();
            $('.DIV_SUBTIPO_UE').show();
            $('.DIV_SUBTIPO_NTE_UE').show();
        } else if (($('#ID_SUBTIPO_DESPESA').val() === "124")) {
            $('.DIV_SUBTIPO_NTE').show();
            $('.DIV_SUBTIPO_NTE_UE').show();
            $('.DIV_SUBTIPO_UE').hide();
        } else {
            $('.DIV_SUBTIPO_NTE').hide();
            $('.DIV_SUBTIPO_UE').hide();
            $('.DIV_SUBTIPO_NTE_UE').hide();
        }
    });

    $('#VALOR').maskMoney({ decimal: ',', thousands: '.', precision: 2 });

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
                ID_USP: {
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
                ID_FUNCAO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_ELEMENTO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_TIPO_DESPESA: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_GRUPO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_CATEGORIA_ECONOMICA: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_NATUREZA_PAGAMENTO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_NATUREZA: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_SUBFUNCAO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_TIPO_ACAO: {
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
                ID_PRODUTO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_REGIAO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_UNIDADE_MEDIDA: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_UNIDADE_ORCAMENTARIA: {
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
                },
                ID_ORGAO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_PODER: {
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
                ID_SUBFONTE: {
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
                ID_MODALIDADE: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_DESTINACAO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_MODIFICACAO_ORCAMENTARIA: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_PARCELA: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_COMPROMISSOPPA: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                ID_INICIATIVA: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                },
                VALOR: {
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
            $valorTemp = $('#VALOR').val();
            $('#VALOR').val($('#VALOR').val().replace(/\.|-/gm, ''));
            e.preventDefault();
            var $form = $(e.target);
            var metodo = $form.attr('href');
            $.post(metodo, $form.serialize(), function (data) {
                $('#VALOR').val($valorTemp);
                modalAlert(data, $form);
                $('html').click(function () {
                    $('.showSweetAlert').addClass('visible');
                })
            });
        });
        

$(function () {
    $('select').selectpicker();
});

        
});
