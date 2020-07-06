$(document).ready(function () {



    //MOSTRA E OCULTA A DIV REFORÇO E ANULAÇÃO ATRAVES DA NATUREZA
    $('#ID_NATUREZA_ORCAMENTACAO').ready(function () {
        if ($('#ID_NATUREZA_ORCAMENTACAO').val() === "2") {
            $('#DIV_OCULTA_ANULACAO').show();
            $('#DIV_OCULTA_REFORCO').show();
            $('#DIV_MODIFICACAO_ORCAMENTARIA').show();
        }else{
            $('#DIV_OCULTA_ANULACAO').hide();
            $('#DIV_OCULTA_REFORCO').hide();
            $('#DIV_MODIFICACAO_ORCAMENTARIA').hide();

        }
    });

    //MOSTRA E OCULTA A DIV DESCENTRALIZACAO ATRAVES DA NATUREZA
    $('#ID_NATUREZA_ORCAMENTACAO').ready(function () {

        if ($('#ID_NATUREZA_ORCAMENTACAO').val() === "1") {
            $('#ID_DIV_DESCENTRALIZACAO').show();


        } else {
            $('#ID_DIV_DESCENTRALIZACAO').hide();

        }
    });


    //MOSTRA E OCULTA A DIV TIPO DECRETO ATRAVES DA MODIFICACAO ORCAMENTARIA
    $('#ID_MODIFICACAO_ORCAMENTARIA').ready(function () {
        if ($('#ID_MODIFICACAO_ORCAMENTARIA').val() === "2") {
            $('#DIV_TIPO_DECRETO').show();
        } else {
            $('#DIV_TIPO_DECRETO').hide();


        }
    });


    //MOSTRA E OCULTA A DIV REFORÇO ATRAVES DO TIPO DE DECRETO
    $('#ID_TIPO_DECRETO').ready(function () {
        if ($('#ID_TIPO_DECRETO').val() === "3") {
            $('#DIV_OCULTA_REFORCO').show();
            $('#DIV_OCULTA_ANULACAO').hide();
        }
    });


});
