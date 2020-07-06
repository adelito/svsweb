var secGrid2 = null;
var listaReforcoGrid = null;
$(document).ready(function() {
  loadDataTable();


  //INICIAR O PLUGIN DO GRID
  secGrid2 = $(".tabelaReforco").secGrid({
    isActionEdit: true,
  //  nameDataValue: "secgrid2",
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
      listaReforcoGrid = secGrid2.getNameValues("ID", [
        "REFORCO_ID_ACAO",
        "REFORCO_ID_NATUREZA",
        "REFORCO_ID_DESTINACAO",
        "REFORCO_VALOR"
      ]);
    },
    actionEdit: function(res) {
      idItem = res.id;
      clearFormAddItem();
      $("#addItemReforco").hide(); //check
      $("#editItemReforco").show();

      $(
        ".selectpicker[data-id='REFORCO_ID_ACAO'], .selectpicker[data-id='REFORCO_ID_NATUREZA'], .selectpicker[data-id='REFORCO_ID_DESTINACAO'],.selectpicker[data-id='REFORCO_VALOR']"
      ).addClass("disabled");
      $("#REFORCO_ID_ACAO").val(res.values[0]).selectpicker("refresh")
      .change();
      $("#REFORCO_ID_NATUREZA").val(res.values[1]).selectpicker("refresh")
      .change();
      $("#REFORCO_ID_DESTINACAO").val(res.values[2]).selectpicker("refresh")
      .change();
      $("#REFORCO_VALOR").val(res.values[3]);
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
  if (listaReforco.length) {
    secGrid2.load(listaReforco);
    loadDataTable();
  }
  // }
  //CARREGAR ITEMS DO BANCO NO GRID
  $("#addItemReforco, #editItemReforco").on("click", function(e) {
    var idSelector = $(this).attr("id");
    isAddItem = idSelector == "addItemReforco";
    $("#formAddItemReforco").submit();
  });
  $("[reset-form-item]").on("click", function(e) {
    clearFormAddItem();
  });

  $("#formAddItemReforco")
    .bootstrapValidator({
      //live: 'submitted',
      feedbackIcons: {
        valid: "glyphicon glyphicon-ok",
        invalid: "glyphicon glyphicon-remove",
        validating: "glyphicon glyphicon-refresh"
      },
      fields: {
        REFORCO_ID_ACAO: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        },
        REFORCO_ID_NATUREZA: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        },
        REFORCO_ID_DESTINACAO: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        },
        REFORCO_VALOR: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        }
      }
    })
    .on("success.form.bv", function(e) {

      var acao_reforco = $("#REFORCO_ID_ACAO")
      .find(":selected")
      .text();
      var natureza_reforco = $("#REFORCO_ID_NATUREZA")
      .find(":selected")
      .text();
      var destinacao_reforco = $("#REFORCO_ID_DESTINACAO")
      .find(":selected")
      .text();

      var id_acao_reforco = $("#REFORCO_ID_ACAO").val();
      var id_natureza_reforco = $("#REFORCO_ID_NATUREZA").val();
      var id_destinacao_reforco = $("#REFORCO_ID_DESTINACAO").val();
      var valor_reforco = $("#REFORCO_VALOR").val();

      if (
        id_acao_reforco == "" ||
        id_natureza_reforco == "" ||
        id_destinacao_reforco == ""||
        valor_reforco == ""
      ) {
        $("#formAddItemReforco")
          .data("bootstrapValidator")
          .enableFieldValidators("REFORCO_ID_ACAO", true);
        $("#formAddItemReforco")
          .data("bootstrapValidator")
          .enableFieldValidators("REFORCO_ID_NATUREZA", true);
        $("#formAddItemReforco")
          .data("bootstrapValidator")
          .enableFieldValidators("REFORCO_ID_DESTINACAO", true);
        $("#formAddItemReforco")
          .data("bootstrapValidator")
          .enableFieldValidators("REFORCO_VALOR", true);
        return;
      }


      datas = {
        id: 0,
        labels: [acao_reforco, natureza_reforco,destinacao_reforco,valor_reforco],
        values: [id_acao_reforco, id_natureza_reforco, id_destinacao_reforco,valor_reforco]
      };
      $("#formAddItemReforco input, #formAddItemReforco textarea").val("");
      $("#formAddItemReforco select")
        .val("")
        .selectpicker("refresh");
      if (isAddItem) {
      //  alert("um novo registro");
        idItem = null;
        secGrid2.addItem({ datas: datas });
      } else {
        //EDITAR NO GRID
        secGrid2.editItem({ datas: datas });
        loadDataTable();
        $("#addItemReforco").show();
        $("#editItemReforco").hide();
        $("#formAddItemReforco").data("bootstrapValidator").resetForm();
        idItem = null;
      }
      $(".btn-salvar").removeAttr("disabled");
      clearFormAddItem();
      return false;
    })
    .on("error.form.bv", function(e) {
      // // clearFormAddItem();

      // var id_acao_reforco = $("#REFORCO_ID_ACAO").val();
      // var id_natureza_reforco = $("#REFORCO_ID_NATUREZA").val();
      // if (!id_acao_reforco || !id_natureza_reforco) {
      //   // alert("essa");
      //   return false;
      // }
      // // alert("essa porra90");
      // if (id_acao_reforco == "" || id_natureza_reforco == "") {
      //   // alert("essa porra");
      //   $("#formAddItem")
      //     .data("bootstrapValidator")
      //     .resetForm();
      //   return;
      // }

      // datas = {
      //   id: 0,
      //   labels: [id_acao_reforco, id_natureza_reforco],
      //   values: [id_acao_reforco, id_natureza_reforco]
      // };
      // $("#formAddItem input, #formAddItem textarea").val("");
      // $("#formAddItem select")
      //   .val("")
      //   .selectpicker("refresh");
      // if (isAddItem) {
      //   idItem = null;
      //   secgrid.addItem({ datas: datas });
      // } else {
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
      // $(".btn-salvar").removeAttr("disabled");
      // clearFormAddItem();
      return false;
    });



  function clearFormAddItem() {
    $("#REFORCO_ID_ACAO, #REFORCO_ID_NATUREZA, #REFORCO_ID_DESTINACAO","#REFORCO_VALOR")
      .val("")
      .selectpicker("refresh");
    isAddItem = false;
    $("#addItemReforco").show();
    $("#editItemReforco").hide();
    $("#formAddItemReforco")
      .data("bootstrapValidator")
      .resetForm();
  }

  $("select").on("change", function() {
    $(".msgError").html("");
  });
});

// function msgError(e, msg) {
//   $(".msgError").html("");
//   e.next()
//     .find(".msgError")
//     .each(function(e) {
//       $(this).html(msg ? msg : SYSTEM_MSG.MSG1);
//       return false;
//     });
// }

function loadDataTable() {
  // dTable = createAndRefreshDataTable(2, 1000, false, null, "#gridTitulacao");
  dTable = createAndRefreshDataTable(4, 1000, false, null, "#gridAnulacao");
  $(".dataTables_paginate").hide();
}
