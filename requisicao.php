<?php

//session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

header('Content-Type: text/html; charset=utf-8');
//define('ROOT', dirname(__FILE__));
require 'core' . DIRECTORY_SEPARATOR . 'Autoload.php';
use config\ControllerConfig;


$url = filter_input(INPUT_SERVER, 'REQUEST_URI');

if (!empty($url)) {

    $dados = explode("/", ltrim($url, "/"));
    $params = array();

# controlador
    $nomeControlador = $dados[0];

# action
    $action = empty($dados[1]) ? 'inicio' : $dados[1];

# parametros

    if (isset($dados[2])) {
        $params[] = $dados[2];
    }
    if (isset($dados[3])) {
        $params[] = $dados[3];
    }
    if (isset($dados[4])) {
        $params[] = $dados[4];
    }
    if (isset($dados[5])) {
        $params[] = $dados[5];
    }
    if (isset($dados[6])) {
        $params[] = $dados[6];
    }
    if (isset($dados[7])) {
        $params[] = $dados[7];
    }
    if (isset($dados[8])) {
        $params[] = $dados[8];
    }
    if (isset($dados[9])) {
        $params[] = $dados[9];
    }

    
# chamada para o a Action

    $controller = ControllerConfig::getControllerInstance($nomeControlador);
   
    ControllerConfig::validateAction($controller, $action);

    $controller->setParams($params);
    
    $controller->$action();
    
} else {
    ControllerConfig::getControllerInstance('error')->default500("Parametros incorretos"); 
}


