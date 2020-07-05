<?php

namespace module\sistema\controller\login;

use core\controller\AbstractController;
use core\view\View;
use config\SystemConfig;
use core\helper\SessionHelper;
use core\helper\FormatHelper;
use module\framework\bo\FuncionarioBO;
use module\framework\vo\FuncionarioVO;

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
                
                $objFuncionarioBO = new FuncionarioBO();
                $objFuncionarioVO = new FuncionarioVO();
                
                $objFuncionarioVO->setCpf(FormatHelper::removeMask($this->getRequestPost('usuario')));
                $objFuncionarioVO->setSenha($this->getRequestPost('senha'));
                //Verificar se o usuário e senha esta correto
                if (true) {

                    //Seleciona o usuário do banco local
                    $retornoUser = $objFuncionarioBO->selecionarByCpf($objFuncionarioVO);
                    if (!$retornoUser['retornoOperacao']) {
                        echo $this->returnDefaultFailJson(SystemConfig::SYSTEM_MSG['MSG12']);
                        exit();
                    }
//                    var_dump($retornoUser); die;
                    $user = new FuncionarioVO();
                    $user = $retornoUser['retornoOperacao'];
//                    var_dump($user->getCelular());die;
                    /* INFORMACAO DO USUARIO */
                    SessionHelper::setSessionValue('usuNome', $user->getNome());
                    SessionHelper::setSessionValue('usuLogin', $user->getCpf());
                    SessionHelper::setSessionValue('usuId', $user->getId());
//                    /* SEGURANÇA */
//                    
                    SessionHelper::setSessionValue('segTipoUsuario', $user->getTipoUsuario());
                    SessionHelper::setSessionValue('segPerfilDescricao', $user->getTipoUsuario());
                    SessionHelper::setSessionValue('segPermissoes', array());
                    SessionHelper::setSessionValue('segChaveFixa', md5(SystemConfig::CHAVE_APLICACAO));
//                    var_dump($user->getTipoUsuario()); die;

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