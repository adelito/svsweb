<?php

namespace core\vo\pessoa;

use core\vo\pessoa\PessoaVO;

class PessoaJuridicaVO extends PessoaVO {

    private $idMatriz;
    private $cnpj;
    private $inscricaoEstadual;
    private $nomeFantasia;
    private $nomeContato;
    
    function __construct() {
        parent::__construct();
    }

    
    function getIdMatriz() {
        return $this->idMatriz;
    }

    function getCnpj() {
        return $this->cnpj;
    }

    function getInscricaoEstadual() {
        return $this->inscricaoEstadual;
    }

    function getNomeFantasia() {
        return $this->nomeFantasia;
    }

    function getNomeContato() {
        return $this->nomeContato;
    }

    function setIdMatriz($idMatriz) {
        $this->idMatriz = $idMatriz;
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    function setInscricaoEstadual($inscricaoEstadual) {
        $this->inscricaoEstadual = $inscricaoEstadual;
    }

    function setNomeFantasia($nomeFantasia) {
        $this->nomeFantasia = $nomeFantasia;
    }

    function setNomeContato($nomeContato) {
        $this->nomeContato = $nomeContato;
    }

            
    
    public function bind($array, $prefixo = "") {
        !empty($array["{$prefixo}ID_MATRIZ"]) ? $this->setNomeSocial(trim($array["{$prefixo}ID_MATRIZ"])) : null;
        !empty($array["{$prefixo}CNPJ"]) ? $this->setCpf(trim($array["{$prefixo}CNPJ"])) : null;
        !empty($array["{$prefixo}INSCRICAO_ESTADUAL"]) ? $this->setRg(trim($array["{$prefixo}INSCRICAO_ESTADUAL"])) : null;
        !empty($array["{$prefixo}NOME_FANTASIA"]) ? $this->setOrgaoExpedidor(trim($array["{$prefixo}NOME_FANTASIA"])) : null;
        !empty($array["{$prefixo}NOME_CONTATO"]) ? $this->setDataNascimento(trim($array["{$prefixo}NOME_CONTATO"])) : null;
        
        //PessoaVO
        !empty($array["{$prefixo}ID_PESSOA"]) ? parent::setId(trim($array["{$prefixo}ID_PESSOA"])) : null;
        !empty($array["{$prefixo}TIPO_PESSOA"]) ? parent::setTipoPessoa(trim($array["{$prefixo}TIPO_PESSOA"])) : null;
        !empty($array["{$prefixo}NOME"]) ? parent::setNome(trim($array["{$prefixo}NOME"])) : null;
        !empty($array["{$prefixo}MODIFICADO_EM"]) ? parent::setModificadoEm(trim($array["{$prefixo}MODIFICADO_EM"])) : null;
        !empty($array["{$prefixo}EXCLUIDO"]) ? parent::setExcluido(trim($array["{$prefixo}EXCLUIDO"])) : null;
        
    }

}
