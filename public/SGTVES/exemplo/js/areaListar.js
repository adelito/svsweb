$(document).ready(function () {

    $('label').append('<sup class="col-red">*</sup>');
    createAndRefreshDataTable(4,150);
    
    $('.pg-adicionar form,.pg-alterar form')
            .bootstrapValidator({
                message: 'O valor informado não é válido!',
                // live: 'submitted',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    DESCRICAO: {
                        validators: {
                            notEmpty: {
                                message: SYSTEM_MSG.MSG1
                            }
                        }
                    }
                }
            })
            .on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    $('.btn-salvar').attr('disabled', 'disabled');
                    e.preventDefault();
                    var table = $('#gridRender');
                    var form = $('#frmCliente');
                    var metodo = form.attr('href');
                    loadTable(table);
                    $.post(metodo, form.serialize(), function (data) {
                        refreshDataTable(table, data);
                    }).done(function () {
                        createAndRefreshDataTable(1);
                        $('.btn-salvar').removeAttr('disabled');
                    });
                }
            });
            
               
});
