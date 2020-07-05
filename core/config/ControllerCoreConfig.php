<?php

namespace core\config;

use core\helper\PermissaoAcessoHelper;
use module\sistema\controller\error\ErrorController;
use core\helper\SessionHelper;

class ControllerCoreConfig  {

    /**
     * validateAction
     * Método que verifica de uma determinada action existe. 
     * Caso não exista aciona o controlador 404
     * @param String $controller
     * @param String $action
     */
    static public function validateAction($controller, $action) {
        if (!method_exists($controller, $action)) {
            $errorController = new ErrorController();
            $errorController->action404($action);
            die;
        }
        
        $controlePermissao = new PermissaoAcessoHelper();        
        $controller = self::tratarNomeControle($controller);
        $arrayPermissoes = SessionHelper::getSessionValue('segPermissoes');
        
        // Controle Permissão Simplificado.
        
        // FAZER::adicionar IN e criar um item no congif com array contendo controles publicos
        if ($controller != 'login' && $controller != 'logout' && $controller != 'recuperarsenha') {            
            if (!$controlePermissao->validarPermissao($arrayPermissoes,$controller, $action)) {
                $errorController = new ErrorController();
                $errorController->acessoNegado($controller);
                die;
            }
        }
    }
    
    static public function tratarNomeControle($controller) {
        $arrretorno = explode("\\", get_class($controller));
        $retorno = str_replace('Controller', '', $arrretorno[sizeof($arrretorno) - 1]);
        
        return strtolower($retorno);
    }
}
