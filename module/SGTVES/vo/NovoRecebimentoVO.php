<?php

namespace module\SGTVES\vo;

use core\vo\AbstractVO;

class NovoRecebimentoVO extends AbstractVO {

    private $id;
    private $cnpjCliente;
    private $placa;
    private $dataSaida;
    private $descricao;
    private $observacao;

    public function __construct() {
        parent::__construct();
        // $this->idSetor = new SetorVO();
    }

    function getId() {
        return $this->id;
    }

    function getCnpjCliente() {
        return $this->cnpjCliente;
    }

    function getDataSaida() {
        return $this->dataSaida;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getObservacao() {
        return $this->observacao;
    }

    function getPalaca() {
        return $this->palaca;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCnpjCliente($cnpjCliente) {
        $this->cnpjCliente = $cnpjCliente;
    }

    function setDataSaida($dataSaida) {
        $this->dataSaida = $dataSaida;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    function setPalaca($palaca) {
        $this->palaca = $palaca;
    }

    
    public function bind($array, $prefixo = "") {
        !empty($array["{$prefixo}CODRECEBIMENTO"]) ? $this->setId(trim($array["{$prefixo}CODRECEBIMENTO"])) : null;
        !empty($array["{$prefixo}CNPJCLIENTE"]) ? $this->setCnpjCliente(trim($array["{$prefixo}CNPJCLIENTE"])) : null;
        !empty($array["{$prefixo}PLACA"]) ? $this->setPalaca(trim($array["{$prefixo}PLACA"])) : null;
        !empty($array["{$prefixo}DTSAIDA"]) ? $this->setDataSaida(trim($array["{$prefixo}DTSAIDA"])) : null;
        !empty($array["{$prefixo}DESCRICAO"]) ? $this->setDescricao(trim($array["{$prefixo}DESCRICAO"])) : null;
        !empty($array["{$prefixo}OBSERVACAO"]) ? $this->setObservacao(trim($array["{$prefixo}OBSERVACAO"])) : null;

        !empty($array["{$prefixo}usuario_inclusao"]) ? $this->setUsuarioInclusao(trim($array["{$prefixo}usuario_inclusao"])) : null;
        !empty($array["{$prefixo}usuario_alteracao"]) ? $this->setUsuarioAlteracao(trim($array["{$prefixo}usuario_alteracao"])) : null;
        !empty($array["{$prefixo}data_inclusao"]) ? $this->setDataInclusao(trim($array["{$prefixo}data_inclusao"])) : null;
        !empty($array["{$prefixo}data_alteracao"]) ? $this->setDataAlteracao(trim($array["{$prefixo}data_alteracao"])) : null;
        !empty($array["{$prefixo}excluido"]) ? $this->setExcluido(trim($array["{$prefixo}excluido"])) : null;
    }

}