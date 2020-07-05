<?php

namespace core\vo\pessoa;

use core\vo\pessoa\PessoaVO;

class PessoaFisicaVO extends PessoaVO {

    private $nomeSocial;
    private $Cpf;
    private $rg;
    private $orgaoExpedidor;
    private $dataNascimento;
    private $genero;

    function __construct() {
        parent::__construct();
    }

    
    
    function getNomeSocial() {
        return $this->nomeSocial;
    }

    function getCpf() {
        return $this->Cpf;
    }

    function getRg() {
        return $this->rg;
    }

    function getOrgaoExpedidor() {
        return $this->orgaoExpedidor;
    }

    function getDataNascimento() {
        return $this->dataNascimento;
    }

    function getGenero() {
        return $this->genero;
    }

    function setNomeSocial($nomeSocial) {
        $this->nomeSocial = $nomeSocial;
    }

    function setCpf($Cpf) {
        $this->Cpf = $Cpf;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setOrgaoExpedidor($orgaoExpedidor) {
        $this->orgaoExpedidor = $orgaoExpedidor;
    }

    function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

        
    
    public function bind($array, $prefixo = "") {
        !empty($array["{$prefixo}NOME_SOCIAL"]) ? $this->setNomeSocial(trim($array["{$prefixo}NOME_SOCIAL"])) : null;
        !empty($array["{$prefixo}CPF"]) ? $this->setCpf(trim($array["{$prefixo}CPF"])) : null;
        !empty($array["{$prefixo}RG"]) ? $this->setRg(trim($array["{$prefixo}RG"])) : null;
        !empty($array["{$prefixo}ORGAO_EXPEDIDOR"]) ? $this->setOrgaoExpedidor(trim($array["{$prefixo}ORGAO_EXPEDIDOR"])) : null;
        !empty($array["{$prefixo}DATA_NASCIMENTO"]) ? $this->setDataNascimento(trim($array["{$prefixo}DATA_NASCIMENTO"])) : null;
        !empty($array["{$prefixo}GENERO"]) ? $this->setGenero(trim($array["{$prefixo}GENERO"])) : null;        
        
        !empty($array["{$prefixo}ID_PESSOA"]) ? parent::setId(trim($array["{$prefixo}ID_PESSOA"])) : null;
        !empty($array["{$prefixo}TIPO_PESSOA"]) ? parent::setTipoPessoa(trim($array["{$prefixo}TIPO_PESSOA"])) : null;
        !empty($array["{$prefixo}NOME"]) ? parent::setNome(trim($array["{$prefixo}NOME"])) : null;
        !empty($array["{$prefixo}EMAIL"]) ? parent::setEmail(trim($array["{$prefixo}EMAIL"])) : null;
        !empty($array["{$prefixo}MODIFICADO_EM"]) ? parent::setModificadoEm(trim($array["{$prefixo}MODIFICADO_EM"])) : null;
        !empty($array["{$prefixo}EXCLUIDO"]) ? parent::setExcluido(trim($array["{$prefixo}EXCLUIDO"])) : null;
        
    }

}
