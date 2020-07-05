<?php

namespace module\sistema\controller\error;

use core\controller\AbstractController;
use core\view\View;

class ErrorController extends AbstractController {

    public function controller404($nomeObjeto) {
        $view = new View('erro\erro404');
        $view->disableNavbar();
        $view->disableTopbar();
        $view->disableFooter();
        $view->setVariable('codigo', '404');
        $view->setVariable('titulo', 'Objeto não encontrado');
        $view->setVariable('pageTitle', 'ERRO 404');
        $view->setVariable('descricao', 'Não foi possível encontrar o controlador solicitado');
        $view->setVariable('nomeObjeto', $nomeObjeto);

        $view->renderize();
    }

    public function action404($nomeObjeto) {
        $view = new View('erro\erro404');
        $view->disableNavbar();
        $view->disableTopbar();
        $view->disableMain();
        $view->disableFooter();
        $view->setVariable('codigo', '404');
        $view->setVariable('titulo', 'Objeto não encontrado');
        $view->setVariable('pageTitle', 'ERRO 404');
        $view->setVariable('descricao', 'Não foi possível encontrar a action solicitada');
        $view->setVariable('nomeObjeto', $nomeObjeto);


        $view->renderize();
    }

    public function default500($descricaoErro) {
        $view = new View('erro\erro500');
        $view->disableNavbar();
        $view->disableTopbar();
        $view->disableMain();
        $view->disableFooter();
        $view->setVariable('codigo', '500');
        $view->setVariable('titulo', 'ERRO INTENO');
        $view->setVariable('pageTitle', 'ERRO INTENO');
        $view->setVariable('descricao', 'Ocorreu uma falha de sistema.');

        $view->setVariable('descricaoErro', $descricaoErro);

        $view->renderize();
    }
    
    public function acessoNegado($descricaoErro) {
        $view = new View('erro\acessoNegado');
        $view->disableNavbar();
        $view->disableTopbar();
        $view->disableMain();
        $view->disableFooter();
        $view->setVariable('codigo', '');
        $view->setVariable('titulo', 'ACESSO NEGADO');
        $view->setVariable('pageTitle', 'ACESSO NEGADO');
        $view->setVariable('descricao', 'Você não tem permissão para exibir a opção solicitada');

        $view->setVariable('descricaoErro', $descricaoErro);

        $view->renderize();
    }

}

?>