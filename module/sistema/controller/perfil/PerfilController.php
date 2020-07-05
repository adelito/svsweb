<?php

namespace module\sistema\controller\perfil;

use core\controller\AbstractController;
use core\view\View;
use core\bo\rasea\RaseaBO;
use core\vo\rasea\RaseaVO;
use config\SystemConfig;
use core\helper\SessionHelper;
use module\sgo\helper\LoginHelper;
use core\helper\SafeHelper;
use core\helper\UploadHelper;
use module\sgo\consts\PerfilConsts;
use module\sgo\bo\UsuarioBO;
use module\sgo\vo\UsuarioVO;
use core\exception\FileException;
use core\vo\framework\FrameworkVO;
use core\bo\framework\FrameworkBO;
use module\sgo\helper\UsuarioHelper;
use core\helper\FormatHelper;

class PerfilController extends AbstractController
{

    public function meusDados()
    {
        $view = new View('perfil\meusdados', parent::pathToController());
        $view->breadcrumb('fa-calendar', array('Perfil'));
        $view->pageTitle('Perfil');


        $view->setStyles(array(
            'all/lib/fileupload/css/fileinput.css',
            'all/lib/croppie/croppie.css',
            'sistema/perfil/css/meusdados.css'
        ));

        $view->setScripts(array(
            'all/lib/fileupload/js/fileinput.js',
            'all/lib/fileupload/js/locales/pt-BR.js',
            'all/lib/croppie/croppie.js',
            'sistema/perfil/js/meusdados.js'
        ));


        $view->renderize();
    }

    public function alterarSenha()
    {
        $view = new View('perfil\alterarSenha', parent::pathToController());
        $view->breadcrumb('fa-calendar', array('Alterar Senha'));
        $view->setScripts(array('sistema/perfil/alterarSenha.js'));
        $view->pageTitle('Alterar Senha');

        if ($this->isPost()) {

            try {
                SessionHelper::generateSessionName();
                SessionHelper::startSession();

                $objRaseaBO = new RaseaBO();
                $objRaseaVO = new RaseaVO();

                $objRaseaVO->setAplicacaoNome(SystemConfig::AUTH_RASEA_APPLICATION_NAME);
                $objRaseaVO->setUsuarioSenha($this->getRequestPost('frmSenhaAtual'));
                $objRaseaVO->setUsuarioLogin(SessionHelper::getSessionValue('usuLogin'));

                $objRaseaVO->setNovaSenha($this->getRequestPost('frmNovaSenha'));
                $objRaseaVO->setNovaSenhaConfirmacao($this->getRequestPost('frmConfNovaSenha'));

                $retorno = $objRaseaBO->alterarSenha($objRaseaVO);

                if ($retorno['retornoOperacao']) {
                    echo $this->returnDefaultSuccessJson($retorno['retornoMensagem'], 'inicio');
                } else {
                    echo $this->returnDefaultFailJson($retorno['retornoMensagem']);
                }

                echo $this->returnDefaultSuccessJson('Senha alterada com sucesso!', 'inicio');
            } catch (\Exception $ex) {
                echo $this->returnDefaultFailJson($ex->getMessage());
            }
            $view->noRenderize();
        }

        $view->renderize();
    }



    public function selecaoPerfil()
    {
        $view = new View('perfil\selecaoPerfil', parent::pathToController());
        $view->setScripts(array('sistema/perfil/js/perfilAcesso.js'));
        $view->pageTitle('Seleção de perfil de Acesso');
        $session = $this->getSession();

        if ($this->isPost()) {
            try {

                $perfilAcesso = $this->getRequestPost('PERFILACESSO');

                $arrayPermissoes = SessionHelper::getSessionValue('segArrayPermissoes');

                //verificar se tem permissão para trocar para o perfil
                if (!array_key_exists($perfilAcesso, SessionHelper::getSessionValue('segPerfis'))) {
                    throw new \Exception('Não foi possível alterar o perfil');
                }

                if (!empty($perfilAcesso)) {

                    SessionHelper::setSessionValue('segPerfil', $perfilAcesso);

                    $objUsuarioBO = new UsuarioBO();
                    $objUsuarioVO = new UsuarioVO();

                    $objUsuarioVO->setCpf($session['usuLogin']);
                    $objUsuarioVO = $objUsuarioBO->getEscolasAssociadas($objUsuarioVO)['retornoOperacao'];
                    $isPerfilEscolar = UsuarioHelper::isPerfilEscolarByNome($perfilAcesso);
                    if (!$isPerfilEscolar) {
                        $objNteBO = new NteBO();
                        $ntes = LoginHelper::getArrayNtesProfessor($objNteBO->listar(new NteVO())['retornoOperacao']);
                    } else {
                        $ntes = LoginHelper::getArrayNtesProfessor($objUsuarioVO->getNteArrayInterator());
                    }
                    $escolas = LoginHelper::getArrayEscolasProfessor($objUsuarioVO);

                    SessionHelper::setSessionValue('segPermissoes', $arrayPermissoes[$perfilAcesso]);
                    SessionHelper::setSessionValue('segNtes', $ntes);
                    SessionHelper::setSessionValue('segEscolas', $escolas);
                    SessionHelper::setSessionValue('idPerfil', $perfilAcesso);

                    $perfilEscolhido = PerfilConsts::obterValues(PerfilConsts::obterIntValues($perfilAcesso));
                    SessionHelper::setSessionValue('segPerfilDescricao', $perfilEscolhido);

                    echo $this->returnDefaultSuccessJson('Você escolheu o perfil ' . $perfilEscolhido . '.', 'inicio');
                } else {

                    echo $this->returnDefaultFailJson('Selecione um perfil');
                }
            } catch (\Exception $ex) {
                echo $this->returnDefaultFailJson($ex->getMessage());
            }
            $view->noRenderize();
        }


        $view->disableNavbar();
        $view->setVariable('usuNome', SessionHelper::getSessionValue('usuNome'));
        $view->setVariable('perfis', SessionHelper::getSessionValue('segPerfis'));
        $view->renderize();
    }

    public function uploadImage()
    {

        $file = $this->getRequestFile('fotoperfil');
        $session = $this->getSession();

        $upload = new UploadHelper(
            $file,
            SystemConfig::UPLOAD_DIR_SERVER() . 'perfil' . DIRECTORY_SEPARATOR,
            array("jpeg", "jpg", "png"),
            5
        );

        try {
            if (!is_null($session['usuFotoPerfil'])) {
                $upload->setNome($session['usuFotoPerfil']);
            } else {
                $objFrameworkVO = new FrameworkVO();
                $objFrameworkBO = new FrameworkBO();

                $objFrameworkVO->setUsuario($session['usuId']);
                $objFrameworkVO->setFotoPerfil($upload->getNome());
                $objFrameworkVO->setEsquemaTabela("sgo");
                $objFrameworkBO->atualizarFotoPerfil($objFrameworkVO);
            }

            $upload->upload();
            SessionHelper::setSessionValue('usuFotoPerfil', $upload->getNome());
            echo json_encode(array());
        } catch (Exception $e) { // failed to catch it
            echo $e->getMessage();
        } catch (FileException $e) {
            echo $e->getMessage();
        }
    }
}
