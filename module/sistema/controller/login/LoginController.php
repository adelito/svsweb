<?php

namespace module\sistema\controller\login;

use core\controller\AbstractController;
use core\view\View;
use config\SystemConfig;
use core\helper\SessionHelper;
use core\helper\FormatHelper;
use module\SGTVES\bo\UsuarioBO;
use module\SGTVES\vo\UsuarioVO;

class LoginController extends AbstractController {

    public function inicio() {

        $view = new View('login\login', parent::pathToController());
        $view->pageTitle('Login');
        $view->setStyles(array('sistema/login/css/login.css'));
        $view->setScripts(array('sistema/login/js/login.js'));

        if ($this->isPost()) {
            
            try {
                
                SessionHelper::generateSessionName();
                SessionHelper::startSession();
                //                SessionHelper::setSessionValue('captcha', TRUE);
                
                $objUsuarioBO = new UsuarioBO();
                $objUsuarioVO = new UsuarioVO();
                
                $objUsuarioVO->setUsers($this->getRequestPost('usuario'));
                $objUsuarioVO->setPassword($this->getRequestPost('senha'));
                //Verificar se o usuário e senha esta correto
                if ($objUsuarioBO->autenticar($objUsuarioVO)['retornoOperacao']) {

                    // Seleciona o usuário do banco local
                    $retornoUser = $objUsuarioBO->selecionarByUsers($objUsuarioVO);
                    if (!$retornoUser['retornoOperacao']) {
                        echo $this->returnDefaultFailJson(SystemConfig::SYSTEM_MSG['MSG12']);
                        exit();
                    }
                    $user = new UsuarioVO();
                    $user = $retornoUser['retornoOperacao'];
                    /* INFORMACAO DO USUARIO */
                    SessionHelper::setSessionValue('usuNome', $user->getUsers());
                    SessionHelper::setSessionValue('usuTipoUsuario', $user->getNameUsers());
                    SessionHelper::setSessionValue('usuId', $user->getId());
//                    /* SEGURANÇA */
//                    
                    // SessionHelper::setSessionValue('segTipoUsuario', $user->getTipoUsuario());
                    // SessionHelper::setSessionValue('segPerfilDescricao', $user->getTipoUsuario());
                    // SessionHelper::setSessionValue('segPermissoes', array());
                    SessionHelper::setSessionValue('segChaveFixa', md5(SystemConfig::CHAVE_APLICACAO));

                    /* INFORMAÇÕES DE ACESSO */
                    SessionHelper::setSessionValue('aceDataUltimoAcesso', date('Y-m-d'));
                    SessionHelper::setSessionValue('aceHoraUltimoAcesso', date('h:i:s'));
                    SessionHelper::setSessionValue('aceTotalAcesso', 1);
                    
                   
                    echo $this->returnDefaultSuccessJson(SystemConfig::SYSTEM_MSG['MSG12'], 'inicio');
                } else {
                    echo $this->returnDefaultFailJson(SystemConfig::SYSTEM_MSG['MSG7']);
                }
            } catch (\Exception $ex) {
                echo $this->returnDefaultFailJson($ex->getMessage());
            }
            $view->noRenderize();
        }

        $view->disableNavbar();
        $view->disableTopbar();
        $view->disableMain();
        $view->disableSessionControl();
        $view->renderize();
    }

    public function esqueciMinhaSenha() {
        $this->redirect('RecuperarSenha');
    }

}

?>