<?php

namespace core\vo\pessoa;

use core\vo\pessoa\PessoaVO;

class PessoaResponsavelVO{
    
    private $id;
    private $idPessoa;
    private $idResponsavel;
    
    function __construct() {
        parent::__construct();
        $this->idPessoa = new PessoaVO;
        $this->idResponsavel = new PessoaVO();
    }

    
    public function getId() {
        return $this->id;
    }

    public function getIdPessoa() {
        return $this->idPessoa;
    }

    public function getIdResponsavel() {
        return $this->idResponsavel;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    public function setIdResponsavel($idResponsavel) {
        $this->idResponsavel = $idResponsavel;
    }

    
    public function bind($array, $prefixo = ""){
        !empty($array["{$prefixo}ID_PESSOA_RESPONSAVEL"]) ? $this->setId(trim($array["{$prefixo}ID_PESSOA_RESPONSAVEL"])) : null;
        !empty($array["{$prefixo}ID_PESSOA"]) ? $this->getIdPessoa()->setId(trim($array["{$prefixo}ID_PESSOA"])) : null;
        !empty($array["{$prefixo}ID_RESPONSAVEL"]) ? $this->getIdResponsavel()->setId(trim($array["{$prefixo}ID_RESPONSAVEL"])) : null;    
    }

}
