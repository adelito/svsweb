$(function () {
    $('.js-sweetalert button').on('click', function () {
        var type = $(this).data('type');
        if (type === 'basic') {
            showBasicMessage();
        }
        else if (type === 'with-title') {
            showWithTitleMessage();
        }
        else if (type === 'success') {
            showSuccessMessage();
        }
        else if (type === 'confirm') {
            showConfirmMessage();
        }
        else if (type === 'cancel') {
            showCancelMessage();
        }
        else if (type === 'with-custom-icon') {
            showWithCustomIconMessage();
        }
        else if (type === 'html-message') {
            showHtmlMessage();
        }
        else if (type === 'autoclose-timer') {
            showAutoCloseTimerMessage();
        }
        else if (type === 'prompt') {
            showPromptMessage();
        }
        else if (type === 'ajax-loader') {
            showAjaxLoaderMessage();
        }
    });
});

//These codes takes from http://t4t5.github.io/sweetalert/
function showBasicMessage() {
    swal("Aqui está uma mensagem!");
}

function showWithTitleMessage() {
    swal("Aqui está uma mensagem!", "É bonito, não é?");
}

function showSuccessMessage() {
    swal("Bom trabalho!", "Você clicou no botão!", "success");
}

function showConfirmMessage() {
    swal({
        title: "Você tem certeza?",
        text: "Você não poderá recuperar este arquivo imaginário!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, exclua-o!",
        closeOnConfirm: false
    }, function () {
        swal("Excluído!", "Seu arquivo imaginário foi excluído.", "success");
    });
}

function showCancelMessage() {
    swal({
        title: "Você tem certeza?",
        text: "Você não poderá recuperar este arquivo imaginário!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, exclua-o!",
        cancelButtonText: "Nãaaaaaaaaao!! Cancele pelo amor de deus!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            swal("Excluído!", "Seu arquivo imaginário foi excluído.", "success");
        } else {
            swal("Cancelado", "Seu arquivo imaginário está salvo :)", "error");
        }
    });
}

function showWithCustomIconMessage() {
    swal({
        title: "Legal!",
        text: "Aqui está uma imagem personalizada.",
        imageUrl: "../core/styleguide/images/thumbs-up.png"
    });
}

function showHtmlMessage() {
    swal({
        title: "HTML <small>Título</small>!",
        text: "Mensagem <span style=\"color: #CC0000\">html<span> personalizada.",
        html: true
    });
}

function showAutoCloseTimerMessage() {
    swal({
        title: "Alerta de alerta automático!",
        text: "Vou fechar em 2 segundos.",
        timer: 2000,
        showConfirmButton: false
    });
}

function showPromptMessage() {
    swal({
        title: "Um input!",
        text: "Escreva algo interessante:",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Escreva algo"
    }, function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
            swal.showInputError("Você precisa escrever alguma coisa!"); return false
        }
        swal("Legal!", "Você escreveu: " + inputValue, "success");
    });
}

function showAjaxLoaderMessage() {
    swal({
        title: "Exemplo de solicitação do Ajax",
        text: "Enviar para executar o pedido ajax",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        setTimeout(function () {
            swal("Pedido do Ajax concluído!");
        }, 2000);
    });
}