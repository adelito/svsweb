$(document).ready(function () {

    createAndRefreshDataTable(3,10);

    $('frm').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            $('.btn-salvar').attr('disabled', 'disabled');
            e.preventDefault();
            var table = $('#gridRender');
            var form = $('#frm');
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