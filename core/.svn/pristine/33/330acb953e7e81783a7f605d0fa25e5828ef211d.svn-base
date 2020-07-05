<?php

namespace core\vo;

use core\vo\status\StatusCadastroVO;

//use core\vo\pessoa\PessoaVO;

abstract class AbstractVO {

    private $dataInclusao;
    private $dataAlteracao;
    private $usuarioInclusao;
    private $usuarioAlteracao;
    private $excluido;
    private $prefixoTabela;
    private $modificadoEm;
    private $esquemaTabela;
    private $paginacaoRegistroInicio;
    private $paginacaoRegistroTotal;
    private $paginacaoRegistroTotalPorPagina;
    private $paginacaoDraw;

    public function __construct() {
//        $this->idPessoaCadastro = new PessoaVO();
//        $this->idPessoaAlteracao = new PessoaVO();
//        $this->idStatusCadastro = new StatusCadastroVO();
    }

    public function getPrefixoTabela() {
        return $this->prefixoTabela;
    }

    public function setPrefixoTabela($prefixoTabela) {
        $this->prefixoTabela = $prefixoTabela;
    }

    public function getModificadoEm() {
        return $this->modificadoEm;
    }

    public function setModificadoEm($modificadoEm) {
        $this->modificadoEm = $modificadoEm;
    }

    function getDataInclusao() {
        return $this->dataInclusao;
    }

    function getDataAlteracao() {
        return $this->dataAlteracao;
    }

    function getUsuarioInclusao() {
        return $this->usuarioInclusao;
    }

    function getUsuarioAlteracao() {
        return $this->usuarioAlteracao;
    }

    function getExcluido() {
        return $this->excluido;
    }

    function setDataInclusao($dataInclusao) {
        $this->dataInclusao = $dataInclusao;
    }

    function setDataAlteracao($dataAlteracao) {
        $this->dataAlteracao = $dataAlteracao;
    }

    function setUsuarioInclusao($usuarioInclusao) {
        $this->usuarioInclusao = $usuarioInclusao;
    }

    function setUsuarioAlteracao($usuarioAlteracao) {
        $this->usuarioAlteracao = $usuarioAlteracao;
    }

    function setExcluido($excluido) {
        $this->excluido = $excluido;
    }

    function getEsquemaTabela() {
        return $this->esquemaTabela;
    }

    function setEsquemaTabela($esquemaTabela) {
        $this->esquemaTabela = $esquemaTabela;
    }

    function getPaginacaoRegistroInicio() {
        return $this->paginacaoRegistroInicio;
    }

    function getPaginacaoRegistroTotal() {
        return $this->paginacaoRegistroTotal;
    }

    function getPaginacaoRegistroTotalPorPagina() {
        return $this->paginacaoRegistroTotalPorPagina;
    }

    function getPaginacaoDraw() {
        return $this->paginacaoDraw;
    }

    function setPaginacaoRegistroInicio($paginacaoRegistroInicio) {
        $this->paginacaoRegistroInicio = $paginacaoRegistroInicio;
    }

    function setPaginacaoRegistroTotal($paginacaoRegistroTotal) {
        $this->paginacaoRegistroTotal = $paginacaoRegistroTotal;
    }

    function setPaginacaoRegistroTotalPorPagina($paginacaoRegistroTotalPorPagina) {
        $this->paginacaoRegistroTotalPorPagina = $paginacaoRegistroTotalPorPagina;
    }

    function setPaginacaoDraw($paginacaoDraw) {
        $this->paginacaoDraw = $paginacaoDraw;
    }

    /**
     * HOOK de SET PADRAO
     */
    public function setPadrao($array, $prefixo = "") {

        !empty($array["{$prefixo}DATA_INCLUSAO"]) ? $this->setDataInclusao(trim($array["{$prefixo}DATA_INCLUSAO"])) : null;
        !empty($array["{$prefixo}DATA_ALTERACAO"]) ? $this->setDataAlteracao(trim($array["{$prefixo}DATA_ALTERACAO"])) : null;
        !empty($array["{$prefixo}USUARIO_INCLUSAO"]) ? $this->setUsuarioInclusao(trim($array["{$prefixo}USUARIO_INCLUSAO"])) : null;
        !empty($array["{$prefixo}USUARIO_ALTERACAO"]) ? $this->setUsuarioAlteracao(trim($array["{$prefixo}USUARIO_ALTERACAO"])) : null;
        !empty($array["{$prefixo}EXCLUIDO"]) ? $this->setExcluido(trim($array["{$prefixo}EXCLUIDO"])) : null;

        isset($array["start"]) ? $this->setPaginacaoRegistroInicio($array["start"]) : null;
        isset($array["recordsTotal"]) ? $this->setPaginacaoRegistroTotal($array["recordsTotal"]) : null;
        isset($array["length"]) ? $this->setPaginacaoRegistroTotalPorPagina($array["length"]) : null;
        isset($array["draw"]) ? $this->setPaginacaoDraw($array["draw"]) : null;

        return $array;
    }

    /**
     * Método de implementacao do Bind onde com base no 
     * Conheciento do modelo deve-se fazer o preenchimento
     * dos atributos com base em um array
     * EX: !empty($arrayContato['idContato']) ? $this->setId($arrayContato['idContato']) : null;
     */
    abstract public function bind($array, $prefixo = "");
}
