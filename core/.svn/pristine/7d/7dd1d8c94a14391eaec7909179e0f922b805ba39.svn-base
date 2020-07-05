<?php

namespace core\component;

/**
 * Description of ModalAlert
 *
 * @author juda.santos
 */
class ModalAlert {

    public static function showModal($modalAlertType, $modalAlertMessage = "", $modalAlertTitle = "") {


        switch ($modalAlertType) {
            case "danger":
                $icon = '<i class="glyphicon glyphicon-fire"></i>';
                if ($modalAlertTitle == "") {
                    $modalAlertTitle = "Erro";
                }
                break;
            case "warning":
                $icon = '<i class="fa fa-warning"></i>';
                if ($modalAlertTitle == "") {
                    $modalAlertTitle = "Alerta";
                }
                break;

            case "info":
                $icon = '<i class="fa fa-envelope"></i>';
                if ($modalAlertTitle == "") {
                    $modalAlertTitle = "Aviso";
                }
                break;

            case "success":
                $icon = '<i class="glyphicon glyphicon-check"></i>';
                if ($modalAlertTitle == "") {
                    $modalAlertTitle = "Sucesso";
                }
                break;

            default:
                $icon = "";
                $modalAlertTitle = "";
                break;
        }


        echo
        " <script>

        $('#modalAlert .modal-header').html('');
        $('#modalAlert').removeClass('modal-info modal-warning modal-success modal-danger');
        $('#modalAlert .btn').removeClass('btn-success');

        $('#modalAlert .modal-header').html('{$icon}');
        $('#modalAlert').addClass('modal-{$modalAlertType}');
        $('#modalAlert .btn').addClass('btn-{$modalAlertType}');

        $('#modalAlert .modal-title').html('{$modalAlertTitle}');
        $('#modalAlert .modal-body').html('{$modalAlertMessage}');

        $('#modalAlert').modal();

        </script>";
    }

    public static function getTemplate() {

        return
                '<!-- End Modal Template -->
           <div id="modalAlert" class="modal modal-message modal-success fade" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>
                        <div class="modal-title">title</div>
                        <div class="modal-body">body</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                        </div>
                    </div> <!-- / .modal-content -->
                </div> <!-- / .modal-dialog -->
            </div>
        <!-- End Modal Templates -->';
    }

    public static function echoTemplate() {

        echo self::getTemplate();
    }

}
