<?php

namespace module\SGTVES\controller;

use core\controller\AbstractController;
use core\view\View;


class NovoRecebimentoController extends AbstractController {
    
    public function inicio() {

        $view = new View('novoRecebimento/inicio', parent::pathToController());
        $view->setStyles(array('all/css/padrao.css'));
        $view->setScripts(array('SGTVES/novoRecebimento/js/inicio.js'));
        $view->breadcrumb('fa-calendar', array('Administrativo', 'Funcionário', 'Consultar Funcionário'));
        $view->pageTitle('Consultar Funcionário');

        
        // $objFuncionarioBO = new FuncionarioBO();
        // $objFuncionarioVO = new FuncionarioVO();

//         if ($this->isPost()) {
//             try {
//                 $post = $this->getAllRequestPost();
//                 $objFuncionarioVO->bind($post);
//                 $retornoFuncionario = $objFuncionarioBO->listar($objFuncionarioVO);
// //                var_dump($retornoFuncionario); exit;
//                 $view->setVariable('arrayFuncionario', $retornoFuncionario['retornoOperacao']);
//                 $view->setVariable('post', $post);
//             } catch (\Exception $ex) {
                
//             }
//         } else {
//             $retornoFuncionario = $objFuncionarioBO->listar($objFuncionarioVO);
//             $view->setVariable('arrayFuncionario', $retornoFuncionario['retornoOperacao']);
//             $view->setVariable('post', array());
//         }


        $view->renderize();
    }


    public function adicionar() {

        $session = $this->getSession();

        $view = new View('novoRecebimento/adicionar', parent::pathToController());
        $view->breadcrumb('fa-calendar', array('Administrativo', 'Funcionário', 'Adicionar Funcionário'));
        $view->setScripts(array('SGTVES/novoRecebimento/js/inicio.js'));
        $view->pageTitle('Novo Recebimento');


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

        // $retornoFuncionario = $objFuncionarioBO->listar($objFuncionarioVO);
        // $view->setVariable('arrayFuncionario', $retornoFuncionario['retornoOperacao']);

        // $retornoSetor = $objSetorBO->listarCombo($objSetorVO);
        // $view->setVariable('arraySetor', $retornoSetor);

        $view->renderize();
    }



    public function upload() {

        $session = $this->getSession();

        $view = new View('novoRecebimento/adicionar', parent::pathToController());
        $view->breadcrumb('fa-calendar', array('Administrativo', 'Funcionário', 'Adicionar Funcionário'));
        $view->pageTitle('Cadastro de Funcionário');
        $view->setScripts(array('framework/funcionario/js/funcionario.js'));


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

        // $retornoFuncionario = $objFuncionarioBO->listar($objFuncionarioVO);
        // $view->setVariable('arrayFuncionario', $retornoFuncionario['retornoOperacao']);

        // $retornoSetor = $objSetorBO->listarCombo($objSetorVO);
        // $view->setVariable('arraySetor', $retornoSetor);

        $view->renderize();
    }

    public function importacao() {

        $session = $this->getSession();

        $view = new View('novoRecebimento/adicionar', parent::pathToController());
        $view->breadcrumb('fa-calendar', array('Administrativo', 'Funcionário', 'Adicionar Funcionário'));
        $view->pageTitle('Cadastro de Funcionário');
        $view->setScripts(array('framework/funcionario/js/funcionario.js'));


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

        // $retornoFuncionario = $objFuncionarioBO->listar($objFuncionarioVO);
        // $view->setVariable('arrayFuncionario', $retornoFuncionario['retornoOperacao']);

        // $retornoSetor = $objSetorBO->listarCombo($objSetorVO);
        // $view->setVariable('arraySetor', $retornoSetor);

        $view->renderize();
    }

}




?>