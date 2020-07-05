<?php

namespace module\sistema\controller\cadastro;

use core\controller\AbstractController;
use core\view\View;
use core\bo\rasea\RaseaBO;
use core\vo\rasea\RaseaVO;
use module\siapp\vo\UsuarioVO;
use module\siapp\bo\UsuarioBO;
use config\SystemConfig;
use core\helper\SessionHelper;
use core\helper\SafeHelper;
use \module\siapp\vo\PerfilNteVO;
use \module\siapp\consts\PerfilConsts;
use core\helper\FormatHelper;
use core\helper\EmailHelper;

class CadastroController extends AbstractController {

    public function inicio() {

        $view = new View('cadastro\cadastro', parent::pathToController());
        $view->pageTitle('Cadastro');
        $view->setStyles(array('sistema/login/css/login.css'));
        $view->setScripts(array('sistema/login/js/cadastro.js'));


        if ($this->isPost()) {
            try {

                $session = $this->getSession();
                $post = $this->getAllRequestPost();


                $objRaseaVO = new RaseaVO();
                $objRaseaVO->setAplicacaoNome(SystemConfig::AUTH_RASEA_APPLICATION_NAME);
                $objRaseaVO->setPerfilNome('professor');
                $objRaseaVO->setUsuarioEmail($this->getRequestPost('EMAIL'));
                $objRaseaVO->setUsuarioLogin(FormatHelper::removeMask($this->getRequestPost('CPF')));
                $objRaseaVO->setUsuarioSenha($this->getRequestPost('SENHA'));


                # VERIFICANDO SE O RECAPTCHA FOI DEVIDAMENTE PREENCHIDO EM PRODUCÃƒO
                if (SystemConfig::ENVIRONMENT == 'PRODUCAO') {
                    if (!SafeHelper::isValidReCaptcha($this->getRequestPost('g-recaptcha-response'), $_SERVER['REMOTE_ADDR'])) {
                        echo $this->returnDefaultFailJson("reCAPTCHA invÃ¡lido!", 'inscricao');
                    }
                }
                SessionHelper::setSessionValue('captcha', TRUE);

                $objUsuarioVO = new UsuarioVO();
                $objUsuarioBO = new UsuarioBO();
                $objUsuarioVO->setRaseaVO($objRaseaVO);
                $objUsuarioVO->bind($post);
                $objUsuarioVO->setUsuarioInclusao('Cadastro');
                $objPerfilNteVO = new PerfilNteVO();
                $objPerfilNteVO->setIdPerfil(PerfilConsts::PROFESSOR);
                $objPerfilNteVO->setDescricao(PerfilConsts::obterValues(PerfilConsts::PROFESSOR));
                $objPerfilNteVO->setUsuarioInclusao('Cadastro');

                $objUsuarioVO->getPerfisNteArrayInterator()->append($objPerfilNteVO);
                $retorno = $objUsuarioBO->inserirUsuarioProfessor($objUsuarioVO);


                if ($retorno['retornoOperacao']) {
                    $textoProvisorioSenha = EmailHelper::aplicarTemplatePadrao("<strong> Acesso ao SEC SIAPP </strong> <br><br>"
                                    . "<strong>Usuário:</strong> " . $objRaseaVO->getUsuarioLogin() . "<br>"
                                    . "<strong>Senha:</strong> " . $objRaseaVO->getUsuarioSenha() . "<br>");
                    EmailHelper::enviar("Login", $textoProvisorioSenha, SystemConfig::EMAIL_REMETENTE, SystemConfig::NOME_REMETENTE, $this->getRequestPost('EMAIL'));
                } else {
                    echo $this->returnDefaultFailJson('Não foi Possível realizar a operação', 'usuario');
                }


                echo $this->returnDefaultSuccessJson($retorno, 'inicio');
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

    public function registrarProfessor() {
        
    }

}

?>