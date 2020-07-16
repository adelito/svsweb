$(document).ready(function () {


    $('#btnSave').prop('disabled', true);
    $('#upload').change(function () {

        if ($('#upload').val() != '') {
            $('#btnSave').prop('disabled', false);
        }
        if ($('#upload').val() == '') {
            $('#btnSave').prop('disabled', true);
        }
    });


    $('#formulario').submit(function (e) {
        e.preventDefault();
        // pageLoaderShow();
        $.ajax({
            url: "UploadHelper.php",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (result) {
                alert(result)
                if (result == 1) {
                    pageLoaderShow();
                    swal("Suecesso !", "Upload realizado com Sucesso", "success");
                } else {
                    swal("Alerta !", "Erro ao fazer Upload", "error");
                }

            }
        });

    });






});