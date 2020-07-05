//$(document).ready(function () {
//
//    createAndRefreshDataTable(9,100);
//
//    $('#frmRelatorio').on('submit', function (e) {
//        if (!e.isDefaultPrevented()) {
//            $('.btn-salvar').attr('disabled', 'disabled');
//            e.preventDefault();
//            var table = $('#gridRender');
//            var form = $('#frmRelatorio');
//            var metodo = form.attr('action');
//            loadTable(table);
//            $.post(metodo, form.serialize(), function (data) {
//                refreshDataTable(table, data);
//            }).done(function () {
//                createAndRefreshDataTable(9);
//                $('.btn-salvar').removeAttr('disabled');
//            });
//        }
//    });
//});
