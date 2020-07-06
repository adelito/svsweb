$(document).ready(function () {
  $("[for=DATA_MOVIMENTACAO]").append('<sup class="col-red">*</sup>');
  var el_data_movimentacao = document.createElement("small");

  var data = new Date(),
    dia = data.getDate(),
    mes = data.getMonth() + 1,
    ano = data.getFullYear(),
    datastring = dia + "/" + mes + "/" + ano;


  $("#ID_NATUREZA_ORCAMENTACAO").change(function () {
    if ($("#ID_NATUREZA_ORCAMENTACAO").val() === "1") {
      $("#DIV_PMO").hide();
      $("#DIV_NDD").show();
    } else {
      $("#DIV_PMO").show();
      $("#DIV_NDD").hide();
    }


  });

  $("#DATA_MOVIMENTACAO").bootstrapMaterialDatePicker("setMaxDate", datastring);

  $("#DATA_DESCENTRALIZACAO").bootstrapMaterialDatePicker(
    "setMaxDate",
    datastring
  );

  $("#DATA_MOVIMENTACAO").on("change", function () {
    el_data_movimentacao.remove();
  });

  var $idMovimentacao;

  $(".bg-orange,.close").on("click", function () {
    el_data_movimentacao.remove();

    $(".btn-salvar").removeAttr("disabled", "disabled");

    $("#ID_STATUS_MOVIMENTACAO").attr("disabled", "disabled");

    $("#ID_STATUS_MOVIMENTACAO").removeAttr("disabled", "disabled");
    $(".btn-salvar").show();
  });

  $("#ID_STATUS_MOVIMENTACAO").on("change", function (e) {
    $(".btn-salvar").removeAttr("disabled", "disabled");

    if (
      $('[name="ID_STATUS_MOV(' + $idMovimentacao + ')"]').val() ==
      $("#ID_STATUS_MOVIMENTACAO").val()
    ) {
      $(".btn-salvar").attr("disabled", "disabled");
    }
  });

  $('[name="movimentacao"]').on("click", function (e) {
    $(".btn-salvar").attr("disabled", "disabled");
    $("#modalNotificacaoServidor .modal-body").html("teste");
    $(".modal").modal("show");

    $idMovimentacao = e.currentTarget.id;
    $("#PMO").val($('[name="NPMO(' + $idMovimentacao + ')"]').val());
    $("#ID_STATUS_MOVIMENTACAO")
      .val($('[name="ID_STATUS_MOV(' + $idMovimentacao + ')"]').val())
      .selectpicker("refresh");
    if (
      $("#ID_STATUS_MOVIMENTACAO").val() === "6" ||
      $("#ID_STATUS_MOVIMENTACAO").val() === "8"
    ) {
      $("#ID_STATUS_MOVIMENTACAO").attr("disabled", "disabled");
      $(".btn-salvar").hide();
      $("#DIV_DT_MOVIMENTACAO").hide();
    } else {
      $(".btn-salvar").show();
      $("#DIV_DT_MOVIMENTACAO").show();
    }

    if ($("#ID_STATUS_MOVIMENTACAO").val() === "1") {
      //  $SQL =' (1,2,3,4)';

      $('[data-original-index="4"]').hide();
      $('[data-original-index="5"]').hide();
      $('[data-original-index="6"]').hide();
      $('[data-original-index="7"]').hide();
    }
    if (
      $("#ID_STATUS_MOVIMENTACAO").val() === "2" ||
      $("#ID_STATUS_MOVIMENTACAO").val() === "3" ||
      $("#ID_STATUS_MOVIMENTACAO").val() === "4"
    ) {
      //  $SQL = '(2,3,4,5,6)';
      $('[data-original-index="0"]').hide();
      $('[data-original-index="6"]').hide();
      $('[data-original-index="7"]').hide();
    }
    if ($("#ID_STATUS_MOVIMENTACAO").val() === "5") {
      //$SQL =' (8,5)';
      $('[data-original-index="0"]').hide();
      $('[data-original-index="1"]').hide();
      $('[data-original-index="2"]').hide();
      $('[data-original-index="3"]').hide();
      $('[data-original-index="5"]').hide();
      $('[data-original-index="6"]').hide();
    }
    if ($("#ID_STATUS_MOVIMENTACAO").val() === "7") {
      // $SQL =' (7,8)';
      $('[data-original-index="0"]').hide();
      $('[data-original-index="1"]').hide();
      $('[data-original-index="2"]').hide();
      $('[data-original-index="3"]').hide();
      $('[data-original-index="4"]').hide();
      $('[data-original-index="5"]').hide();
    }
    if (
      $("#ID_STATUS_MOVIMENTACAO").val() === "6" ||
      $("#ID_STATUS_MOVIMENTACAO").val() === "8"
    ) {
      // $SQL =' (7,8)';
      $("#ID_STATUS_MOVIMENTACAO").attr("disabled", "disabled");
      $('[data-original-index="0"]').hide();
      $('[data-original-index="1"]').hide();
      $('[data-original-index="2"]').hide();
      $('[data-original-index="3"]').hide();
      $('[data-original-index="4"]').hide();
      $('[data-original-index="5"]').hide();
      $('[data-original-index="6"]').hide();
      $('[data-original-index="7"]').hide();
    }
  });

  $(".btn-salvar").on("click", function () {
    if ($("#DATA_MOVIMENTACAO").val() == "") {
      el_data_movimentacao.id = "campoVazio";
      el_data_movimentacao.className = "help-block";
      el_data_movimentacao.style = "color: #a94442";
      el_data_movimentacao.innerHTML = SYSTEM_MSG.MSG1;
      $("#DATA_MOVIMENTACAO").after(el_data_movimentacao);
    } else {
      el_data_movimentacao.remove();
      var $postParams = {
        ID_ORCAMENTACAO: $idMovimentacao,
        ID_STATUS: $("#ID_STATUS_MOVIMENTACAO").val(),
        DATA_MOVIMENTACAO: $("#DATA_MOVIMENTACAO").val()
      };
      $.post(
        getDomain() + "/orcamentacao/movimentacao/" + $idMovimentacao,
        $postParams
      ).done(function (res) {
        var json = JSON.parse(res);
        swal({
          title: json.modal.title,
          text: "Movimentação Alterada com Sucesso",
          type: json.modal.type
        });

        $(".modal").modal("hide");
        $(".confirm").on("click", function () {
          window.location.reload(1);
        });
      });
    }
  });

  createAndRefreshDataTable(10, 10);

  $("#VALOR").maskMoney({ decimal: ",", thousands: ".", precision: 2 });

  $(".pg-adicionar form,.pg-alterar form,.pg-btn-salvar")
    .bootstrapValidator({
      message: "O valor informado não é válido!",
      //live: 'submitted',
      feedbackIcons: {
        valid: "glyphicon glyphicon-ok",
        invalid: "glyphicon glyphicon-remove",
        validating: "glyphicon glyphicon-refresh"
      },
      fields: {}
    })

    .on("success.form.bv", function (e) {
      $(".btn-pesquisar").attr("disabled", "disabled");
      $valorTemp = $("#VALOR").val();
      $("#VALOR").val(
        $("#VALOR")
          .val()
          .replace(/\.|-/gm, "")
      );
      e.preventDefault();
      var $form = $(e.target);
      var metodo = $form.attr("href");

      $.post(metodo, $form.serialize(), function (data) {
        $("#VALOR").val($valorTemp);
        modalAlert(data, $form);
        $("html").click(function () {
          $(".showSweetAlert").addClass("visible");
        });
      });
    });
});
