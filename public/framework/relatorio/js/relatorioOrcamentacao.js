$(document).ready(function () {

    $("[for=ID_NATUREZA_ORCAMENTACAO]").append('<sup class="col-red">*</sup>');

    $("#ID_NATUREZA_ORCAMENTACAO").change(function () {

        if ($("#ID_NATUREZA_ORCAMENTACAO").val() === "1") {
            $("#ID_DIV_DESCENTRALIZACAO").css("display", "flex");
            $("#ID_DIV_STATUS").css("display", "none");
            // $("#ID_DIV_TIPO_MOVIMENTACAO").css("display", "none");
            // $("#ID_TIPO_MOVIMENTACAO").val("").selectpicker("refresh");
        } else if ($("#ID_NATUREZA_ORCAMENTACAO").val() === "2") {
            $("#ID_DIV_STATUS").css("display", "flex");
            // $("#ID_DIV_TIPO_MOVIMENTACAO").css("display", "flex");
            $("#ID_DIV_DESCENTRALIZACAO").css("display", "none");
            $("#ID_ORGAO_DESTINO").val("").selectpicker("refresh");
            $("#ID_UNIDADE_ORCAMENTARIA_DEST").val("").selectpicker("refresh");
        } else {
            $("#ID_DIV_DESCENTRALIZACAO").css("display", "none");
            $("#ID_DIV_STATUS").css("display", "none"); 
            // $("#ID_DIV_TIPO_MOVIMENTACAO").css("display", "none");
            $("#ID_ORGAO_DESTINO").val("").selectpicker("refresh");
            $("#ID_UNIDADE_ORCAMENTARIA_DEST").val("").selectpicker("refresh");
            // $("#ID_TIPO_MOVIMENTACAO").val("").selectpicker("refresh");
            $("#ID_STATUS").val("").selectpicker("refresh");
        }

    });
    
    createAndRefreshDataTable(4, 150);

    $('.pg-adicionar form,.pg-alterar form').bootstrapValidator({
        message: 'O valor informado não é válido!',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
            fields: {
                ID_NATUREZA_ORCAMENTACAO: {
                    validators: {
                        notEmpty: {
                            message: SYSTEM_MSG.MSG1
                        }
                    }
                }
            }
        });

});
