<?php

namespace core\helper;

/**
 * Classe Helper de Controller
 * @package core
 * @subpackage helper
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
class ControllerHelper {

    /**
     * Flag indicador de erro
     * @var bool $chkErro
     * @access private
     */
    private $chkErro;

    /**
     * Retorno do método
     * @var mixed $retorno
     * @access private
     */
    private $retorno;

    /**
     * Classe Construtora
     * @param void
     * @return void
     */
    public function __construct() {
        $this->chkErro = NULL;
        $this->retorno['retornoOperacao'] = FALSE;
        $this->retorno['retornoMensagem'] = NULL;
    }

    /**
     * Retorna informações manipuladas na camada BO
     * @access public
     * @param void
     * @return Array Contem informações do retorno (Boolean) e mensagem (String)
     */
    public function getRetorno() {
        return $this->retorno;
    }

    /**
     * Seta informações manipuladas na camada BO
     * @access public
     * @param string $retorno Array com informações do retorno
     * @return void
     */
    function setRetorno($retorno) {
        $this->retorno = $retorno;
    }

    /**
     * Seta array de mensgens do retorno da operação
     * @access public
     * @param string $retornoMensagem mensagens retornadas
     * @return void
     */
    public function setRetornoMensagem($retornoMensagem) {
        $this->retorno['retornoMensagem'] = $retornoMensagem;
    }

    /**
     * Seta array de retultado da operação
     * @access public
     * @param string $retornoConteudo Retorno da operação.
     * @return void
     */
    public function setRetornoOperacao($retornoConteudo) {
        $this->retorno['retornoOperacao'] = $retornoConteudo;
    }

    /**
     * Retorna informações de mensagem da operação
     * @access public
     * @param void
     * @return String Mensagem de retorno
     */
    public function getRetornoMensagem() {
        return $this->retorno['retornoMensagem'];
    }

    /**
     * Retorna resultado da operação
     * @access public
     * @param void
     * @return Mixed Object | ArrayIterator | String | Boolean
     */
    public function getRetornoOperacao() {
        return $this->retorno['retornoOperacao'];
    }

    /**
     * Retorna mensagem de retorno da separado por um caracter
     * @access public
     * @param string $catacter Caracter a ser utilizado na composição
     * @return Mixed Object | ArrayIterator | string | boolean
     */
    public function getRetornoMensagemImplode($catacter = "\n") {
        return implode($catacter, $this->retorno['retornoMensagem']);
    }

    /**
     * Adiciona mensagem de retorno ao array retornoMensagem
     * @access public
     * @param string $msgRetorno Mensagem de retorno
     * @return void
     */
    public function addRetornoMensagem($msgRetorno) {
        $this->retorno['retornoMensagem'][] = $msgRetorno;
    }

}
?>
