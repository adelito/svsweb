<?php

namespace config;

use core\config\ControllerCoreConfig;
use module\sistema\util\ControlePermissao;
use core\helper\SessionHelper;
use core\helper\PermissaoAcessoHelper;
use module\sistema\controller\ReiniciarSessaoController;

#***************************************************************
#-> CONTROLADORES
#***************************************************************
# controladores do módulo sistema #
use module\sistema\controller\login\LoginController;
use module\sistema\controller\cadastro\CadastroController;
use module\sistema\controller\error\ErrorController;
use module\sistema\controller\perfil\PerfilController;
use module\sistema\controller\logout\LogoutController;
use module\sistema\controller\RecuperarSenha\RecuperarSenhaController;

# controladores do módulo sgo #
use module\framework\controller\FuncionarioController;
use module\framework\controller\inicioController;

class ControllerConfig extends ControllerCoreConfig
{

    /**
     * getControllerInstance
     * Método que devolve a instancia de um controlador
     * @param type $nomeControlador
     * @return mixed
     */
    static function getControllerInstance($nomeControlador)
    {

        switch ($nomeControlador) {
            case '':
                return new LoginController();
                break;
            case 'login':
                return new LoginController();
                break;
            case 'cadastro':
                return new CadastroController();
                break;
            case 'perfil':
                return new PerfilController();
                break;
            case 'logout':
                return new LogoutController();
                break;
            case 'error':
                return new ErrorController();
                break;
            case 'recuperarSenha':
                return new RecuperarSenhaController();
                break;
            case 'reiniciarsessao':
                return new ReiniciarSessaoController();
                break;

                /* MODULO AGIL */

            case 'inicio':
                return new InicioController();
                break;
            case 'funcionario':
                return new funcionarioController();
                break;
            
        }
    }

    /**
     * validateAction
     * Método que verifica de uma determinada action existe.
     * Caso não exista aciona o controlador 404
     * @param String $controller
     * @param String $action
     */
    static public function validateAction($controller, $action)
    {
        // return true;
        if (!method_exists($controller, $action)) {
            $errorController = new ErrorController();
            $errorController->action404($action);
            die;
        }

        $controlePermissao = new PermissaoAcessoHelper();
        $controller = self::tratarNomeControle($controller);
        $arrayPermissoes = SessionHelper::getSessionValue('segPermissoes');
        $arrayPerfis = SessionHelper::getSessionValue('segPerfis');

        // Controle Permissão Simplificado.
        // FAZER::adicionar IN e criar um item no congif com array contendo controles publicos

        $array_controller = array(
            'login',
            'logout',
            'recuperarsenha',
            'cadastro',
            'perfil',
            'selecionarexercicio',
            'reiniciarsessao',
            'rotina'
        );
        // if (!in_array($controller, $array_controller)) {
        //     // if (empty(SessionHelper::getSessionValue('segPerfil'))) {
        //     //     header("location:/perfil/selecaoPerfil");
        //     // }
        //     if (!in_array($controller, $array_controller)) {
        //         if (empty(SessionHelper::getSessionValue('segExercicio'))) {
        //             header("location:/selecionarexercicio/selecaoExercicio");
        //         }

        //         if (!$controlePermissao->validarPermissao($arrayPermissoes, $controller, $action)) {
        //             $errorController = new ErrorController();
        //             $errorController->acessoNegado($controller);
        //             die;
        //         }
        //     }
        // }
    }
}
