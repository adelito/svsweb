$(document).ready(function () {

    $('#frmRelatorio').on('success.form.bv', function (e) {

                $('[type="submit"]').removeAttr('disabled');
                OpenFormNewTab('#frmFiltrar');
                e.preventDefault();

            });

});



    $('#valor').maskMoney({ decimal: ',', thousands: '.', precision: 2 });
