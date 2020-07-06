<?php

namespace core\controller;

use core\helper\SafeHelper;
use core\helper\SessionHelper;
use config\SystemConfig;

/**
 * Classe de abstração Controller
 * @package core
 * @subpackage controller
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
abstract class AbstractController {

    private $params = array();
    private $controllerName;
    private $actionName;

    public function __construct() {
        SessionHelper::generateSessionName();
        SessionHelper::startSession();
    }

    public function index() {
        
    }

    public function add() {
        
    }

    public function update() {
        
    }

    public function remove() {
        
    }

    ############################################################################
    ################################[ FORM ]####################################
    ############################################################################

    /**
     * Método que valida CSRF para uma determinada View
     * @final
     * @access public
     * @param View $view Objeto View
     * @return boolean true se válido e false se inválido
     */
    final public function isValid($view) {
        $sessionToken = SessionHelper::getSessionValue('csrf')[$view->getDataValues('viewTemplate')];
        return $sessionToken == $this->getRequestPost('csrf') ? true : false;
    }

    ############################################################################
    ##############################[ SESSION ]###################################
    ############################################################################

    /**
     * Retorna todo conteúdo da sessão ativa
     * @final
     * @access public
     * @param void
     * @return array Conteúdo da sessão
     */
    final public function getSession() {
        # FAZER TRATAMENTO SE SEGURANCA  **************
        SessionHelper::generateSessionName();
        SessionHelper::startSession();
        return $_SESSION;
    }

    ############################################################################
    ################################[ POST ]####################################
    ############################################################################

    /**
     * Verifica se requisição é do tipo POST
     * @final
     * @access public
     * @param void
     * @return boolean true se válido e false se inválido
     */
    final public function isPost() {
        return !empty($_POST);
    }

    /**
     * Método que retorna todo conteúdo da requisição POST
     * @final
     * @access public
     * @param void
     * @return array Conteúdo da requisição POST
     */
    final public function getAllRequestPost() {
        return SafeHelper::verifyAllValues($_POST);
    }

    /**
     * Método que retorna todo conteúdo da requisição $_FILE
     * @final
     * @access public
     * @param string $chave Nome do item desejado
     * @return mixed string | null
     */
    final public function getRequestFile($chave) {
        return isset($_FILES[$chave]) ? $_FILES[$chave] : NULL;
    }

    /**
     * Método que retorna todo conteúdo da requisição POST
     * @final
     * @access public
     * @param string $chave Nome do item desejado
     * @return mixed string | null
     */
    final public function getRequestPost($chave) {
        return isset($_POST[$chave]) ? SafeHelper::safe($_POST[$chave]) : NULL;
    }

    ############################################################################
    #############################[ CONTROLLER ]#################################
    ############################################################################

    /**
     * Método que retorna o caminho do controlador
     * @final
     * @access public
     * @param void
     * @return string Caminho para o controlador
     */
    final public function pathToController() {
        $ex = explode('\\', get_class($this));
        return $ex[0] . '\\' . $ex[1];
    }

    /**
     * Método de ação para controladores inexistentes
     * @final
     * @access public
     * @param string $nomeControlador Nome do controlador
     * @return void
     */
    final public function controlador404($nomeControlador) {
        $view = new view('erro\erro404');
        $view->desableNavbar();
        $view->desableMain();
        $view->setVariable('codigo', '404');
        $view->setVariable('titulo', 'Objeto não encontrado');
        $view->setVariable('descricao', 'Não foi possível encontrar o controlador solicitado');
        $view->setVariable('controlador', $nomeControlador);

        $view->renderize();
    }

    /**
     * Método que retorna os parâmetros da URL
     * @final
     * @access public
     * @param void
     * @return Array Parametros passado via URL
     */
    final public function getParams() {
        return SafeHelper::verifyAllValues($this->params);
    }

    /**
     * Método que seta os parâmetros da URL
     * @access public
     * @param Array $params Description
     * @return string
     */
    final public function setParams($params) {
        $this->params = $params;
    }

    /**
     * Método que verifica se o parâmetro Id foi setado
     * caso exista, retorna o valor, caso contrário retorna false
     * @final
     * @access public
     * @param void
     * @return int|null 
     */
    final public function existIdParam() {
        $parans = SafeHelper::verifyAllValues($this->params);
        return isset($parans[0]) && !empty($parans[0]) && is_numeric($parans[0]) ? $parans[0] : false;
    }

    /**
     * Método que retorna o nome do controlador
     * @final
     * @access public
     * @param void
     * @return String Nome do Controlador
     */
    final public function getControllerName() {
        return $this->controllerName;
    }

    /**
     * Método que retorna o nome da Action
     * @final
     * @access public
     * @param void
     * @return String Nome da Action
     */
    final public function getActionName() {
        return $this->actionName;
    }

    /**
     * Método que seta o nome do Controller
     * @final
     * @access public
     * @param String Nome do Controller
     * @return void
     */
    final public function setControllerName($controllerName) {
        $this->controllerName = $controllerName;
    }

    /**
     * Método que seta o nome da Action
     * @final
     * @access public
     * @param String Nome da Action
     * @return void
     */
    final public function setActionName($actionName) {
        $this->actionName = $actionName;
    }

    /**
     * Método responsável pelo retorno de valores da sessão
     * @final
     * @access public
     * @param string $key - Chave do valor de sessão a ser buscado
     * @return mixed
     */
    final public function getSessionData($key) {
        return isset($this->getSession()[$key]) ? $this->getSession()[$key] : null;
    }

    ############################################################################
    ##############################[ PERMISSÃO ]#################################
    ############################################################################

    /**
     * Verifica se o usuário possui a permissão informada e o redireciona para a
     * tela informada caso o mesmo não tenha permissão
     * @final
     * @access public
     * @param array  $permissions Lista de permissões a serem consultadas
     * @param string $redirectTo  Redireciona para a tela informada
     * @return void
     */
    final public function checkPermission(array $permissions, $redirectTo = 'inicio/inicio') {
        if (!$this->hasPermission($permissions)) {
            echo $this->redirect($redirectTo);
        }
    }

    /**
     * Verifica se o usuário possui a permissão informada
     * @final
     * @access public
     * @param array  $permissions Lista de permissões a serem consultadas
     * @return bool
     */
    final public function hasPermission(array $permissions) {
        return in_array($this->getSessionData('segPerfil'), $permissions);
    }

    ############################################################################
    ##########################[ REDIRECIONAMENTOS ]#############################
    ############################################################################

    /**
     * realiza redirecionamentos
     * @access public
     * @param Array $local Local para onse será redirecionado (Controle/acao)
     * @return string
     */
    final public function redirect($local, $param = null) {

        if (!empty($param)) {
            $local .= "/" . $param;
        }
        header('Location:' . SystemConfig::SYSTEM_ROOT . "/" . $local);
    }

    ############################################################################
    ###############################[ RETURN ]###################################
    ############################################################################

    /**
     * Método que gera uma url para redirecionamento em formato JSON
     * @final
     * @access public
     * @param String $message Mensagem
     * @param String $goToAfterResult Nome do Método de Ação para onde será redirecionado após mensagem do Modal
     * @param Boolean $noRenderizeView Flag que define se a view continuará em execução ou deverá ser parada
     * @return void
     */
    final public function redirectJson($goToAfterResult) {
        $url = SystemConfig::SYSTEM_ROOT . "/" . $goToAfterResult;
        echo json_encode(array('component' => 'redirectJson', 'url' => $url));
        die;
    }

    /**
     * Método que cria uma resposta padrão de SUCESSO OU ERRO em formato JSON para o Modal
     * @final
     * @access public
     * @param Boolean $bool Parametro para definir qual o tipo de mensagem será exibida
     * @param String $message Mensagem
     * @param String $goToAfterResult Nome do Método de Ação para onde será redirecionado após mensagem do Modal
     * @param Boolean $noRenderizeView Flag que define se a view continuará em execução ou deverá ser parada
     * @return void
     */
    final public function returnDefaultFailSuccessJson($bool, $message, $goToAfterResult = "", $noRenderizeView = TRUE) {
        if ($bool) {
            $this->returnDefaultSuccessJson($message, $goToAfterResult, $noRenderizeView);
        } else {
            $this->returnDefaultFailJson($message, $goToAfterResult, $noRenderizeView);
        }
    }

    /**
     * Método que cria uma resposta padrão de SUCESSO em formato JSON para o Modal
     * @final
     * @access public
     * @param String $message Mensagem
     * @param String $goToAfterResult Nome do Método de Ação para onde será redirecionado após mensagem do Modal
     * @param Boolean $noRenderizeView Flag que define se a view continuará em execução ou deverá ser parada
     * @return void
     */
    final public function returnDefaultSuccessJson($message, $goToAfterResult = "", $noRenderizeView = TRUE) {
        // var_dump($goToAfterResult);die;
        is_array($message) ? $message = $message['retornoMensagem'] : null;
        empty($goToAfterResult) ? $url = "" : $url = SystemConfig::SYSTEM_ROOT . "/" . $goToAfterResult;
        echo json_encode(array('component' => 'returnDefaultSuccessJson', 'erro' => 0, 'modal' => array('type' => 'success', 'message' => $message, 'icon' => '<i class="glyphicon glyphicon-check"></i>', 'title' => 'Sucesso!', 'urlRedirect' => $url, 'buttonColor' => '#37a53b')));
        if ($noRenderizeView) {
            die;
        }
    }

    /**
     * Método que cria uma resposta padrão de FALHA em formato JSON para o Modal
     * @final
     * @access public
     * @param String $message Mensagem
     * @param String $goToAfterResult Método para onde será redirecionado após mensagem do Modal
     * @param Boolean $noRenderizeView Flag que define se a view continuará em execução ou deverá ser parada
     * @return void
     */
    final public function returnDefaultFailJson($message, $goToAfterResult = "", $noRenderizeView = TRUE) {
        is_array($message) ? $message = $message['retornoMensagem'] : null;
        empty($goToAfterResult) ? $url = "" : $url = SystemConfig::SYSTEM_ROOT . "/" . $goToAfterResult;
        echo json_encode(array('component' => 'returnDefaultFailJson', 'erro' => 1, 'modal' => array('type' => 'error', 'message' => $message, 'icon' => '<i class="glyphicon glyphicon-check"></i>', 'title' => 'Falha!', 'urlRedirect' => $url, 'buttonColor' => '#F44336')));
        if ($noRenderizeView) {
            die;
        }
    }

    /**
     * Método que cria uma resposta de SUCESSO em formato JSON para o Modal
     * @final
     * @access public
     * @param String $message Mensagem
     * @param String $goToAfterResult Nome do Método de Ação para onde será redirecionado após mensagem do Modal
     * @param Boolean $noRenderizeView Flag que define se a view continuará em execução ou deverá ser parada
     * @return void
     */
    final public function returnSuccessJson($title, $message, $buttonName, $goToAfterResult = "", $noRenderizeView = TRUE) {
        is_array($message) ? $message = $message['retornoMensagem'] : null;
        empty($goToAfterResult) ? $url = "" : $url = SystemConfig::SYSTEM_ROOT . "/" . $goToAfterResult;
        echo json_encode(array('component' => 'returnSuccessJson', 'erro' => 0, 'modal' => array('type' => 'success', 'message' => $message, 'icon' => '<i class="glyphicon glyphicon-check"></i>', 'urlRedirect' => $url, 'buttonColor' => '#37a53b', 'title' => $title, 'buttonName' => $buttonName)));
        if ($noRenderizeView) {
            die;
        }
    }

    /**
     * Método que cria uma resposta de FALHA em formato JSON para o Modal
     * @final
     * @access public
     * @param String $message Mensagem
     * @param String $goToAfterResult Método para onde será redirecionado após mensagem do Modal
     * @param Boolean $noRenderizeView Flag que define se a view continuará em execução ou deverá ser parada
     * @return void
     */
    final public function returnFailJson($title, $message, $buttonName, $goToAfterResult = "", $noRenderizeView = TRUE) {
        is_array($message) ? $message = $message['retornoMensagem'] : null;
        empty($goToAfterResult) ? $url = "" : $url = SystemConfig::SYSTEM_ROOT . "/" . $goToAfterResult;
        echo json_encode(array('component' => 'returnFailJson', 'erro' => 1, 'modal' => array('type' => 'error', 'message' => $message, 'icon' => '<i class="glyphicon glyphicon-check"></i>', 'urlRedirect' => $url, 'buttonColor' => '#F44336', 'title' => $title, 'buttonName' => $buttonName)));
        if ($noRenderizeView) {
            die;
        }
    }

    /**
     * Método que cria uma resposta de ALERTA em formato JSON para o Modal
     * @final
     * @access public
     * @param String $message Mensagem
     * @param String $goToAfterResult Método para onde será redirecionado após mensagem do Modal
     * @param Boolean $noRenderizeView Flag que define se a view continuará em execução ou deverá ser parada
     * @return void
     */
    final public function returnDefaultWarningJson($message, $goToAfterResult = "", $noRenderizeView = TRUE) {
        is_array($message) ? $message = $message['retornoMensagem'] : null;
        empty($goToAfterResult) ? $url = "" : $url = SystemConfig::SYSTEM_ROOT . "/" . $goToAfterResult;
        echo json_encode(array('component' => 'returnDefaultWarningJson', 'erro' => 2, 'modal' => array('type' => 'warning', 'message' => $message, 'icon' => '<i class="glyphicon glyphicon-check"></i>', 'title' => 'Aviso!', 'urlRedirect' => $url)));
        if ($noRenderizeView) {
            die;
        }
    }

    /**
     * Método que retorna todo conteúdo da requisição POST Sem verificação de segurança
     * @final
     * @access public
     * @param string $chave Nome do item desejado
     * @return mixed string | null
     */
    final public function getRequestPostNoSafe($chave) {
        return isset($_POST[$chave]) ? $_POST[$chave] : NULL;
    }

}
