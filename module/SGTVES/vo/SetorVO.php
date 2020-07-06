<?php

namespace module\framework\vo;

use core\vo\AbstractVO;

class SetorVO extends AbstractVO {

    private $id;
    private $nome;
    
    public function __construct() {
        parent::__construct();
    }
    
    /* Transient */
    private $exceto;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
    
    function getExceto() {
        return $this->exceto;
    }

    function setExceto($exceto) {
        $this->exceto = $exceto;
    }

        
    public function bind($array, $prefixo = "") {        
        !empty($array["{$prefixo}data_inclusao"]) ? $this->setDataInclusao(trim($array["{$prefixo}data_inclusao"])) : null;
        !empty($array["{$prefixo}data_alteracao"]) ? $this->setDataAlteracao(trim($array["{$prefixo}data_alteracao"])) : null;
        !empty($array["{$prefixo}usuario_inclusao"]) ? $this->setUsuarioInclusao(trim($array["{$prefixo}usuario_inclusao"])) : null;
        !empty($array["{$prefixo}usuario_alteracao"]) ? $this->setUsuarioAlteracao(trim($array["{$prefixo}usuario_alteracao"])) : null;
        !empty($array["{$prefixo}excluido"]) ? $this->setExcluido(trim($array["{$prefixo}excluido"])) : null;
        
        !empty($array["{$prefixo}id_setor"]) ? $this->setId(trim($array["{$prefixo}id_setor"])) : null;
        !empty($array["{$prefixo}nome"]) ? $this->setNome(trim($array["{$prefixo}nome"])) : null;
    }

}
