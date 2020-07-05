$(document).ready(function() {
  $("[for=ID_PERFIL]").append('<sup class="col-red"> *</sup>');
  $("[for=NOME]").append('<sup class="col-red"> *</sup>');
  $("[for=CPF]").append('<sup class="col-red"> *</sup>');
  $("[for=EMAIL]").append('<sup class="col-red"> *</sup>');

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
