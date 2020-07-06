$(document).ready(function() {
  $("[for=DESCRICAO]").append('<sup class="col-red">*</sup>');
  $("[for=ID_SUBTIPO_DESPESA]").append('<sup class="col-red">*</sup>');

  $("#CPF").mask("999.999.999-99");

  $("#VALOR").maskMoney({ decimal: ",", thousands: "", precision: 2 });

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
        ID_PERFIL: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        },
        NOME: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        },
        EMAIL: {
          validators: {
            notEmpty: {
              enabled: true,
              message: SYSTEM_MSG.MSG1
            },
            emailAddress: {
              message: SYSTEM_MSG.MSG52
            }
          }
        },
        CPF: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            },
            cpfVal: {
              message: SYSTEM_MSG.MSG8
            }
          }
        }
      }
    })
    .on("success.form.bv", function(e) {
      $(".btn-salvar").attr("disabled", "disabled");
      e.preventDefault();
      var $form = $(e.target);
      var metodo = $form.attr("href");
      $.post(metodo, $form.serialize(), function(data) {
        modalAlert(data, $form);
        $("html").click(function() {
          $(".showSweetAlert").addClass("visible");
        });
      });
    });
});
