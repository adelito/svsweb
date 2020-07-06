<?php

namespace module\framework\controller;

use core\controller\AbstractController;
use core\view\View;
use module\framework\bo\SetorBO;
use module\framework\vo\SetorVO;

class SetorController extends AbstractController {

    public function inicio() {
        $view = new View('setor/inicio', parent::pathToController());
        $view->setStyles(array('all/css/padrao.css'));
        $view->setScripts(array('framework/setor/js/inicio.js'));

        $objSetorBO = new SetorBO();
        $objSetorVO = new SetorVO();

        if ($this->isPost()) {
            try {
                $post = $this->getAllRequestPost();
                $objSetorVO->bind($post);
                $retornoSetor = $objSetorBO->listar($objSetorVO);
                $view->setVariable('arraySetor', $retornoSetor['retornoOperacao']);
                $view->setVariable('post', $post);
            } catch (\Exception $ex) {
                
            }
        } else {
            $retornoSetor = $objSetorBO->listar($objSetorVO);
//            echo '<pre>';var_dump($retornoSetor); die;
            $view->setVariable('arraySetor', $retornoSetor['retornoOperacao']);
            $view->setVariable('post', array());
        }

        $view->breadcrumb('fa-calendar', array('Administrativo', 'Setor', 'Consultar Setor'));
        $view->pageTitle('Consultar Setor');
        $view->renderize();
    }

    public function adicionar() {
        $session = $this->getSession();

        $view = new View('setor/adicionar', parent::pathToController());
        $view->breadcrumb('fa-calendar', array('Administrativo', 'Setor', 'Adicionar Setor'));
        $view->pageTitle('Adicionar Setor');
        $view->setScripts(array('framework/setor/js/setor.js'));


        if ($this->isPost()) {
            try {
                $session = $this->getSession();

                $post = $this->getAllRequestPost();

                # informações principais #
                $objSetorVO = new SetorVO();
                $objSetorVO->bind($post);
                // var_dump($objSetorVO->getNome());die;
                # informações de cadastro #
                $objSetorVO->setUsuarioInclusao($session['usuNome']);
                $objSetorVO->setDataInclusao(date('d/m/Y H:i:s'));

                # inserir #
                $objSetorBO = new SetorBO();
                $retornoSetor = $objSetorBO->inserir($objSetorVO);

                echo $this->returnDefaultSuccessJson($retornoSetor, 'setor/inicio');
            } catch (\Exception $ex) {
                echo $this->returnDefaultFailJson($ex->getMessage());
            }
            $view->noRenderize();
        }

        $objSetorBO = new SetorBO();
        $objSetorVO = new SetorVO();
        $retornoSetor = $objSetorBO->listar($objSetorVO);
        $view->setVariable('arraySetor', $retornoSetor['retornoOperacao']);
        $view->renderize();
    }

    public function alterar() {
        $view = new View('setor/alterar', parent::pathToController());
        $view->breadcrumb('fa-calendar', array('Adminisrativo', 'Setor', 'Alterar Setor'));
        $view->pageTitle('Alterar Setor');
        $view->setScripts(array('framework/setor/js/setor.js'));

        $objSetorBO = new SetorBO();
        $objSetorVO = new SetorVO();

        $post = $this->getAllRequestPost();

        if ($this->isPost()) {
            try {
                $session = $this->getSession();

                # informações principais #
                $objSetorVO->bind($post);
                # informações de cadastro #
                $objSetorVO->setUsuarioAlteracao($session['usuId']);
                $objSetorVO->setDataAlteracao(date('d/m/Y H:i:s'));

                $retorno = $objSetorBO->alterar($objSetorVO);

                echo $this->returnDefaultSuccessJson($retorno, 'setor');
            } catch (\Exception $ex) {
                echo $this->returnDefaultFailJson($ex->getMessage());
            }
            $view->noRenderize();
        }

        $objSetorVO->setId($this->getParams()[0]);

        $retorno = $objSetorBO->selecionar($objSetorVO);

        $retornoSetor = $objSetorBO->listar($objSetorVO);
        $view->setVariable('arraySetor', $retornoSetor);
        $view->setVariable('objSetorVO', $retorno['retornoOperacao']);
        $view->renderize();
    }

    public function excluir() {
        try {
            $objSetorBO = new SetorBO();
            $objSetorVO = new SetorVO();

            $parametors = $this->getParams();
            $session = $this->getSession();

            $objSetorVO->setId($parametors[0]);
            $objSetorVO->setUsuarioAlteracao($session['usuId']);
            $objSetorVO->setDataAlteracao(date('d/m/Y H:i:s'));

            $retorno = $objSetorBO->excluir($objSetorVO);

            echo $this->returnDefaultSuccessJson($retorno, 'setor/inicio');
        } catch (\Exception $ex) {
            echo $this->returnDefaultFailJson($ex->getMessage(), 'setor/inicio');
        }
    }

    public function existe() {
        try {
            $objSetorBO = new SetorBO();
            $objSetorVO = new SetorVO();

            $post = $this->getAllRequestPost();
            $objSetorVO->bind($post);

            $retorno = $objSetorBO->existe($objSetorVO);

            echo json_encode($retorno);
        } catch (\Exception $ex) {
            throw new \Exception("Não foi possível realizar a operação");
        }
    }

}
