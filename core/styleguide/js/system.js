$(document).on('submit', 'form', function () {
   var countError = 0
   $(this).find('.has-error .help-block').each(function () {
       countError++;
   });
   if (countError) {
       var elementoErro = $('.has-error .help-block').eq(0);
       var campo = elementoErro.attr('data-bv-for');
       campo = campo.replace('[]', '');
       try {
           var top = $('[for=' + campo + ']').offset().top;
       } catch (e) {
           var top = elementoErro.parent().offset().top;
       }

       $('html, body').animate({
           scrollTop: top - 100
       }, 1000, function () {
           elementoErro.addClass('destacaErro');
           setTimeout(function () {
               elementoErro.removeClass('destacaErro');
           }, 500)
       });
   }
});

$(document).ready(function (e) {

    $("[form-submit]").click(function () {
        $('form').submit();
        return false;
    });

    $("[form-reset]").click(function () {
        $('form').trigger('reset');

        const validator = $('form').data('bootstrapValidator');
        if (validator !== undefined) {
            validator.resetForm();
        }

        $('select,input:not(:checkbox,:radio)').not("[no-reset]").val("");
        $(":checkbox,:radio").not("[no-reset]").removeProp("checked");
        $('.selectpicker').not("[no-reset]").selectpicker('refresh');

        return false;
    });



    $("[form-print]").click(function () {
        window.print();
        return false;
    });

    $.mask.definitions['~'] = "[+-]";

    $('.mask-date').mask('99/99/9999');
    $('.mask-time-hms').mask('99:99:99');
    $('.mask-time-hm').mask('99:99');

    $('.mask-moeda').maskMoney({decimal: ',', thousands: '.', precision: 2});


    $('.selectpickerG').on('hide.bs.select', function (e) {

        if ($(this).attr('tipotelefone-mascara-destino') !== undefined && $(this).val() != "") {

            var destino = $(this).attr('tipotelefone-mascara-destino');
            $.post($('#system-url').val() + '/helperView/tipoTelefoneMascara/' + $(this).val(), null, function (data) {

                $('#' + destino).mask($.trim(data));
            });
        }
    });


    /******************************** [ VALIDATE ] ********************************/

    $('input[type=text], selects,textarea').change(function () {


        if ($('form').data('bootstrapValidator') !== undefined) {
            if ($(this).attr('enableDisableValidatorOnChange') !== undefined) {

                if ($(this).val() == '') {
                    $('form').data('bootstrapValidator').enableFieldValidators($(this).attr('enableDisableValidatorOnChange'), false, 'notEmpty');
                } else {
                    $('form').data('bootstrapValidator').enableFieldValidators($(this).attr('enableDisableValidatorOnChange'), true, 'notEmpty');
                }
            }
            $('form').data('bootstrapValidator').revalidateField($(this).attr('name'));
            $('form').data('bootstrapValidator').revalidateField($(this).attr('enableDisableValidatorOnChange'));
        }
    });


    /************************* [ ACOES DOS BOTÕES GRID ] **************************/

    $(document).on('click', '.alert-confirm-excluir', function (e) {

        e.preventDefault();

        var form = $('form');
        var href = $(this).prop('href');

        var objRegistro = $('#tr' + $(this).attr('target-id'));

        swal({
            title: "Você tem certeza que deseja excluir?",
            text: "Esta operação não poderá ser desfeita",
            type: "warning",
            showCancelButton: true,
//            confirmButtonColor: "#DD6B55",
            confirmButtonColor: "#4caf50",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Sim, tenho certeza!",
            closeOnConfirm: false
        }, function () {
            $.post(href, function (data) {
                var json = JSON.parse(data);

                var swalAjaxMessage = json.modal.message;
                var swalAjaxType = json.modal.type;
                var swalAjaxIcon = json.modal.icon;
                var swalAjaxTitle = json.modal.title;
                var swalAjaxUrlRedirect = json.modal.urlRedirect;

                if (json.erro == 0) {
                    $('button.confirm').attr("url", swalAjaxUrlRedirect);

                } else {
                    if (form != false) {
                        $('button.confirm').attr("url", swalAjaxUrlRedirect);
                        form.find('button.confirm').removeAttr('disabled');
                    }
                }
                swal(swalAjaxTitle, swalAjaxMessage, swalAjaxType);

                $('button.confirm').on('click', function () {
                    location.href = $(this).attr('url');
                    return false;
                });
            });

        });

        return false;
    });



    $(document).on('click', '.alert-confirm-ativar', function (e) {

        e.preventDefault();

        var form = $('form');
        var href = $(this).prop('href');
        var objRegistro = $('#tr' + $(this).attr('target-id'));

        swal({
            title: "Você tem certeza que deseja ativar o registro?",
            text: "Você poderá modificar o status posteriormente",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#4caf50",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Sim, tenho certeza!",
            closeOnConfirm: false
        }, function () {
            $.post(href, function (data) {
                var json = JSON.parse(data);

                var swalAjaxMessage = json.modal.message;
                var swalAjaxType = json.modal.type;
                var swalAjaxIcon = json.modal.icon;
                var swalAjaxTitle = json.modal.title;
                var swalAjaxUrlRedirect = json.modal.urlRedirect;

                if (json.erro == 0) {
                    $('button.confirm').on('click', function () {
                        location.href = swalAjaxUrlRedirect;
                        return false;
                    });

                } else {
                    if (form != false) {
                        form.find('button.confirm').removeAttr('disabled');
                    }
                }
                swal(swalAjaxTitle, swalAjaxMessage, swalAjaxType);

                $('button.confirm').on('click', function () {
                    return false;
                });
            });

        });

        return false;
    });



    $(document).on('click', '.alert-confirm-inativar', function (e) {

        e.preventDefault();

        var form = $('form');
        var href = $(this).prop('href');
        var objRegistro = $('#tr' + $(this).attr('target-id'));

        swal({
            title: "Você tem certeza que deseja inativar o registro?",
            text: "Você poderá modificar o status posteriormente",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#4caf50",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Sim, tenho certeza!",
            closeOnConfirm: false
        }, function () {
            $.post(href, function (data) {
                var json = JSON.parse(data);

                var swalAjaxMessage = json.modal.message;
                var swalAjaxType = json.modal.type;
                var swalAjaxIcon = json.modal.icon;
                var swalAjaxTitle = json.modal.title;
                var swalAjaxUrlRedirect = json.modal.urlRedirect;

                if (json.erro == 0) {

                    $('button.confirm').on('click', function () {
                        location.href = swalAjaxUrlRedirect;
                        return false;
                    });

                } else {
                    if (form != false) {
                        form.find('button.confirm').removeAttr('disabled');
                    }
                }
                swal(swalAjaxTitle, swalAjaxMessage, swalAjaxType);

                $('button.confirm').on('click', function () {
                    return false;
                });
            });

        });

        return false;
    });



    $(document).on('click', '.alert-confirm', function (e) {
        e.preventDefault();

        var href = $(this).prop('href');
        var objRegistro = $('#tr' + $(this).attr('target-id'));

        swal({
            title: "Você tem certeza que deseja confirmar o registro?",
            text: "Você poderá modificar o status posteriormente",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#4caf50",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Sim, tenho certeza!",
            closeOnConfirm: false
        }, function () {
            $.post(href, function (data) {
                var json = JSON.parse(data);

                var swalAjaxMessage = json.modal.message;
                var swalAjaxType = json.modal.type;
                var swalAjaxIcon = json.modal.icon;
                var swalAjaxTitle = json.modal.title;
                var swalAjaxUrlRedirect = json.modal.urlRedirect;

                if (json.erro == 0) {

                    $('button.confirm').on('click', function () {
                        location.href = swalAjaxUrlRedirect;
                        return false;
                    });

                } else {
                    if (form != false) {
                        form.find('button.confirm').removeAttr('disabled');
                    }
                }
                swal(swalAjaxTitle, swalAjaxMessage, swalAjaxType);

                $('button.confirm').on('click', function () {
                    return false;
                });
            });

        });

        return false;
    });


    /************************* [ BOOTSTRAP VALIDATOR ] **************************/

    e.fn.bootstrapValidator.validators.notSpecialChar = {
        html5Attributes: {
            message: "message"
        },
        validate: function (e, t, n) {
            var isValid = true;
            var inputValue = t.val();
            if (/[^A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9\s]+/g.test(inputValue)) {
                isValid = false;
            }

            return isValid;
        }
    }

    e.fn.bootstrapValidator.validators.validaSenha = {
        html5Attributes: {
            message: "message"
        },
        validate: function (e, t, n) {
            var senha = t.val();
            if (senha == "") {
                return true
            }
            //Senha n pode ser menor que 6
            if (senha.length < 6 || senha.search(/[a-zA-Z]/) < 0 || senha.search(/[0-9]/) < 0) {
                return false;
            }
            return true;
        }
    }

    e.fn.bootstrapValidator.validators.cnpjVal = {
        html5Attributes: {
            message: "message"
        },
        validate: function (e, t, n) {
            var r = t.val();
            if (r == "") {
                return true
            }
            cnpj = r.replace(/[^\d]+/g, '');

            while (cnpj.length < 14)
                cnpj = "0" + cnpj;

            var z = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
            var s = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
            var o = [];
            var u = new Number;

            for (i = 0; i < 12; i++) {
                o[i] = cnpj.charAt(i);
                u += o[i] * s[i + 1];
            }

            if ((x = u % 11) < 2) {
                o[12] = 0
            } else {
                o[12] = 11 - x
            }
            u = 0;

            for (y = 0; y < 13; y++)
                u += o[y] * s[y];

            if ((x = u % 11) < 2) {
                o[13] = 0
            } else {
                o[13] = 11 - x
            }

            if (cnpj.charAt(12) != o[12] || cnpj.charAt(13) != o[13] || cnpj.match(z))
                return false;
            return true
        }
    }


    e.fn.bootstrapValidator.validators.cpfVal = {
        html5Attributes: {
            message: "message"
        },
        validate: function (e, t, n) {
            var r = t.val();
            if (r == "") {
                return true
            }
            cpf = r.replace(/[^\d]+/g, '');

            if (/^1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11}|0{11}$/.test(cpf)) {
                return false;
            }
            if (!/^\d{11}$/.test(cpf) && !/^\d{3}\.\d{3}\.\d{3}-\d{2}$/.test(cpf)) {
                return false;
            }

            var d1 = 0;
            for (var i = 0; i < 9; i++) {
                d1 += (10 - i) * parseInt(cpf.charAt(i), 10);
            }
            d1 = 11 - d1 % 11;
            if (d1 === 10 || d1 === 11) {
                d1 = 0;
            }
            if (d1 + '' !== cpf.charAt(9)) {
                return false;
            }

            var d2 = 0;
            for (i = 0; i < 10; i++) {
                d2 += (11 - i) * parseInt(cpf.charAt(i), 10);
            }
            d2 = 11 - d2 % 11;
            if (d2 === 10 || d2 === 11) {
                d2 = 0;
            }

            return (d2 + '' === cpf.charAt(10));
        }
    }


    /************************* [ PICKER  ] **************************/


    $('.secdatetimepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        clearButton: true,
        weekStart: 1
    });

    $('.secdatepicker').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
    });
    $('.secdatepickerextenso').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
    });

    $('.sectimepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        clearButton: true,
        date: false
    });


    /************************* [ MULTISELECT  ] **************************/

    $('[data-multiselect]').each(function (index, el) {
        var id = $(this).prop('id');
        var verticalAlign = $(this).attr('data-vertical');
        var tituloDisponivel = $(this).attr('data-tituloDisponivel');
        var tituloSelecionado = $(this).attr('data-tituloSelecionado');
        var callbackSelect = $(this).attr('data-callback-select');
        var callbackDeselect = $(this).attr('data-callback-deselect');

        if (tituloDisponivel == undefined) {
            tituloDisponivel = 'Disponível(is)';
        }
        if (tituloSelecionado == undefined) {
            tituloSelecionado = 'Selecionado(s)';
        }

        $(el).multiSelect({
            selectableOptgroup: true,
            selectableHeader: "<div class='custom-header'>" + tituloDisponivel + "</div>",
            selectionHeader: "<div class='custom-header'>" + tituloSelecionado + "</div>",
            keepOrder: true,
            afterSelect: function (value) {
                if (callbackSelect != undefined) {
                    eval(callbackSelect + '(' + value + ')');
                }
            },
            afterDeselect: function (value) {
                if (callbackDeselect != undefined) {
                    eval(callbackDeselect + '(' + value + ')');
                }
            }
        });

        $('[data-id="' + id + '"][data-toggle="dropdown"]').css("display", "none");

        //verifica se é vertical align
        if (verticalAlign != undefined) {
            $('#ms-' + id).addClass('ms-vertical');
        }

    });

    /*  
     data-multiselect                              // Habilita o componente
     data-vertical='true'                          // Alinhamento vertical
     data-tituloDisponivel="Disponíveis"           // Titulo do box 1 
     data-tituloSelecionado="Adicionados"          // Titulo do box2
     data-callback-select="nomeDaFuncao"               // Funcao do javascript que irá chamar caso seja selecionado  EX:  nomeDaFuncao()
     data-callback-deselect="nomeDaFuncao"             // Funcao do javascript que irá chamar caso seja deselecionado EX: nomeDaFuncao() 
     */


    /************************* [ PRELOAD  ] **************************/

});

function pageLoaderShow(mensagem = 'Carregando...') {
    var loader = $('.page-loader-wrapper');
    loader.css('background', '#eeeeeeb8');
    $('body').css('overflow', 'hidden');
    loader.find('p').html(mensagem);
    loader.show();
}

function pageLoaderHide() {
    var loader = $('.page-loader-wrapper');
    $('body').css('overflow', 'auto');
    loader.hide();
}



/************************* [ DATATABLE  ] **************************/


// informar o id da div/table que será atualizada e o retorno do Ajax.
function refreshDataTable(table, retornoAjax) {
    table.html($(retornoAjax).find('#' + table.attr('id') + '>'));
}

// Aparece uma mensagem informando que a Table/Div está carregando...
function loadTable(element) {

    if (element.closest('section').length > 0) {
        element.html('<div style="border-radius: 0px; background-color: #194e91;" class="alert alert-callout " role="alert"><i class=""></i> <strong>Carregando...</strong></div>');
    } else {
        element.html('<section><div style="border-radius: 0px; background-color: #194e91;" class="section-body alert alert-callout" role="alert"><i class=""></i> <strong>Carregando...</strong></div></section>');
    }
}

function createAndRefreshDataTable(columnsNum, itensPage, orderBy = false, orientation = null) {

    if (columnsNum !== undefined) {
        var columnsNumArray = columnsToArray(columnsNum);
    } else {
        var columnsNumArray = [];
    }

    if (itensPage === undefined) {
        var itensPage = 5;
    }

    $('.js-exportable').dataTable().fnDestroy();

    return $('.js-exportable').dataTable({
        "iDisplayLength": parseInt(itensPage),
        responsive: true,
        dom: 'Bfrtip',
        "order": orderBy,
        "columnDefs": [
            {"orderable": false, "targets": 0}
        ],
        buttons: [
            {extend: 'copy',
                text: 'Copiar',
                exportOptions: {
                    columns: columnsNumArray
                }
            },
            {extend: 'csv',
                exportOptions: {
                    columns: columnsNumArray
                }
            },
            {extend: 'excel',
                exportOptions: {
                    columns: columnsNumArray
                }
            },
            {extend: 'pdf',
                orientation: orientation,
                exportOptions: {
                    columns: columnsNumArray
                }
            },
            {extend: 'print',
            text: 'Imprimir Relação',
            exportOptions: {
                columns: columnsNumArray,
                stripHtml: true
            },
            customize: function(win)
            {
                if(orientation=='landscape'){
                    var css = '@page { size: landscape; }',
                        head = win.document.head || win.document.getElementsByTagName('head')[0],
                        style = win.document.createElement('style');
                    style.type = 'text/css';
                    style.media = 'print';

                    if (style.styleSheet)
                    {0
                    style.styleSheet.cssText = css;
                    }
                    else
                    {
                    style.appendChild(win.document.createTextNode(css));
                    }

                    head.appendChild(style);
                }
            }
        }
        ]

    });
}

/**
 * Transforma quantidade de colunas em array para 
 * utilizar no método createAndRefreshDataTable
 */
function columnsToArray(columnsNum) {

    var columnsNum = parseInt(columnsNum);
    var columnsNumArray = [];

    for (var i = 0; i < columnsNum; i++) {
        columnsNumArray[i] = i + 1;
    }
    return columnsNumArray;
}



/************************* [ MAGIC ] **************************/

/**
 * Função para abertura de tela de relatório
 * resolvendo erro do bootstrap validator
 */
function OpenFormNewTab(form) {
    var dadosForm = $(form).serializeArray();
    var action = $(form).attr('action');

    $('.aux_form').remove();
    var $newForm = $("<form class='aux_form' action='" + action + "' method='post' target='_blank' style='display:none'></form>");

    $.each(dadosForm, function (index, dados) {
        $newForm.append('<input type="text" name="' + dados.name + '"  value="' + dados.value + '">');
    });

    $('body').append($newForm);
    $('.aux_form').trigger('submit');
}
