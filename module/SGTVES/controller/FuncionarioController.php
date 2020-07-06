<?php

namespace module\framework\controller;

use core\controller\AbstractController;
use core\view\View;
use module\framework\bo\FuncionarioBO;
use module\framework\vo\FuncionarioVO;
use module\framework\bo\SetorBO;
use module\framework\vo\SetorVO;
use core\helper\SafeHelper;

class FuncionarioController extends AbstractController {

    public function inicio() {

        $view = new View('funcionario/inicio', parent::pathToController());
        $view->setStyles(array('all/css/padrao.css'));
        $view->setScripts(array('framework/funcionario/js/inicio.js'));
        $view->breadcrumb('fa-calendar', array('Administrativo', 'Funcionário', 'Consultar Funcionário'));
        $view->pageTitle('Consultar Funcionário');

        
        $objFuncionarioBO = new FuncionarioBO();
        $objFuncionarioVO = new FuncionarioVO();

        if ($this->isPost()) {
            try {
                $post = $this->getAllRequestPost();
                $objFuncionarioVO->bind($post);
                $retornoFuncionario = $objFuncionarioBO->listar($objFuncionarioVO);
//                var_dump($retornoFuncionario); exit;
                $view->setVariable('arrayFuncionario', $retornoFuncionario['retornoOperacao']);
                $view->setVariable('post', $post);
            } catch (\Exception $ex) {
                
            }
        } else {
            $retornoFuncionario = $objFuncionarioBO->listar($objFuncionarioVO);
            $view->setVariable('arrayFuncionario', $retornoFuncionario['retornoOperacao']);
            $view->setVariable('post', array());
        }


        $view->renderize();
    }

    public function adicionar() {

        $session = $this->getSession();

        $view = new View('funcionario/adicionar', parent::pathToController());
        $view->breadcrumb('fa-calendar', array('Administrativo', 'Funcionário', 'Adicionar Funcionário'));
        $view->pageTitle('Cadastro de Funcionário');
        $view->setScripts(array('framework/funcionario/js/funcionario.js'));

        $objSetorBO = new SetorBO();
        $objSetorVO = new SetorVO();

        $objFuncionarioBO = new FuncionarioBO();
        $objFuncionarioVO = new FuncionarioVO();

        if ($this->isPost()) {
            try {
                $session = $this->getSession();

                $post = $this->getAllRequestPost();

                # informações principais #
                $objFuncionarioVO->bind($post);

                # informações de cadastro #
                $objFuncionarioVO->setUsuarioInclusao($session['usuNome']);
                $objFuncionarioVO->setSenha('123456');
                $objFuncionarioVO->setMatricula('MT'. SafeHelper::geraCodigo());
                $objFuncionarioVO->setDataInclusao(date('d/m/Y H:i:s'));


                # inserir #
                $retornoFuncionario = $objFuncionarioBO->inserir($objFuncionarioVO);

                echo $this->returnDefaultSuccessJson($retornoFuncionario, 'funcionario/inicio');
            } catch (\Exception $ex) {
                echo $this->returnDefaultFailJson($ex->getMessage());
            }
            $view->noRenderize();
        }

        $retornoFuncionario = $objFuncionarioBO->listar($objFuncionarioVO);
        $view->setVariable('arrayFuncionario', $retornoFuncionario['retornoOperacao']);

        $retornoSetor = $objSetorBO->listarCombo($objSetorVO);
        $view->setVariable('arraySetor', $retornoSetor);

        $view->renderize();
    }

    public function alterar() {
        $view = new View('funcionario/alterar', parent::pathToController());
        $view->breadcrumb('fa-calendar', array('Administrativo', 'Funcionário', 'Alterar Funcionário'));
        $view->pageTitle('Alterar Funcionário');
        $view->setScripts(array('framework/funcionario/js/funcionario.js'));

        $objSetorBO = new SetorBO();
        $objSetorVO = new SetorVO();

        $objFuncionarioBO = new FuncionarioBO();
        $objFuncionarioVO = new FuncionarioVO();

        $session = $this->getSession();
        $objFuncionarioVO->setId($this->getParams()[0]);
        if ($this->isPost()) {
            try {

                $post = $this->getAllRequestPost();
                #informações principais
                $objFuncionarioVO->bind($post);
            //    var_dump($objFuncionarioVO);die;
                #informações de cadastro
                
                $objFuncionarioVO->setUsuarioAlteracao($session['usuNome']);
                $objFuncionarioVO->setDataAlteracao(date('d/m/Y H:i:s'));

                $retorno = $objFuncionarioBO->alterar($objFuncionarioVO);

                echo $this->returnDefaultSuccessJson($retorno, 'funcionario/inicio');
            } catch (\Exception $ex) {
                echo $this->returnDefaultFailJson($ex->getMessage());
            }
            $view->noRenderize();
        }

        

        $retorno = $objFuncionarioBO->selecionar($objFuncionarioVO);
        $view->setVariable('objFuncionarioVO', $retorno['retornoOperacao']);

        $retornoFuncionario = $objFuncionarioBO->listar($objFuncionarioVO);
        $view->setVariable('arrayFuncionario', $retornoFuncionario);

        $retornoSetor = $objSetorBO->listarCombo($objSetorVO);
        $view->setVariable('arraySetor', $retornoSetor);

        $view->renderize();
    }

    public function excluir() {
        try {
            $objFuncionarioBO = new FuncionarioBO();
            $objFuncionarioVO = new FuncionarioVO();

            $parametors = $this->getParams();
            $session = $this->getSession();

            $objFuncionarioVO->setId($parametors[0]);
            $objFuncionarioVO->setUsuarioAlteracao($session['usuNome']);
            $objFuncionarioVO->setDataAlteracao(date('d/m/Y H:i:s'));

            $retorno = $objFuncionarioBO->excluir($objFuncionarioVO);

            echo $this->returnDefaultSuccessJson($retorno, 'funcionario/inicio');
        } catch (\Exception $ex) {
            echo $this->returnDefaultFailJson($ex->getMessage(), 'funcionario/inicio');
        }
    }

    public function existeMatricula() {
        try {
            $objFuncionarioBO = new FuncionarioBO();
            $objFuncionarioVO = new FuncionarioVO();

            $post = $this->getAllRequestPost();
            $objFuncionarioVO->bind($post);

            $retorno = $objFuncionarioBO->existeMatricula($objFuncionarioVO);

            echo json_encode(array('retorno' => $retorno));
        } catch (\Exception $ex) {
            throw new \Exception("Não foi possível realizar a operação");
        }
    }

}