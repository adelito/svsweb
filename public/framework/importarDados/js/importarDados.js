function validaArquivo() {

    var numberPdf = 0;
    //var arquivosPermitidos = ["pdf", "avi", "mpeg", "png", "jpg"];
    var arquivosPermitidos = ["csv"];
    var retorno = false;

    // console.log(files);                                
//    if (typeof fileInput == "undefined") {
//        return {
//            valid: false,
//            message: SYSTEM_MSG.MSG1,
//        }
//    }

//    if (fileInput['ARQUIVO_FISICO'].filestack.length == 0) {
//        return {
//            valid: false,
//            message: SYSTEM_MSG.MSG1,
//        }
//    }   


    $('.kv-preview-thumb .file-size-info samp').each(function (index) {
        var dados = $(this).text().replace('(', '').replace(')', '').split(' ');

        if (dados[1] == "MB" || dados[1] || "KB" && dados[1] || "B") {
            if (dados[1] == "MB" && dados[0] > 20) {
                retorno = {
                    valid: false,
                    message: SYSTEM_MSG.MSG33
                }
            }
        } else {
            retorno = {
                valid: false,
                message: 'Erro'
            }
        }

    });

    if (retorno != false) {
        return retorno;
    }

    $('.file-caption-info').each(function (index) {
        var ext = $(this).text().split('.').pop();
        if (arquivosPermitidos.indexOf(ext) == '-1') {
            retorno = {
                valid: false,
                message: SYSTEM_MSG.MSG30,
            }
        }
    });

    if (retorno != false) {
        return retorno;
    }
    return true;

}

$(document).ready(function () {

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
                    ARQUIVO_FISICO: {
                        validators: {
                            callback: {
                                callback: function (value, validator, $field) {
                                    //var files = fileInput;                                

                                    return validaArquivo();

                                }
                            }
                        }
                    }

                }
            })
            .on('success.form.bv', function (e) {
                pageLoaderShow("Importando...");
                $('.btn-salvar').attr('disabled', 'disabled');
                e.preventDefault();
                var $form = $(e.target);
                var metodo = $form.attr("action");

                formData = new FormData(e.target);

                $.ajax({
                    url: metodo,
                    type: 'POST',
                    data: formData,
                    success: function (data) {
                        pageLoaderHide();
                        modalAlert(data, $form);
                        
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    xhr: function () { // Custom XMLHttpRequest
                        var myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                            myXhr.upload.addEventListener('progress', function () {
                            }, false);
                        }
                        return myXhr;
                    }
                });



            });

    $("#ARQUIVO_FISICO").fileinput({
        language: "pt-BR",
        allowedFileExtensions: ["csv"],
        maxFileCount: 1,
        maxFileSize: 1024 * 20,
        showRemove: true,
        showUpload: false,
        autoReplace: true,
        dropZoneEnabled: true,
        dropZoneTitle: "Arraste e solte o arquivo aqui.",
        showPreview: false
    });


    $('#ARQUIVO_FISICO').on('fileselect', function (event, numFiles, label) {
        $('#frmUsuarioParticipante').data('bootstrapValidator').revalidateField('ARQUIVO_FISICO[]');
    });


    $('#ARQUIVO_FISICO').on('fileremoved', function (event, key, jqXHR, data) {
        $('#frmUsuarioParticipante').data('bootstrapValidator').revalidateField('ARQUIVO_FISICO[]');
    });


    $('.help-tipo').popover({
        title: 'Tipos de Arquivos',
        trigger: 'hover',
        html: true,
        content: $('.box-help-text').html(),
        container: '.help-tipo',
        placement: 'bottom'
    });

});




