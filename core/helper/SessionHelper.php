<?php

namespace core\helper;

use config\SystemConfig;

/**
 * Classe utilitária para Sessão
 * @package core
 * @subpackage helper
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
class SessionHelper {

    /**
     * Gera ou seleciona uma session_name
     * @static
     * @access public
     * @param void
     * @return void
     */
    public static function generateSessionName() {
        if (session_status() !== PHP_SESSION_ACTIVE) {

        session_name(md5('SEGSEC' . SystemConfig::CHAVE_APLICACAO . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
        }
    }

    /**
     * Retorna o nome da sessão
     * @static
     * @access public
     * @param void
     * @return string Nome da Sessão
     */
    public static function getSessionName() {
        return session_name();
    }

    /**
     * Inicia uma sessão
     * @static
     * @access public
     * @param void
     * @return void
     */
    public static function startSession() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * Retorna um determinado valor contido na sessão
     * @static
     * @access public
     * @param string $chave Nome do valor a ser retornado
     * @return string|null valor encontrado
     */
    public static function getSessionValue($chave) {
        # FAZER TRATAMENTO SE SEGURANCA
        return isset($_SESSION[$chave]) ? $_SESSION[$chave] : null;
    }

    /**
     * Seta um determinado valor na sessão
     * @static
     * @access public
     * @param string $chave Nome do valor a ser inserido
     * @param string $valor Valor a ser inserido
     * @return void
     */
    public static function setSessionValue($chave, $valor) {
        $_SESSION[$chave] = $valor;
    }

    /**
     * Gera CSRF caso não exista e adiciona o valor do array de CSRF criada na sessão
     * @static
     * @access public
     * @param string $chave $chave a ser armazenada como csrf
     * @return void
     */
    public static function generateCsrf($chave) {

        if (is_null(SessionHelper::getSessionValue('csrf'))) {
            SessionHelper::setSessionValue('csrf', array());
        }
        # codigo para gerar csrf
        SessionHelper::setSessionValue('csrf', array_merge(SessionHelper::getSessionValue('csrf'), $chave));
    }

    /**
     * Retorna CSRF armazenado na sessão
     * @static
     * @access public
     * @param void
     * @return string Chave CSRF
     */
    public static function getCsrf() {
        return SessionHelper::getSessionValue('csrf');
    }

    /**
     * Retorna valor da sessão referente a chave CSRF
     * @static
     * @access public
     * @param string $chave Nome da chave referente ao valor dentro do CSRF. 
     * @return string Valor encontrado
     */
    public static function getCsrfValue($chave) {

        $csrf = SessionHelper::getSessionValue('csrf');

        if (is_null($csrf)) {
            return null;
        }

        if (!isset($csrf[$chave])) {
            return null;
        }

        return $csrf[$chave];
    }

    /**
     * Gera input para exibição nos PHTML da view
     * @static
     * @access public
     * @param string $templateName nome do template carregado pela view para qual o csrf será gerado.  
     * @return string Campo Input type=hidden com valor da csrf
     */
    public static function Csrf($templateName) {
        echo '<input type="hidden" name="csrf" value="' . SessionHelper::getCsrfValue($templateName) . '" >';
    }

    public static function sessionDestroy() {

        // Apaga todas as variáveis da sessão
        $_SESSION = array();

        // Se é preciso matar a sessão, então os cookies de sessão também devem ser apagados.
        // Nota: Isto destruirá a sessão, e não apenas os dados!

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }

        // Por último, destrói a sessão
        session_destroy();
    }

}

?>
