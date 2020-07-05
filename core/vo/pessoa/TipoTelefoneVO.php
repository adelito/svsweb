<?php

namespace core\vo\pessoa;

use core\vo\AbstractVO;

class TipoTelefoneVO extends AbstractVO {

    private $id;
    private $descricao;

    function __construct() {
        parent::__construct();
    }

    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function bind($array, $prefixo = "") {
        !empty($array["{$prefixo}ID_TIPO_TELEFONE"]) ? $this->setId(trim($array["{$prefixo}ID_TIPO_TELEFONE"])) : null;
        !empty($array["{$prefixo}DESCRICAO"]) ? $this->setDescricao(trim($array["{$prefixo}DESCRICAO"])) : null;

        !empty($array["{$prefixo}MODIFICADO_EM"]) ? $this->setModificadoEm(trim($array["{$prefixo}MODIFICADO_EM"])) : null;
        !empty($array["{$prefixo}EXCLUIDO"]) ? $this->setExcluido(trim($array["{$prefixo}EXCLUIDO"])) : null;
    }

}
