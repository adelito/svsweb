<?php

namespace core\helper;

/**
 * Description of Manipulador
 *
 * @author JUDAPASSOS
 */
class DaoHelper {

    /**
     * Conexao
     * @var PDO $conexao
     * @access private
     */
    private $conexao;

    /**
     * Preparação
     * @var PDOStatement $stmt
     * @access private
     */
    private $stmt;

    /**
     * Comando Sql a ser executado
     * @var String $sql
     * @access private
     */
    private $sql;

    /**
     * Retorno do método
     * @var mixed $retorno
     * @access private
     */
    private $retorno;
    private $fetch;

    function __construct() {
        $this->conexao = NULL;
        $this->stmt = NULL;
        $this->sql = NULL;
        $this->retorno['retornoOperacao'] = FALSE;
        $this->retorno['retornoMensagem'] = NULL;
    }

    public function getFetch() {
        return $this->fetch;
    }

    public function setFetch($fetch) {
        $this->fetch = $fetch;
    }

    /**
     * @param void
     * @return PDO 
     */
    public function getConexao() {
        return $this->conexao;
    }

    /**
     * @param PDO $conexao 
     * @return void
     */
    public function setConexao($conexao) {
        $this->conexao = $conexao;
    }

    /**
     * @param void
     * @return PDOStatement 
     */
    public function getStmt() {
        return $this->stmt;
    }

    /**
     * @param PDOStatement $stmt 
     * @return void
     */
    public function setStmt($stmt) {
        $this->stmt = $stmt;
    }

    /**
     * @param void
     * @return String 
     */
    public function getSql() {
        return $this->sql;
    }

    /**
     * @param String $sql 
     * @return void
     */
    public function setSql($sql) {
        $this->sql = trim($sql);
    }

    public function getRetorno() {
        return $this->retorno;
    }

    public function setRetornoMensagem($retornoMensagem) {
        $this->retorno['retornoMensagem'] = $retornoMensagem;
    }

    public function setRetornoOperacao($retornoOperacao) {
        $this->retorno['retornoOperacao'] = $retornoOperacao;
    }

    public function getRetornoMensagem() {
        return $this->retorno['retornoMensagem'];
    }

    public function getRetornoOperacao() {
        return $this->retorno['retornoOperacao'];
    }

    ## METODOS PARA OCI

    public function parse($sql) {
        
        $this->setStmt(pg_query($this->getConexao(), $sql));
                
    }

    public function bindValue($param, $value, $demiliter = true) {
        $strSql = "";
        $strSql = $this->getSql();

        $value = str_replace(array('"', "'"), array('""', "''"), $value);

        if ($demiliter) {
            $value = " '" . $value . "' ";
        }

        $strSql = str_replace(" " . $param, " " . $value, $strSql);
        $strSql = str_replace("(" . $param, "(" . $value, $strSql);

        $this->setSql($strSql);
    }

    public function execute($autocommit = true) {
        $this->parse($this->getSql());

        if ($autocommit) {
            if (false === @oci_execute($this->getStmt(), OCI_COMMIT_ON_SUCCESS)) {
                $erro = oci_error($this->getStmt());
                $erroOCI = $erro['message'] . " - " . $erro['sqltext'];
                throw new \Exception($erroOCI);
            }
        } else {
            if (false === @oci_execute($this->getStmt(), OCI_NO_AUTO_COMMIT)) {
                $erro = oci_error($this->getStmt());
                $erroOCI = $erro['message'] . " - " . $erro['sqltext'];
                throw new \Exception($erroOCI);
            }
        }
    }

    public function fetchAll() {
        oci_fetch_all($this->getStmt(), $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        return $res;
    }

    public function fetch() {
        return oci_fetch_array($this->getStmt());
    }

    public function fetchAssoc() {
        return oci_fetch_assoc($this->getStmt());
    }

    public function commit() {
        return oci_commit($this->getConexao());
    }

    public function rollback() {
        return oci_rollback($this->getConexao());
    }

}

?>
