var dTable = null;
var dTable2 = null;
var listaAnulacaoGrid = null;
var idItem = null;
var isAddItem = true;
var listaTitulacaoGrid = null;
var secGrid = null;
$(document).ready(function() {
  // alert('Anulacao');

  loadDataTable();
  //INICIAR O PLUGIN DO GRID
  secGrid = $(".tabelaAnulacao").secGrid({
    isActionEdit: true,
    //nameDataValue: "secgrid",
    before: function() {
      dTable.dataTable().fnDestroy();
    },
    success: function() {},
    error: function(e) {
      console.log(e);
    },
    actionAdd: function() {
      loadDataTable();
      $(".btn-salvar").removeAttr("disabled");
      listaAnulacaoGrid = secGrid.getNameValues("ID", [
        "ANULACAO_ID_ACAO",
        "ANULACAO_ID_NATUREZA",
        "ANULACAO_ID_DESTINACAO",
        "ANULACAO_VALOR"
      ]);
    },
    actionEdit: function(res) {
      idItem = res.id;
      clearFormAddItem();
      $("#addItem").hide(); //check
      $("#editItem").show();

      $(
        ".selectpicker[data-id='ANULACAO_ID_ACAO'], .selectpicker[data-id='ANULACAO_ID_NATUREZA'], .selectpicker[data-id='ANULACAO_ID_DESTINACAO'],.selectpicker[data-id='ANULACAO_VALOR']"
      ).addClass("disabled");
      $("#ANULACAO_ID_ACAO").val(res.values[0]).selectpicker("refresh")
      .change();
      $("#ANULACAO_ID_NATUREZA").val(res.values[1]).selectpicker("refresh")
      .change();
      $("#ANULACAO_ID_DESTINACAO").val(res.values[2]).selectpicker("refresh")
      .change();
      $("#ANULACAO_VALOR").val(res.values[3]);
    },
    actionRemove: function(e) {
      clearFormAddItem();
      loadDataTable();
      $(".btn-salvar").removeAttr("disabled");
    }
  });
  //INICIAR O PLUGIN DO GRID

  //CARREGAR ITEMS DO BANCO NO GRID
  // if (listaTituloEspecializacao) {
  if (listaAnulacao.length) {
    secGrid.load(listaAnulacao);
    loadDataTable();
  }
  // }
  //CARREGAR ITEMS DO BANCO NO GRID
  $("#addItem, #editItem").on("click", function(e) {
    var idSelector = $(this).attr("id");
    isAddItem = idSelector == "addItem";
    $("#formAddItem").submit();
  });
  $("[reset-form-item]").on("click", function(e) {
    clearFormAddItem();
  });

  $("#formAddItem")
    .bootstrapValidator({
      //live: 'submitted',
      feedbackIcons: {
        valid: "glyphicon glyphicon-ok",
        invalid: "glyphicon glyphicon-remove",
        validating: "glyphicon glyphicon-refresh"
      },
      fields: {
        ANULACAO_ID_ACAO: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        },
        ID_NATUREZA_ORIGEM: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        },
        ID_DESTINACAO_ORIGEM: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        },
        ANULACAO_VALOR: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        }
      }
    })
    .on("success.form.bv", function(e) {

      var acao_anulacao = $("#ANULACAO_ID_ACAO")
      .find(":selected")
      .text();
      var natureza_anulacao = $("#ANULACAO_ID_NATUREZA")
      .find(":selected")
      .text();
      var destinacao_anulacao = $("#ANULACAO_ID_DESTINACAO")
      .find(":selected")
      .text();

      var id_acao_anulacao = $("#ANULACAO_ID_ACAO").val();
      var id_natureza_anulacao = $("#ANULACAO_ID_NATUREZA").val();
      var id_destinacao_anulacao = $("#ANULACAO_ID_DESTINACAO").val();
      var valor_anulacao = $("#ANULACAO_VALOR").val();

      if (
        id_acao_anulacao == "" ||
        id_natureza_anulacao == "" ||
        id_destinacao_anulacao == ""||
        valor_anulacao == ""
      ) {
        $("#formAddItem")
          .data("bootstrapValidator")
          .enableFieldValidators("ANULACAO_ID_ACAO", true);
        $("#formAddItem")
          .data("bootstrapValidator")
          .enableFieldValidators("ANULACAO_ID_NATUREZA", true);
        $("#formAddItem")
          .data("bootstrapValidator")
          .enableFieldValidators("ANULACAO_ID_DESTINACAO", true);
        $("#formAddItem")
          .data("bootstrapValidator")
          .enableFieldValidators("ANULACAO_VALOR", true);
        return;
      }


      datas = {
        id: 0,
        labels: [acao_anulacao, natureza_anulacao,destinacao_anulacao, valor_anulacao],
        values: [id_acao_anulacao, id_natureza_anulacao, id_destinacao_anulacao, valor_anulacao]
      };
      $("#formAddItem input, #formAddItem textarea").val("");
      $("#formAddItem select")
        .val("")
        .selectpicker("refresh");
      if (isAddItem) {
      //  alert("um novo registro");
        idItem = null;
        secGrid.addItem({ datas: datas });
      } else {
        //EDITAR NO GRID
        secGrid.editItem({ datas: datas });
        loadDataTable();
        $("#addItem").show();
        $("#editItem").hide();
        $("#formAddItem").data("bootstrapValidator").resetForm();
        idItem = null;
      }
      $(".btn-salvar").removeAttr("disabled");
      clearFormAddItem();
      return false;
    })
    .on("error.form.bv", function(e) {
      // // clearFormAddItem();

      // var id_acao_anulacao = $("#ANULACAO_ID_ACAO").val();
      // var id_natureza_origem = $("#ID_NATUREZA_ORIGEM").val();
      // if (!id_acao_anulacao || !id_natureza_origem) {
      //   // alert("essa");
      //   return false;
      // }
      // // alert("essa 0");
      // if (id_acao_anulacao == "" || id_natureza_origem == "") {
      //   // alert("essa");
      //   $("#formAddItem")
      //     .data("bootstrapValidator")
      //     .resetForm();
      //   return;
      // }

 //SUBMETER OS ITEMS DO GRID
 $('. ').on('click', function (e) {
console.log('TESTE-1')
  if ($(this).is('[disabled]'))
      return false;
  e.preventDefault();

  paramPost = secGrid.getNameValues("ID", [
      "ANULACAO_ID_ACAO",
      "ANULACAO_ID_NATUREZA",
      "ANULACAO_ID_DESTINACAO",
      "ANULACAO_VALOR"
  ]);
  console.log('TESTE-2')
  if (paramPost.length > 1) {
    console.log('TESTE-3')
      var $form = $(e.target);
      var url = $form.attr('href');
      $.post(url, { ARRAY_ANULACAO: paramPost }, function (e) {
          $('.btn-salvar').attr('disabled', 'disabled');
      }).done(function (data) {
          json = JSON.parse(data);
          if (json.modal.type == 'error')
              $('.btn-salvar').removeAttr('disabled');
          modalAlert(data, $form);
      }).error(function () {
          $('.btn-salvar').removeAttr('disabled');
      });
  } else {
      alert('Adicione um item na lista');
  }
  return false;

});
//SUBMETER OS ITEMS DO GRID

      // datas = {
      //   id: 0,
      //   labels: [id_acao_anulacao, id_natureza_origem],
      //   values: [id_acao_anulacao, id_natureza_origem]
      // };
      // $("#formAddItem input, #formAddItem textarea").val("");
      // $("#formAddItem select")
      //   .val("")
      //   .selectpicker("refresh");
      // if (isAddItem) {
      //   idItem = null;
      //   secgrid.addItem({ datas: datas });
      // }
      //  else {
      //   //EDITAR NO GRID
      //   secgrid.editItem({ datas: datas });
      //   loadDataTable();
      //   $("#addItemOutroVinculo").show();
      //   $("#editItemOutroVinculo").hide();
      //   $("#formAddItem")
      //     .data("bootstrapValidator")
      //     .resetForm();
      //   idItem = null;
      // }
      $(".btn-salvar").removeAttr("disabled");
      clearFormAddItem();
      return false;
    });




  // function validarValorTotal(idItem, valor_anulacao, valor_reforco) {
  //   var json = secGrid.createJson();
  //   var flag = false;
  //   json.map(function(v, ind, a) {
  //     var idItemAux = null;
  //     var id_outro_vinculo = null;
  //     var id_outro_carga_horaria = null;
  //     var index = 0;

  //     if (
  //       valor_anulacao != valor_reforco
  //     ) {
  //   //  alert('FOI');
  //       }
  //     }
  //   );
  //   return flag;
  // }


  function clearFormAddItem() {
    $("#ANULACAO_ID_ACAO, #ANULACAO_ID_NATUREZA, #ANULACAO_ID_DESTINACAO","#ANULACAO_VALOR")
      .val("")
      .selectpicker("refresh");
    isAddItem = false;
    $("#addItem").show();
    $("#editItem").hide();
    $("#formAddItem")
      .data("bootstrapValidator")
      .resetForm();
  }

  $("select").on("change", function() {
    $(".msgError").html("");
  });
});

function msgError(e, msg) {
  $(".msgError").html("");
  e.next()
    .find(".msgError")
    .each(function(e) {
      $(this).html(msg ? msg : SYSTEM_MSG.MSG1);
      return false;
    });
}

function loadDataTable() {
  // dTable = createAndRefreshDataTable(2, 1000, false, null, "#gridTitulacao");
  dTable = createAndRefreshDataTable(4, 1000, false, null, "#gridAnulacao");
  $(".dataTables_paginate").hide();
}
