<?php

namespace module\framework\controller;

use core\controller\AbstractController;
use core\view\View;


class InicioController extends AbstractController {
    
    public function inicio() {
        
        $view = new View('inicio\inicio', parent::pathToController());
        
        $view->breadcrumb('fa-calendar', array());
        $view->pageTitle('Início');
        $view->renderize();
        
    }

}

?>