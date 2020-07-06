/*
 * Arquivo padrão de comandos que são carregados pelo sistema em todas as páginas
 */

jQuery(document).ready(function() {
  window.verifyRecaptchaCallback = function(response) {
    $("input[data-recaptcha]")
      .val(response)
      .trigger("change");
  };

  window.expiredRecaptchaCallback = function() {
    $("input[data-recaptcha]")
      .val("")
      .trigger("change");
  };

  // $("#usuario").mask("999.999.999-99");

  $("#frmLogin")
    .bootstrapValidator({
      message: "O valor informado não é válido!",
      //live: 'submitted',
      feedbackIcons: {
        valid: "glyphicon glyphicon-ok",
        invalid: "glyphicon glyphicon-remove",
        validating: "glyphicon glyphicon-refresh"
      },
      fields: {
        required: false,
        USUARIO: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        },
        SENHA: {
          validators: {
            notEmpty: {
              message: SYSTEM_MSG.MSG1
            }
          }
        }
      }
    })
    .on("success.form.bv", function(e) {
      $('button[type="submit"]').removeAttr("disabled");
      e.preventDefault();
      var $form = $(e.target);
      var metodo = $form.attr("href");
      $.post(metodo, $form.serialize(), function(data) {
        modalAlert(data, $form);
        grecaptcha.reset();
      });
    });

  //    $('#usuario').mask('999.999.999-99');
  $("[for=usuario]").append('<sup class="col-red">*</sup>');
});
