
var dTable = null;
var dTable2 = null;
var listaAnulacaoGrid = null;
var idItem = null;
var isAddItem = true;
var listaTitulacaoGrid = null;
var secGrid = null;
var listaGrid = null;

$(document).ready(function () {
    $("#TOTAL").maskMoney({ prefix: "R$ ", decimal: ",", thousands: "." });

    loadDataTable();

    //INICIAR O PLUGIN DO GRID
    secGrid = $(".tabelaDistribuir").secGrid({
        isActionEdit: true,
        //  nameDataValue: "secGrid",
        before: function () {
            atualizaTotal();
            dTable.dataTable().fnDestroy();
        },
        success: function () { atualizaTotal();},
        error: function (e) {
            console.log(e);
            atualizaTotal();
        },
        actionAdd: function () {
            loadDataTable();
            $(".btn-salvar").removeAttr("disabled");
            listaGrid = secGrid.getNameValues("ID", [
                "ID_USP",
                "VALOR"
            ]);
        },
        actionEdit: function (res) {
            idItem = res.id;
            clearFormAddItem();
            $("#addItem").hide(); //check
            $("#editItem").show();

            $(".selectpicker[data-id='ID_USP'], .selectpicker[data-id='ID_NATUREZA_DESTINO'], .selectpicker[data-id='ID_DESTINACAO'],.selectpicker[data-id='VALOR']"
            ).addClass("disabled");
            $("#ID_USP").val(res.values[0]).selectpicker("refresh").change();
            $("#VALOR").val(res.values[1]);
            // atualizaTotal();

        },
        actionRemove: function (e) {
            clearFormAddItem();
            loadDataTable();
            $(".btn-salvar").removeAttr("disabled");
        }
    });
    //INICIAR O PLUGIN DO GRID

    //CARREGAR ITEMS DO BANCO NO GRID
    // if (listaTituloEspecializacao) {
    if (listaDistribuir.length) {
        secGrid.load(listaDistribuir);
        loadDataTable();
    }
    // }
    //CARREGAR ITEMS DO BANCO NO GRID
    $("#addItem, #editItem").on("click", function (e) {
        var idSelector = $(this).attr("id");
        isAddItem = idSelector == "addItem";
        $("#formAddItem").submit();
    });
    $("[reset-form-item]").on("click", function (e) {
        clearFormAddItem();
    });

    // $(".pg-adicionar").on('blur', function (e) {
    //     console.log(e);
    //     if ($("#VALOR").val() != "" || $("#VALOR").val() != '0,00') {
    //         $('#formAddItem').data('bootstrapValidator').enableFieldValidators('VALOR', false);
    //     } else {
    //         $('#formAddItem').data('bootstrapValidator').enableFieldValidators('VALOR', true);
    //     }
    // });
    $("#formAddItem")
        .bootstrapValidator({
            //live: 'submitted',
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                ID_USP: {
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
            }
        })
        .on("success.form.bv", function (e) {
            var usp = $("#ID_USP").find(":selected").text();

            var id_usp = $("#ID_USP").val();
            var valor = $("#VALOR").val();

            if ( usp == "" || valor == "" ) {
            $("#formAddItem").data("bootstrapValidator").enableFieldValidators("ID_USP", true);
            $("#formAddItem").data("bootstrapValidator").enableFieldValidators("VALOR", true);
            return;
            }


            //   if (validarDuplicado(idItem, id_usp, id_natureza)) {
            //   }

            datas = {
                id: 0,
                labels: [usp, valor],
                values: [id_usp, valor]
            };
            // $("#formAddItem input, #formAddItem textarea").val("");
            // $("#formAddItem select").val("").selectpicker("refresh");
            if (isAddItem) {
                //  alert("um novo registro");
                // REGRA, VALOR TOTAL DEVE SER MENOR IGUAL AO VALOR RECEBIDO
                var recebido = 0;
                recebido = $('#VALOR_RECEBIDO').val().replace("R$ ","").replace(/\.|-/gm, '').replace(',', '.');

                var total = 0;
                total = parseFloat($('#TOTAL').val().replace("R$ ","").replace(/\.|-/gm, '').replace(',', '.')) + parseFloat($('#VALOR').val().replace("R$ ","").replace(/\.|-/gm, '').replace(',', '.'));

                if(total > recebido){
                    swal({
                        title: "Erro",
                        text: "O total distribuido deve ser menor ou igual ao valor recebido.",
                        type: "error",
                        confirmButtonColor: "#4caf50",
                        confirmButtonText: "Ok!",
                        closeOnConfirm: false
                    });
                    return;
                }

                idItem = null;
                secGrid.addItem({ datas: datas });
            } else {
                var valorAuxiliar = 0;
                for (let i = 0; i < secGrid.getNameValues("ID", ["ID_USP", "VALOR"]).length; i++) {
                    const element = secGrid.getNameValues("ID", ["ID_USP", "VALOR"])[i];
                    if(element.ID==idItem){
                        valorAuxiliar = element.VALOR;
                    }
                }
                var recebido = 0;
                recebido = parseFloat($('#VALOR_RECEBIDO').val().replace("R$ ","").replace(/\.|-/gm, '').replace(',', '.'));

                var diferença = parseFloat($('#VALOR').val().replace("R$ ","").replace(/\.|-/gm, '').replace(',', '.'))-parseFloat(valorAuxiliar);
                var total = 0;
                total = parseFloat($('#TOTAL').val().replace("R$ ","").replace(/\.|-/gm, '').replace(',', '.')) + diferença;

                if(total.toFixed(2) > recebido.toFixed(2)){
                    swal({
                        title: "Erro",
                        text: "O total distribuido deve ser menor ou igual ao valor recebido.",
                        type: "error",
                        confirmButtonColor: "#4caf50",
                        confirmButtonText: "Ok!",
                        closeOnConfirm: false
                    });
                    return;
                }
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
            atualizaTotal();
            return false;
        })
        .on("error.form.bv", function (e) {
            return true;
        });

    function validarDuplicado(idItem, id_usp, id_natureza) {
        var json = secGrid.createJson();
        var flag = false;
        json.map(function (v, ind, a) {
            var idItemAux = null;
            var id_outro_vinculo = null;
            var id_outro_carga_horaria = null;
            var index = 0;

            v.map(function (item, i, a) {
                if (typeof item.id != "undefined") {
                    idItemAux = item.id;
                }
                if (typeof item.value != "undefined") {
                    if (index == 0) id_outro_vinculo = item.value;
                    else if (index == 1) id_outro_carga_horaria = item.value;
                    index++;
                }
            });

            if (
                id_outro_carga_horaria == id_natureza &&
                id_outro_vinculo == id_usp
            ) {
                if (idItem == null || (idItem > 0 && idItemAux != idItem)) {
                    flag = true;
                    return flag;
                }
            }
        });
        return flag;
    }

    function clearFormAddItem() {
        $("#ID_USP").val("").selectpicker("refresh");
        $("#VALOR").val("");
        isAddItem = false;
        $("#addItem").show();
        $("#editItem").hide();
        $("#formAddItem").data("bootstrapValidator").resetForm();
        $('#formAddItem').data('bootstrapValidator').enableFieldValidators('VALOR', true);
    }

    $("select").on("change", function () {
        $(".msgError").html("");
    });

    //SUBMETER OS ITEMS DO GRID
    $('.btn-salvar').on('click', function (e) {

        if ($(this).is('[disabled]'))
            return false;
        e.preventDefault();

        paramPost = secGrid.getNameValues("ID", [
            "ID_USP",
            "VALOR"
        ]);

        if (paramPost.length) {
            var $form = $(e.target);
            var url = $form.attr('href');
            // alert(url);
            $.post(url, { ID_CONCESSAO:$("[name='ID_CONCESSAO']").val(),ARRAY_DISTRIBUICAO: paramPost }, function (e) {
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
    dTable = createAndRefreshDataTable(2, 1000, false, null, "#gridDistribuir");
    $(".dataTables_paginate").hide();
}
function atualizaTotal() {
    soma = 0; jQuery.each(secGrid.getNameValues("ID", ["ID_USP", "VALOR"]), function () { soma += parseFloat((this.VALOR).replace(/\.|-/gm, '').replace(',', '.')) }); soma;
    $('#TOTAL').val(String(soma.toFixed(2)).replace(".",","));
    $('#TOTAL').maskMoney('mask');
}