<?php

namespace core\view;

use config\SystemConfig;
use core\helper\SessionHelper;
use core\helper\SafeHelper;
use core\helper\FormatHelper;

define('APP_PATH', dirname(__FILE__));
define("_CUR_OS", substr(php_uname(), 0, 7) == "Windows" ? "Win" : "_Nix" );

class View {

    private $data = array();
    protected $template = null;
    protected $templateReport = null;
    protected $header = null;
    protected $footer = null;
    protected $navbar = null;
    protected $topbar = null;
    protected $sessionControl = null;
    protected $main = null;
    protected $requestPost = null;
    protected $modalMode = false;

    public function __construct($template, $urlModule = "module\sistema") {

        $this->data['viewTemplate'] = $template;
        $this->data['systemConfig'] = new SystemConfig();
        $this->data['sessionHelper'] = new SessionHelper();
        $this->data['formatHelper'] = new FormatHelper();
        $this->template = $this->getPath($template, $urlModule);
        $this->templateReport = $this->getPath('template\relatorio-template-1', 'core');
        $this->header = $this->getPath('layout\1-header', 'core');
        $this->main = $this->getPath('layout\2-main', 'core');
        $this->topbar = $this->getPath('layout\3-topbar', 'core');
        $this->navbar = $this->getPath('layout\4-navbar', 'core');
        $this->footer = $this->getPath('layout\5-footer', 'core');
        $this->sessionControl = $this->getPath('layout\0-session-control', 'core');

        $this->requestPost = SafeHelper::verifyAllValues($_POST); # VERIFICAR SEGURANCA


        if (!file_exists($this->template)) {
            throw new \Exception('Visão <b>' . $this->template . '</b> não encontrada!');
        }
    }

    public function getDataValues($chave) {
        return isset($this->data[$chave]) ? $this->data[$chave] : null;
    }

    public function requestPost($valor) {
        return isset($this->requestPost[$valor]) ? $this->requestPost[$valor] : null;
    }

    public function getUri() {
        # TRATAR SEGURANCA
        return $_SERVER['REQUEST_URI'];
    }

    public function setVariable($variavel, $valor) {
        $this->data[$variavel] = $valor;
    }

    public function setModalMode($valor) {
        $this->modalMode = $valor;
    }
    public function getModalMode() {
        return $this->modalMode;
    }

    public function renderize($visionOnly = false, $returnOnly = false) {

        $this->preRenderize();

        extract($this->data);
        ob_start();

        if (!$visionOnly) {
            if ($this->sessionControl) {
                include($this->sessionControl);
            }

            if ($this->header) {
                include($this->header);
            }

            if ($this->main) {
                include($this->main);
            }


            if ($this->topbar) {
                include($this->topbar);
            }

            if ($this->navbar) {
                include($this->navbar);
            }


            if ($this->template) {
                include($this->template);
            }

            if ($this->footer) {
                include($this->footer);
            }
        } else {
            include($this->template);
        }


        $content = ob_get_contents();
        ob_end_clean();

        if ($returnOnly === true) {
            return $content;
        } else {
            echo $content;
        }
    }

    public function renderizePdf($visionOnly = false) {

        $this->preRenderize();

        extract($this->data);
        ob_start();

        if (!$visionOnly) {
            if ($this->sessionControl) {
                include($this->sessionControl);
            }

            if ($this->header) {
                include($this->header);
            }

            if ($this->main) {
                include($this->main);
            }


            if ($this->topbar) {
                include($this->topbar);
            }

            if ($this->navbar) {
                include($this->navbar);
            }


            if ($this->template) {
                include($this->template);
            }

            if ($this->footer) {
                include($this->footer);
            }
        } else {
            include($this->template);
        }


        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function renderizeReport() {

        $this->preRenderize();

        extract($this->data);
        ob_start();

        if ($this->sessionControl) {
            include($this->sessionControl);
        }

        if ($this->header) {
            include($this->header);
        }

        if ($this->footer) {
            include($this->footer);
        }

        include($this->templateReport);

        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }

    /**
     * Retorna o caminho da visão a ser renderizada
     * @param type $template
     * @return string
     */
    private function getPath($template, $urlModule) {

        if ($this->checkCurrentOS("Win")) {
            $mappath = '/' . str_replace("\\", "/", str_replace("C:\\", "", dirname(__FILE__)));
        } else {

            $mappath = dirname(__FILE__);
        }

        return str_replace("\\", '/', $urlModule . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . $template . ".phtml");
    }

    /**
     * Checa qual o sistema operacional está sendo utilizado
     * @param type $_OS
     * @return boolean
     */
    private function checkCurrentOS($_OS) {
        if (strcmp($_OS, _CUR_OS) == 0) {
            return true;
        }
        return false;
    }

    # RENDERIZACAO

    public function disableNavbar() {
        $this->navbar = NULL;
    }

    public function disableTopbar() {
        $this->topbar = NULL;
    }

    public function disableMain() {
        $this->main = NULL;
    }

    public function disableFooter() {
        $this->footer = NULL;
    }

    public function disableSessionControl() {
        $this->sessionControl = NULL;
    }

    private function preRenderize() {
        if (!isset($this->data['styles'])) {
            $this->data['styles'] = array();
        }

        if (!isset($this->data['scripts'])) {
            $this->data['scripts'] = array();
        }
        if (!isset($this->data['coreStyles'])) {
            $this->data['coreStyles'] = array();
        }

        if (!isset($this->data['coreScripts'])) {
            $this->data['coreScripts'] = array();
        }
        if (!isset($this->data['modalMode'])) {
            $this->data['coreScripts'] = array();
        }

        if ($this->modalMode == true) {
            $this->topbar = false;
            $this->navbar = false;
        }

        SessionHelper::generateCsrf(array($this->data['viewTemplate'] => md5($this->data['viewTemplate'] . uniqid(rand(), TRUE))));
    }

    public function noRenderize() {
        die;
    }

    /**
     * Integração Controle View
     */
    public function modalAlert($type, $message, $goToAfterResult = null) {

        $buttonColor = '';

        if ($type == 'error') {
            $buttonColor = '#F44336';
            $title = 'Falha';
        } else if ($type == 'success') {
            $buttonColor = '#37a53b';
            $title = 'Sucesso!';
        } else if ($type == 'warning') {
            $buttonColor = '#F8BB86';
            $title = 'Alerta!';
        } else if ($type == 'info') {
            $buttonColor = '#C9DAE1';
            $title = 'Aviso!';
        }


        is_array($message) ? $message = $message['retornoMensagem'] : null;
        empty($goToAfterResult) ? $url = "" : $url = SystemConfig::SYSTEM_ROOT . "/" . $goToAfterResult;
        $this->setVariable('modalAlert', json_encode(array('component' => 'returnDefaultSuccessJson', 'erro' => 0, 'modal' => array('type' => $type, 'message' => $message, 'icon' => "<i class=glyphicon glyphicon-check></i>", 'title' => $title, 'urlRedirect' => $url, 'buttonColor' => $buttonColor))));
    }

    public function breadcrumb($icone, Array $local) {
        $this->setVariable('iconBreadcrumb', $icone);
        $this->setVariable('textBreadcrumb', $local);
    }

    public function pageTitle($title) {
        $this->setVariable('pageTitle', trim($title));
    }

    public function setScripts(Array $scripts) {
        $this->setVariable('scripts', $scripts);
    }

    public function setStyles(Array $styles) {
        $this->setVariable('styles', $styles);
    }

    public function setCoreScripts(Array $scripts) {
        $this->setVariable('coreScripts', $scripts);
    }

    public function setCoreStyles(Array $styles) {
        $this->setVariable('coreStyles', $styles);
    }

    public function Strings($array, $for = NULL) {
        echo '<label for=' . $for . ' >' . $array . ':</label>';
    }

    public function makeOptions($array, $value = NULL, $text = NULL, $defaultOption = TRUE, $selecionado = '') {

        if (!is_array($selecionado)) {
            $selecionado = explode(',', $selecionado);
        }

        if ($defaultOption !== NULL) {
            if ($defaultOption === TRUE) {
                echo '<option value="">Selecione...</option>';
            } else {
                echo '<option value="">' . $defaultOption . '</option>';
            }
        }


        if (!is_null($value) && !is_null($text)) {

            $value = "get" . $value;
            $text = "get" . $text;

            foreach ($array as $key => $obj) {
                echo '<option value="' . $obj->$value() . '" data-subtext="" ' . (in_array($obj->$value(), $selecionado) ? 'selected' : '') . '>' . $obj->$text() . '</option>';
            }
        } else {
            foreach ($array as $key => $value) {
                echo '<option value="' . $key . '" data-subtext="" ' . (in_array($key, $selecionado) ? 'selected' : '') . '>' . $value . '</option>';
            }
        }
    }

    function returnIfExist($valor, $returnOnFalse = 0) {
        return isset($valor) ? $valor : $returnOnFalse;
    }

}

?>