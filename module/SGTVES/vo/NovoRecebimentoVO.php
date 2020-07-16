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

    //TRANSIENTE
    private $pesoLiquido;
    private $pesoBruto;
    private $totalNfe;
    private $status;

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

    /**
     * @return mixed
     */
    public function getPesoLiquido()
    {
        return $this->pesoLiquido;
    }

    /**
     * @param mixed $pesoLiquido
     */
    public function setPesoLiquido($pesoLiquido)
    {
        $this->pesoLiquido = $pesoLiquido;
    }

    /**
     * @return mixed
     */
    public function getPesoBruto()
    {
        return $this->pesoBruto;
    }

    /**
     * @param mixed $pesoBruto
     */
    public function setPesoBruto($pesoBruto)
    {
        $this->pesoBruto = $pesoBruto;
    }

    /**
     * @return mixed
     */
    public function getTotalNfe()
    {
        return $this->totalNfe;
    }

    /**
     * @param mixed $totalNfe
     */
    public function setTotalNfe($totalNfe)
    {
        $this->totalNfe = $totalNfe;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }



    
    public function bind($array, $prefixo = "") {
        !empty($array["{$prefixo}codRecebimento"]) ? $this->setId(trim($array["{$prefixo}codRecebimento"])) : null;
        !empty($array["{$prefixo}cnpjCliente"]) ? $this->setCnpjCliente(trim($array["{$prefixo}cnpjCliente"])) : null;
        !empty($array["{$prefixo}placa"]) ? $this->setPlaca(trim($array["{$prefixo}placa"])) : null;
        !empty($array["{$prefixo}dtSaida"]) ? $this->setDataSaida(trim($array["{$prefixo}dtSaida"])) : null;
        !empty($array["{$prefixo}descricao"]) ? $this->setDescricao(trim($array["{$prefixo}descricao"])) : null;
        !empty($array["{$prefixo}observacao"]) ? $this->setObservacao(trim($array["{$prefixo}observacao"])) : null;

    }

}