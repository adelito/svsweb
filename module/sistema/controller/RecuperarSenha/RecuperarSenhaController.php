<?php

namespace module\sistema\controller\RecuperarSenha;

use core\controller\AbstractController;
use core\view\View;
use core\bo\rasea\RaseaBO;
use core\vo\rasea\RaseaVO;
use core\helper\ControllerHelper;
use core\helper\SafeHelper;
use core\helper\EmailHelper;
use config\SystemConfig;
use core\helper\FormatHelper;
use module\siapp\vo\UsuarioVO;
use module\siapp\bo\UsuarioBO;

class RecuperarSenhaController extends AbstractController {

    public function inicio() {

        $view = new View('recuperarSenha\recuperarSenha', parent::pathToController());
        $view->pageTitle('Recuperar senha');
        $view->setStyles(array('sistema/login/css/login.css'));
        $view->setScripts(array('sistema/login/js/recuperarSenha.js'));

        $objControllerHelper = new ControllerHelper();

        if ($this->isPost()) {
            $post = $this->getAllRequestPost();

            try {
                // Os Perfis Administrativo, Equipe Codeb e Coordenador Codeb não enviarão o input cadastro e seguirão o novo fluxo de recuperação de senha
                if (!isset($post['CADASTRO'])) {

                     $objRaseaBO = new RaseaBO();
                    $objRaseaVO = new RaseaVO();

                    $objRaseaVO->setUsuarioLogin(FormatHelper::removeMask($this->getRequestPost('CPF')));					
					$email = trim($objRaseaBO->obterEmail($objRaseaVO));					
					
					if (empty($email)) {
						$objRaseaVO->setUsuarioLogin($this->getRequestPost('CPF'));
						$email = trim($objRaseaBO->obterEmail($objRaseaVO));						                      
                    }
					
					if (empty($email)) {
                        echo $this->returnDefaultFailJson('Caso você possua cadastro, a senha foi enviada para o e-mail cadastrado. No caso de não recebimento da senha, favor entrar em contato com o gestor do sistema.');
                    }
					
					
                    $objRaseaVO->setNovaSenha(SafeHelper::geraSenha(6));

                    $objControllerHelper->setRetorno($objRaseaBO->recuperarSenha($objRaseaVO));                 

                    $textoProvisorioSenha = EmailHelper::aplicarTemplatePadrao("<strong> Acesso ao SIAPP</strong> <br><br>"
                                    . "<strong>Usuário:</strong> " . $this->getRequestPost('CPF') . "<br>"
                                    . "<strong>Nova senha:</strong> " . $objRaseaVO->getNovaSenha() . "<br>");

                    EmailHelper::enviar("Recuperação de senha", $textoProvisorioSenha, SystemConfig::EMAIL_REMETENTE, SystemConfig::NOME_REMETENTE, $email);

                    if ($objControllerHelper->getRetornoOperacao()) {
                        echo $this->returnDefaultSuccessJson($objControllerHelper->getRetornoMensagem(), 'login');
                    } else {
                        echo $this->returnDefaultFailJson($objControllerHelper->getRetornoMensagem());
                    }
                } else {
                    $objUsuarioVO = new UsuarioVO();
                    $objUsuarioBO = new UsuarioBO();
                    $objUsuarioVO->bind($post);

                    if ($objUsuarioBO->validaRecuperacaoSenha($objUsuarioVO)['retornoOperacao']) {

                        $objRaseaBO = new RaseaBO();
                        $objRaseaVO = new RaseaVO();

                        $objRaseaVO->setAplicacaoNome(SystemConfig::AUTH_RASEA_APPLICATION_NAME);
                        $objRaseaVO->setUsuarioLogin(FormatHelper::removeMask($this->getRequestPost('CPF')));
                        $objRaseaVO->setRecuperaSenha(TRUE);
                        $objRaseaVO->setNovaSenha($this->getRequestPost('frmNovaSenha'));
                        $objRaseaVO->setNovaSenhaConfirmacao($this->getRequestPost('frmConfNovaSenha'));
                        $objRaseaVO->bind($post);
                        $retorno = $objRaseaBO->alterarSenha($objRaseaVO)['retornoOperacao'];

                        if ($retorno) {
                            $objControllerHelper->setRetornoMensagem('Senha alterada com sucesso!');
                            echo $this->returnDefaultSuccessJson($objControllerHelper->getRetornoMensagem(), 'login');
                        } else {
                            echo $this->returnDefaultFailJson($objControllerHelper->getRetornoMensagem());
                        }
                    } else {
                        $objControllerHelper->setRetornoMensagem('Usuário Inexistente ou senha inválida!');
                        echo $this->returnDefaultFailJson($objControllerHelper->getRetornoMensagem());
                    }
                }
            } catch (\Exception $ex) {
                echo $this->returnDefaultFailJson($ex->getMessage());
            }
            $view->noRenderize();
        } else {
            $view->disableNavbar();
            $view->disableTopbar();
            $view->disableMain();
            $view->disableSessionControl();
            $view->renderize();
        }
    }

}

?>