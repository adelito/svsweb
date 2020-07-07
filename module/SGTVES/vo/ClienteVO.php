<?php

namespace module\SGTVES\vo;

use core\vo\AbstractVO;

class ClienteVO extends AbstractVO {

    private $cnpj;
    private $nome;
    private $nFantasia;
    private $logradouro;
    private $nro;
    private $bairro;
    private $municipio;
    private $uf;
    private $cep;
    private $pais;
    private $fone;
    private $ie;


    public function __construct() {
        parent::__construct();
    }

    /**
     * @return mixed
     */

    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getNFantasia()
    {
        return $this->nFantasia;
    }

    /**
     * @param mixed $nFantasia
     */
    public function setNFantasia($nFantasia)
    {
        $this->nFantasia = $nFantasia;
    }

    /**
     * @return mixed
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * @param mixed $logradouro
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    /**
     * @return mixed
     */
    public function getNro()
    {
        return $this->nro;
    }

    /**
     * @param mixed $nro
     */
    public function setNro($nro)
    {
        $this->nro = $nro;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @return mixed
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * @param mixed $municipio
     */
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }

    /**
     * @return mixed
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @param mixed $uf
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * @return mixed
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * @param mixed $pais
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    /**
     * @return mixed
     */
    public function getFone()
    {
        return $this->fone;
    }

    /**
     * @param mixed $fone
     */
    public function setFone($fone)
    {
        $this->fone = $fone;
    }

    /**
     * @return mixed
     */
    public function getIe()
    {
        return $this->ie;
    }

    /**
     * @param mixed $ie
     */
    public function setIe($ie)
    {
        $this->ie = $ie;
    }




    public function bind($array, $prefixo = "") {

        !empty($array["{$prefixo}CNPJ"]) ? $this->setCnpj(trim($array["{$prefixo}CNPJ"])) : null;
        !empty($array["{$prefixo}NOME"]) ? $this->setnome(trim($array["{$prefixo}NOME"])) : null;
        !empty($array["{$prefixo}NFANTASIA"]) ? $this->setNFantasia(trim($array["{$prefixo}NFANTASIA"])) : null;
        !empty($array["{$prefixo}LOGRADOURO"]) ? $this->setLogradouro(trim($array["{$prefixo}LOGRADOURO"])) : null;
        !empty($array["{$prefixo}NRO"]) ? $this->setNro(trim($array["{$prefixo}NRO"])) : null;
        !empty($array["{$prefixo}BAIRRO"]) ? $this->setBairro(trim($array["{$prefixo}BAIRRO"])) : null;
        !empty($array["{$prefixo}MUNICIPIO"]) ? $this->setMunicipio(trim($array["{$prefixo}MUNICIPIO"])) : null;
        !empty($array["{$prefixo}UF"]) ? $this->setUf(trim($array["{$prefixo}UF"])) : null;
        !empty($array["{$prefixo}CEP"]) ? $this->setCep(trim($array["{$prefixo}CEP"])) : null;
        !empty($array["{$prefixo}PAIS"]) ? $this->setPais(trim($array["{$prefixo}PAIS"])) : null;
        !empty($array["{$prefixo}FONE"]) ? $this->setFone(trim($array["{$prefixo}FONE"])) : null;
        !empty($array["{$prefixo}IE"]) ? $this->setIe(trim($array["{$prefixo}IE"])) : null;



        !empty($array["{$prefixo}data_inclusao"]) ? $this->setDataInclusao(trim($array["{$prefixo}data_inclusao"])) : null;
        !empty($array["{$prefixo}data_alteracao"]) ? $this->setDataAlteracao(trim($array["{$prefixo}data_alteracao"])) : null;
        !empty($array["{$prefixo}usuario_inclusao"]) ? $this->setUsuarioInclusao(trim($array["{$prefixo}usuario_inclusao"])) : null;
        !empty($array["{$prefixo}usuario_alteracao"]) ? $this->setUsuarioAlteracao(trim($array["{$prefixo}usuario_alteracao"])) : null;
        !empty($array["{$prefixo}excluido"]) ? $this->setExcluido(trim($array["{$prefixo}excluido"])) : null;


    }

}
