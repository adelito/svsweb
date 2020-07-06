$(document).ready(function() {
  $("[for=ID_NATUREZA_ORCAMENTACAO]").append('<sup class="col-red">*</sup>');
  $("[for=VALOR]").append('<sup class="col-red">*</sup>');
  $("[for=N_PMO]").append('<sup class="col-red">*</sup>');

  var data = new Date(),
    dia = data.getDate(),
    mes = data.getMonth() + 1,
    ano = data.getFullYear(),
    datastring = dia + "/" + mes + "/" + ano;

  $("#DATA_DESCENTRALIZACAO").bootstrapMaterialDatePicker(
    "setMaxDate",
    datastring
  );

  $("#ID_NATUREZA_ORCAMENTACAO").ready(function () {
    if ($("#ID_NATUREZA_ORCAMENTACAO").val() === "1") {
      $("#DIV_PMO").hide();
      $("#DIV_NDD").show();
    } else {
      $("#DIV_PMO").show();
      $("#DIV_NDD").hide();
    }


  });
  $("#ID_NATUREZA_ORCAMENTACAO").change(function () {
    if ($("#ID_NATUREZA_ORCAMENTACAO").val() === "1") {
      $("#DIV_PMO").hide();
      $("#DIV_NDD").show();
    } else {
      $("#DIV_PMO").show();
      $("#DIV_NDD").hide();
    }


  });


  //MOSTRA E OCULTA A DIV REFORÇO E ANULAÇÃO ATRAVES DA NATUREZA
  $("#ID_NATUREZA_ORCAMENTACAO").ready(function() {
    if ($("#ID_NATUREZA_ORCAMENTACAO").val() === "2") {
      $("#DIV_OCULTA_ANULACAO").show();
      $("#DIV_OCULTA_REFORCO").show();
      $("#DIV_MODIFICACAO_ORCAMENTARIA").show();
      $("#DIV_REFORCO").show();
      $("#DIV_ANULACAO").show();
    } else {
      $("#DIV_OCULTA_ANULACAO").hide();
      $("#DIV_OCULTA_REFORCO").hide();
      $("#DIV_MODIFICACAO_ORCAMENTARIA").hide();
      $("#DIV_TIPO_DECRETO").hide();
      $("#DIV_REFORCO").hide();
      $("#DIV_ANULACAO").hide();

      $("#ID_ACAO_ANULACAO,#ID_NATUREZA_ORIGEM,#ID_DESTINACAO_ORIGEM")
        .val("")
        .selectpicker("refresh"); //DIV ANULAÇÂO

      $("#ID_ACAO_REFORCO,#ID_NATUREZA_DESTINO,#ID_DESTINACAO_DESTINO")
        .val("")
        .selectpicker("refresh"); //DIV REFORÇO

      $("#ID_MODIFICACAO_ORGAMENTARIA")
        .val("")
        .selectpicker("refresh"); //DIV MOD.ORÇAMENTARIA
    }
  });

  //MOSTRA E OCULTA A DIV DESCENTRALIZACAO ATRAVES DA NATUREZA
  $("#ID_NATUREZA_ORCAMENTACAO").ready(function() {
    if ($("#ID_NATUREZA_ORCAMENTACAO").val() === "1") {
      $("#ID_DIV_DESCENTRALIZACAO").show();
      $("#DIV_DATA_DES").show();

      $("#DIV_OCULTA_ANULACAO").hide();
      $("#DIV_OCULTA_REFORCO").hide();
      $("#ID_TIPO_DECRETO,#ID_MODIFICACAO_ORCAMENTARIA")
        .val("")
        .selectpicker("refresh");
    } else {
      $("#ID_DIV_DESCENTRALIZACAO").hide();
      $("#DIV_DATA_DES").hide();
      $(
        "#ID_ORGAO_ORIGEM,#ID_ORGAO_DESTINO,#ID_UNIDADE_ORCAMENTARIA_ORIGEM,#ID_UNIDADE_ORCAMENTARIA_DEST,#ID_ACAO_ORIGEM,#ID_ACAO_DESTINO,#DATA_DESCENTRALIZACAO"
      )
        .val("")
        .selectpicker("refresh"); //DIV DESCENTRALIZACAO
    }
  });

  //MOSTRA E OCULTA A DIV TIPO DECRETO ATRAVES DA MODIFICACAO ORCAMENTARIA
  $("#ID_MODIFICACAO_ORCAMENTARIA").ready(function() {
    if ($("#ID_MODIFICACAO_ORCAMENTARIA").val() === "2") {
      $("#DIV_TIPO_DECRETO").show();
    } else {
      $("#DIV_TIPO_DECRETO").hide();
      $("#ID_TIPO_DECRETO")
        .val("")
        .selectpicker("refresh");
    }
  });

  //MOSTRA E OCULTA A DIV REFORÇO ATRAVES DO TIPO DE DECRETO
  $("#ID_TIPO_DECRETO").ready(function() {
    if (
      $("#ID_TIPO_DECRETO").val() === "3" ||
      $("#ID_TIPO_DECRETO").val() === "2"
    ) {
      $("#DIV_OCULTA_REFORCO").show();
      $("#DIV_REFORCO").show();
      $("#DIV_OCULTA_ANULACAO").hide();
      $("#DIV_ANULACAO").hide();
    }
  });
  $("#ID_MODIFICACAO_ORCAMENTARIA").change(function() {
    if (
      $("#ID_MODIFICACAO_ORCAMENTARIA").val() !== "2" ||
      $("#ID_MODIFICACAO_ORCAMENTARIA").val() !== ""
    ) {
      $("#DIV_OCULTA_REFORCO").show();
      $("#DIV_OCULTA_ANULACAO").show();
      $("#DIV_REFORCO").show();
      $("#DIV_ANULACAO").show();
    }
  });

  //------------------------------------------------------------
  $("#ID_NATUREZA_ORCAMENTACAO").change(function() {
    if ($("#ID_NATUREZA_ORCAMENTACAO").val() === "2") {
      $("#DIV_OCULTA_ANULACAO").show();
      $("#DIV_OCULTA_REFORCO").show();
      $("#DIV_MODIFICACAO_ORCAMENTARIA").show();
      $("#DIV_REFORCO").show();
      $("#DIV_ANULACAO").show();
    } else {
      $("#DIV_OCULTA_ANULACAO").hide();
      $("#DIV_OCULTA_REFORCO").hide();
      $("#DIV_REFORCO").hide();
      $("#DIV_ANULACAO").hide();
      $("#DIV_MODIFICACAO_ORCAMENTARIA").hide();
      $("#DIV_TIPO_DECRETO").hide();

      $("#ID_ACAO_ANULACAO,#ID_NATUREZA_ORIGEM,#ID_DESTINACAO_ORIGEM")
        .val("")
        .selectpicker("refresh"); //DIV ANULAÇÂO
      $("#ID_ACAO_REFORCO,#ID_NATUREZA_DESTINO,#ID_DESTINACAO_DESTINO")
        .val("")
        .selectpicker("refresh"); //DIV REFORÇO
      $("#ID_MODIFICACAO_ORGAMENTARIA")
        .val("")
        .selectpicker("refresh"); //DIV MOD.ORÇAMENTARIA
    }
  });

  //MOSTRA E OCULTA A DIV DESCENTRALIZACAO ATRAVES DA NATUREZA
  $("#ID_NATUREZA_ORCAMENTACAO").change(function() {
    if ($("#ID_NATUREZA_ORCAMENTACAO").val() === "1") {
      $("#ID_DIV_DESCENTRALIZACAO").show();
      $("#DIV_DATA_DES").show();

      $("#DIV_OCULTA_ANULACAO").hide();
      $("#DIV_OCULTA_REFORCO").hide();
      $("#ID_TIPO_DECRETO,#ID_MODIFICACAO_ORCAMENTARIA")
        .val("")
        .selectpicker("refresh");
    } else {
      $("#ID_DIV_DESCENTRALIZACAO").hide();
      $("#DIV_DATA_DES").hide();
      $(
        "#ID_ORGAO_ORIGEM,#ID_ORGAO_DESTINO,#ID_UNIDADE_ORCAMENTARIA_ORIGEM,#ID_UNIDADE_ORCAMENTARIA_DEST,#ID_ACAO_ORIGEM,#ID_ACAO_DESTINO,#DATA_DESCENTRALIZACAO"
      )
        .val("")
        .selectpicker("refresh"); //DIV DESCENTRALIZACAO
    }
  });

  //MOSTRA E OCULTA A DIV TIPO DECRETO ATRAVES DA MODIFICACAO ORCAMENTARIA
  $("#ID_MODIFICACAO_ORCAMENTARIA").change(function() {
    if ($("#ID_MODIFICACAO_ORCAMENTARIA").val() === "2") {
      $("#DIV_TIPO_DECRETO").show();
    } else {
      $("#DIV_TIPO_DECRETO").hide();
      $("#ID_TIPO_DECRETO")
        .val("")
        .selectpicker("refresh");
    }
  });

  //MOSTRA E OCULTA A DIV REFORÇO ATRAVES DO TIPO DE DECRETO
  $("#ID_TIPO_DECRETO").change(function() {
    if (
      $("#ID_TIPO_DECRETO").val() === "3" ||
      $("#ID_TIPO_DECRETO").val() === "2"
    ) {
      $("#DIV_OCULTA_REFORCO").show();
      $("#DIV_OCULTA_ANULACAO").hide();
      $("#DIV_REFORCO").show();
      $("#DIV_ANULACAO").hide();
    } else {
      $("#DIV_OCULTA_REFORCO").show();
      $("#DIV_OCULTA_ANULACAO").show();
      $("#DIV_REFORCO").show();
      $("#DIV_ANULACAO").show();
    }
  });

  $("#ID_MODIFICACAO_ORCAMENTARIA").change(function() {
    if ($("#ID_MODIFICACAO_ORCAMENTARIA").val() !== "2") {
      $("#DIV_OCULTA_REFORCO").show();
      $("#DIV_OCULTA_ANULACAO").show();
      $("#DIV_REFORCO").show();
      $("#DIV_ANULACAO").show();
    }
  });

  $("#VALOR").maskMoney({ decimal: ",", thousands: ".", precision: 2 });
  $("#N_PMO").maskMoney({ decimal: ".", thousands: ".", precision: 3 });

  $(".pg-adicionar form,.pg-alterar form")
    .bootstrapValidator({
      message: "O valor informado não é válido!",
      //live: 'submitted',
      feedbackIcons: {
        valid: "glyphicon glyphicon-ok",
        invalid: "glyphicon glyphicon-remove",
        validating: "glyphicon glyphicon-refresh"
      },
      fields: {
        ID_NATUREZA_ORCAMENTACAO: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        },

        VALOR: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        },
        N_PMO: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        }
      }
    })
    .on("success.form.bv", function(e) {
      $(".btn-salvar").attr("disabled", "disabled");

      var formData = new FormData()

      // Grid Anulação
      listaAnulacao = secGrid.getNameValues("ID", [
        "ANULACAO_ID_ACAO",
        "ANULACAO_ID_NATUREZA",
        "ANULACAO_ID_DESTINACAO",
        "ANULACAO_VALOR"
    ]);
      listaReforco = secGrid2.getNameValues("ID", [
        "REFORCO_ID_ACAO",
        "REFORCO_ID_NATUREZA",
        "REFORCO_ID_DESTINACAO",
        "REFORCO_VALOR"
    ]);

      e.preventDefault();
      var $form = $(e.target);
      var metodo = $form.attr('href');

      var dadosForm = {}

      $('form').serializeArray().map(function (item) {
        dadosForm[item.name] = item.value;
      });

      dadosForm['ARRAY_ANULACAO'] = listaAnulacao;
      dadosForm['ARRAY_REFORCO'] = listaReforco;



      $valorTemp = $("#VALOR").val();
      $("#VALOR").val(
        $("#VALOR")
          .val()
          .replace(/\.|-/gm, "")
      );


      $.post(metodo, dadosForm, function(data) {
        $("#VALOR").val($valorTemp);
        modalAlert(data, $form);
        $("html").click(function() {
          $(".showSweetAlert").addClass("visible");
        });
      });
    });
});
