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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCnpjCliente()
    {
        return $this->cnpjCliente;
    }

    /**
     * @param mixed $cnpjCliente
     */
    public function setCnpjCliente($cnpjCliente)
    {
        $this->cnpjCliente = $cnpjCliente;
    }

    /**
     * @return mixed
     */
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * @param mixed $placa
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }

    /**
     * @return mixed
     */
    public function getDataSaida()
    {
        return $this->dataSaida;
    }

    /**
     * @param mixed $dataSaida
     */
    public function setDataSaida($dataSaida)
    {
        $this->dataSaida = $dataSaida;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * @param mixed $observacao
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;
    }



    
    public function bind($array, $prefixo = "") {
        !empty($array["{$prefixo}CODRECEBIMENTO"]) ? $this->setId(trim($array["{$prefixo}CODRECEBIMENTO"])) : null;
        !empty($array["{$prefixo}CNPJCLIENTE"]) ? $this->setCnpjCliente(trim($array["{$prefixo}CNPJCLIENTE"])) : null;
        !empty($array["{$prefixo}PLACA"]) ? $this->setPlaca(trim($array["{$prefixo}PLACA"])) : null;
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