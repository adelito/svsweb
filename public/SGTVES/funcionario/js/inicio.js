$(document).ready(function () {
    $('#MATRICULA').mask('?99999');
    $('#CPF').mask('?999.999.999-99');

    $('.js-exportable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        "order": [[2, "desc"]],
        "columnDefs": [
//            {"width": "30px", "targets": 0},
            {"orderable": false, "targets": 0}
        ],
        buttons: [
            {extend: 'copy',
                text: 'Copiar',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7]
                }
            },
            {extend: 'csv',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7]
                }
            },
            {extend: 'excel',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7]
                }
            },
            {extend: 'pdf',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7]
                }
            },
            {extend: 'print',
                text: 'Imprimir Relação',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7]
                }
            }
        ]

    });

    var form_val = $('[name=frmFiltrarUsuarios]');
    form_val.bootstrapValidator({
        message: SYSTEM_MSG.MSG1,
        //live: 'submitted',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            CPF: {
                validators: {
                    cpfVal: {
                        message: 'CPF Inválido!'
                    }
                }
            }

        }
    })
            .on('success.form.bv', function (e) {
                return true;
            });


    $(document).on('change', '[name=frmFiltrarUsuarios] select', function () {
        $('.btn-salvar').removeAttr('disabled');
    });
    
});
