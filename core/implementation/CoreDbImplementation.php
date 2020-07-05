<?php

namespace core\implementation;

/**
 * Classe de implementação de conexão CORE
 * @package core
 * @subpackage implementation
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
class CoreDbImplementation {

    /**
     * Endereço do servidor
     * @access private
     * @var string 
     */
    private static $host = "";

    /**
     * Usuário de conexão
     * @access private
     * @var string 
     */
    private static $user = "";

    /**
     * Senha de conexão
     * @access private
     * @var string 
     */
    private static $password = "";

    /**
     * Nome do banco de dados
     * @access private
     * @var string 
     */
    private static $sid = "";

    /**
     * Porta para conexão
     * @access private
     * @var string 
     */
    private static $port = "";

    /**
     * Tipo de codificação
     * @access private
     * @var string 
     */
    private static $charset = "";

    /**
     * Tipo de Banco de Dados
     * @access private
     * @var string 
     */
    private static $dbType = "oracle";

    /**
     * Este método não deve ser implementado
     * @return void
     */
    final private function __clone() {
        
    }

    /**
     * Este método não deve ser implementado
     * @return void
     */
    final private function __wakeup() {
        
    }

    /**
     * Retorna o endereço do servidor
     * @param void
     * @return string
     */
    public static function getHost() {
        return self::$host;
    }

    /**
     * Retorna o usuário de conexão
     * @param void
     * @return string
     */
    public static function getUser() {
        return self::$user;
    }

    /**
     * Retorna a senha de conexão
     * @param void
     * @return string
     */
    public static function getPassword() {
        return self::$password;
    }

    /**
     * Retorna o nome banco de dados
     * @param void
     * @return string
     */
    public static function getSid() {
        return self::$sid;
    }

    /**
     * Retorna a porta de conexão
     * @param void
     * @return string
     */
    public static function getPort() {
        return self::$port;
    }

    /**
     * Retorna a codificação
     * @param void
     * @return string
     */
    public static function getCharset() {
        return self::$charset;
    }

    /**
     * Retorna o tipo do banco de dados
     * @param void
     * @return string
     */
    public static function getDbType() {
        return self::$dbType;
    }

    /**
     * Seta o endereço do servidor
     * @param string $host Endereço do servidor
     * @return void
     */
    public static function setHost($host) {
        self::$host = $host;
    }

    /**
     * Seta o usuário de conexão
     * @param string $user usuário de conexão
     * @return void
     */
    public static function setUser($user) {
        self::$user = $user;
    }

    /**
     * Seta a senha de conexão
     * @param string $password Senha de conexão
     * @return void
     */
    public static function setPassword($password) {
        self::$password = $password;
    }

    /**
     * Seta o nome do banco de dados
     * @param string $sid Nome do banco de dados
     * @return void
     */
    public static function setSid($sid) {
        self::$sid = $sid;
    }

    /**
     * Seta a porta de conexão
     * @param string $port Porta de conexão
     * @return void
     */
    public static function setPort($port) {
        self::$port = $port;
    }

    /**
     * Seta a codificação a ser utilizada
     * @param string $charset Codificação
     * @return void
     */
    public static function setCharset($charset) {
        self::$charset = $charset;
    }

    /**
     * Seta o tipo do banco de dados
     * @param string $dbType Tipo do banco de dados
     * @return void
     */
    public static function setDbType($dbType) {
        self::$dbType = $dbType;
    }

    /**
     * Realiza a conexão ao banco de dados
     * @param void
     * @return resource
     */
    public static function connect() {

        try {
            $conn = null;

            if (self::getDbType() == 'oracle') {

                $mydb = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=" . self::getHost() . ")(PORT=" . self::getPort() . "))(CONNECT_DATA=(SID=" . self::getSid() . ")))";
                $conn = oci_connect(self::getUser(), self::getPassword(), $mydb, self::getCharset());

                $stmt = oci_parse($conn, "ALTER SESSION SET NLS_LANGUAGE='BRAZILIAN PORTUGUESE'");
                oci_execute($stmt);
                $stmt = oci_parse($conn, "ALTER SESSION SET NLS_TERRITORY = 'BRAZIL'");
                oci_execute($stmt);
                $stmt = oci_parse($conn, "ALTER SESSION SET NLS_NUMERIC_CHARACTERS=',.'");
                oci_execute($stmt);
                $stmt = oci_parse($conn, "ALTER SESSION SET NLS_DATE_FORMAT = 'DD/MM/YYYY'");
                oci_execute($stmt);
                $stmt = oci_parse($conn, "ALTER SESSION SET NLS_TIMESTAMP_FORMAT = 'DD/MM/YYYY HH24:MI:SS'");
                oci_execute($stmt);

                return $conn;
            }

            if (is_null($conn)) {
                echo "DbType inexistente " . self::getSid();
                die;
            }
        } catch (\Exception $ex) {
            echo "Não foi possível conectar ao banco de dados " . self::getSid();
            die;
        }
    }

}
