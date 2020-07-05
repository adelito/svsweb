<?php

namespace core\vo\pessoa;

use core\vo\AbstractVO;

class PessoaVO extends AbstractVO {

    private $id;
    private $tipoPessoa;
    private $nome;
    
    /* transient*/
    private $emails;

    function __construct() {
        parent::__construct();
        $this->emails = new \ArrayIterator();
    }

    function getId() {
        return $this->id;
    }

    function getTipoPessoa() {
        return $this->tipoPessoa;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmails() {
        return $this->emails;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipoPessoa($tipoPessoa) {
        $this->tipoPessoa = $tipoPessoa;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmails($emails) {
        $this->emails = $emails;
    }

    
    public function bind($array, $prefixo = "") {
        !empty($array["{$prefixo}ID_PESSOA"]) ? $this->setId(trim($array["{$prefixo}ID_PESSOA"])) : null;
        !empty($array["{$prefixo}TIPO_PESSOA"]) ? $this->setTipoPessoa(trim($array["{$prefixo}TIPO_PESSOA"])) : null;
        !empty($array["{$prefixo}NOME"]) ? $this->setNome(trim($array["{$prefixo}NOME"])) : null;
        !empty($array["{$prefixo}MODIFICADO_EM"]) ? $this->setModificadoEm(trim($array["{$prefixo}MODIFICADO_EM"])) : null;
        !empty($array["{$prefixo}EXCLUIDO"]) ? $this->setExcluido(trim($array["{$prefixo}EXCLUIDO"])) : null;
        
        //AbstractVO
        !empty($array["{$prefixo}DATA_INCLUSAO"]) ? $this->setDataInclusao(trim($array["{$prefixo}DATA_INCLUSAO"])) : null;
        !empty($array["{$prefixo}DATA_ALTERACAO"]) ? $this->setDataAlteracao(trim($array["{$prefixo}DATA_ALTERACAO"])) : null;
        !empty($array["{$prefixo}USUARIO_INCLUSAO"]) ? $this->setUsuarioInclusao(trim($array["{$prefixo}USUARIO_INCLUSAO"])) : null;
        !empty($array["{$prefixo}USUARIO_ALTERACAO"]) ? $this->setUsuarioAlteracao(trim($array["{$prefixo}USUARIO_ALTERACAO"])) : null;        
        !empty($array["{$prefixo}EXCLUIDO"]) ? $this->setExcluido(trim($array["{$prefixo}EXCLUIDO"])) : null;        
    }

}
