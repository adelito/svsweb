<?php

namespace module\SGTVES\controller;

use config\SystemConfig;
use core\bo\framework\FrameworkBO;
use core\controller\AbstractController;
use core\exception\FileException;
use core\helper\SessionHelper;
use module\SGTVES\helper\UploadHelper;
use core\view\View;
use module\SGTVES\bo\UploadBO;
use module\SGTVES\vo\ClienteVO;
use module\SGTVES\bo\ClienteBO;
use module\SGTVES\bo\NovoRecebimentoBO;
use module\SGTVES\vo\NovoRecebimentoVO;
use module\SGTVES\vo\UploadVO;


class NovoRecebimentoController extends AbstractController
{

    public function inicio()
    {

        $view = new View('novoRecebimento/inicio', parent::pathToController());
        $view->setStyles(array('all/css/padrao.css'));
        $view->setScripts(array('SGTVES/novoRecebimento/js/inicio.js'));
        $view->breadcrumb('fa-calendar', array('Administrativo', 'Funcionário', 'Consultar Funcionário'));
        $view->pageTitle('Consultar Funcionário');


        $objNovoRecebimentoBO = new NovoRecebimentoBO();
        $objNovoRecebimentoVO = new NovoRecebimentoVO();

        if ($this->isPost()) {
            try {
                $post = $this->getAllRequestPost();
                $objNovoRecebimentoVO->bind($post);
                $retornoNovoRecebimento = $objNovoRecebimentoBO->listar($objNovoRecebimentoVO);
                //                var_dump($retornoNovoRecebimento); exit;
                $view->setVariable('arrayNovoRecebimento', $retornoNovoRecebimento['retornoOperacao']);
                $view->setVariable('post', $post);
            } catch (\Exception $ex) {

            }
        } else {
            $retornoNovoRecebimento = $objNovoRecebimentoBO->listar($objNovoRecebimentoVO);
            $view->setVariable('arrayNovoRecebimento', $retornoNovoRecebimento['retornoOperacao']);
            $view->setVariable('post', array());
        }


        $view->renderize();
    }


    public function adicionar()
    {

        $session = $this->getSession();

        $view = new View('novoRecebimento/adicionar', parent::pathToController());
        $view->breadcrumb('fa-calendar', array('Administrativo', 'Funcionário', 'Adicionar Funcionário'));
        $view->setScripts(array('SGTVES/novorecebimento/js/novoRecebimento.js'));
        $view->pageTitle('Novo Recebimento');


        $objClienteVO = new ClienteVO();
        $objClienteBO = new ClienteBO();
        $objNovoRecebimentoBO = new NovoRecebimentoBO();
        $objNovoRecebimentoVO = new NovoRecebimentoVO();

        if ($this->isPost()) {
            try {
                $session = $this->getSession();

                $post = $this->getAllRequestPost();
                # informações principais #
//                var_dump($post);die;
                $objNovoRecebimentoVO->bind($post);

//                var_dump($objNovoRecebimentoVO);die;

                # inserir #
                $retornoNovoRecebimento = $objNovoRecebimentoBO->inserir($objNovoRecebimentoVO);
                echo $this->returnDefaultSuccessJson($retornoNovoRecebimento, 'novoRecebimento/inicio');
            } catch (\Exception $ex) {
                echo $this->returnDefaultFailJson($ex->getMessage());
            }
            $view->noRenderize();
        }

        $retornoCliente = $objClienteBO->listar($objClienteVO);
        $view->setVariable('arrayCliente', $retornoCliente['retornoOperacao']);


        $view->renderize();
    }


    public function upload()
    {

        $session = $this->getSession();

        $view = new View('novoRecebimento/upload', parent::pathToController());
        $view->breadcrumb('fa-calendar', array('Administrativo', 'Funcionário', 'Adicionar Funcionário'));
        $view->setScripts(array('SGTVES/novorecebimento/js/upload.js'));
        $view->pageTitle('Upload');


        $objUploadBO = new UploadBO();
        $objUploadVO = new UploadVO();

        $upload = new UploadHelper();
        $upload->UploadXml();
        if (false) {
            try {
                $post = $this->getAllRequestPost();

                # informações principais #
                $objUploadVO = new UploadVO();
                $objUploadVO->bind($post);
                // var_dump($objUploadVO->getNome());die;
                # informações de cadastro #
                $objUploadVO->setDataFile(date('d/m/Y H:i:s'));

                # inserir #
                $objUploadBO = new UploadBO();
                $retornoUpload = $objUploadBO->Upload($objUploadVO);

                echo $this->returnDefaultSuccessJson($retornoUpload, 'upload/inicio');
            } catch (\Exception $ex) {
                echo $this->returnDefaultFailJson($ex->getMessage());
            }
            $view->noRenderize();
        }

        $view->renderize();
    }

}


?>