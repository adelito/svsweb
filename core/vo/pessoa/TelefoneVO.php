<?php

namespace core\vo\pessoa;

use core\vo\AbstractVO;
use core\vo\contato\TipoTelefoneVO;
use core\vo\pessoa\PessoaVO;

class TelefoneVO extends AbstractVO {

    private $id;
    private $idTipoTelefone;
    private $idPessoa;
    private $ddd;
    private $numero;

    function __construct() {
        parent::__construct();

        $this->idTipoTelefone = TipoTelefoneVO();
        $this->idPessoa = PessoaVO();
    }

    function getId() {
        return $this->id;
    }

    function getIdTipoTelefone() {
        return $this->idTipoTelefone;
    }

    function getIdPessoa() {
        return $this->idPessoa;
    }

    function getDdd() {
        return $this->ddd;
    }

    function getNumero() {
        return $this->numero;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdTipoTelefone($idTipoTelefone) {
        $this->idTipoTelefone = $idTipoTelefone;
    }

    function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    function setDdd($ddd) {
        $this->ddd = $ddd;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    
    public function bind($array, $prefixo = "") {
        !empty($array["{$prefixo}ID_TELEFONE"]) ? $this->setId(trim($array["{$prefixo}ID_TELEFONE"])) : null;
        !empty($array["{$prefixo}ID_TIPO_TELEFONE"]) ? $this->setIdTipoTelefone(trim($array["{$prefixo}ID_TIPO_TELEFONE"])) : null;
        !empty($array["{$prefixo}ID_PESSOA"]) ? $this->setIdPessoa(trim($array["{$prefixo}ID_PESSOA"])) : null;
        !empty($array["{$prefixo}DDD"]) ? $this->setDdd(trim($array["{$prefixo}DDD"])) : null;
        !empty($array["{$prefixo}NUMERO"]) ? $this->setNumero(trim($array["{$prefixo}NUMERO"])) : null;

        !empty($array["{$prefixo}MODIFICADO_EM"]) ? $this->setModificadoEm(trim($array["{$prefixo}MODIFICADO_EM"])) : null;
        !empty($array["{$prefixo}EXCLUIDO"]) ? $this->setExcluido(trim($array["{$prefixo}EXCLUIDO"])) : null;
    }

}
