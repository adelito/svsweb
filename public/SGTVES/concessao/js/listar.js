function extractData(link) {
    var obj = {},
        attributes = link.attributes,
        count = attributes.length;

    for(var i = 0; i < count; ++i) {
        var prefixLocation = attributes[i].name.search('data-');

        if(prefixLocation != -1) {
            obj[attributes[i].name.substr(prefixLocation + 5)] = attributes[i].value;
        }
    }

    return obj;
}

$(document).ready(function () {
    $('.openLink').click(function(event) {
        event.preventDefault();

        $form = $('#transport');

        // Extrai os dados dos atributos customizados do link tirando o prefixo "data-"
        var data = extractData(this);

        // Preenche os dados no form
        for(var attr in data) {
            $form.find('input[name="' + attr + '"]').val(data[attr]);
        }

        // Atualiza o action do form com o href do link
        $form.attr('action', this.href);

        // Submete o form
        $form.submit();
    });
    createAndRefreshDataTable(3,10);

    $('frmPublicoAlvo').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            $('.btn-salvar').attr('disabled', 'disabled');
            e.preventDefault();
            var table = $('#gridRender');
            var form = $('#frmPublicoAlvo');
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
