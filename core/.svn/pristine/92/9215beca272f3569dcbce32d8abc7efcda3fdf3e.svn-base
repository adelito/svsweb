<?php

namespace core\vo\pessoa;

use core\vo\AbstractVO;

class LocalidadeVO extends AbstractVO {

    private $id;
    private $flSubclasse;
    private $codigoSrh;
    private $nome;
    private $codigoIbge;
    private $codigoIbgeCompleto;
    private $idPai;

    function __construct() {
        parent::__construct();
    }

    function getId() {
        return $this->id;
    }

    function getFlSubclasse() {
        return $this->flSubclasse;
    }

    function getCodigoSrh() {
        return $this->codigoSrh;
    }

    function getNome() {
        return $this->nome;
    }

    function getCodigoIbge() {
        return $this->codigoIbge;
    }

    function getCodigoIbgeCompleto() {
        return $this->codigoIbgeCompleto;
    }

    function getIdPai() {
        return $this->idPai;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFlSubclasse($flSubclasse) {
        $this->flSubclasse = $flSubclasse;
    }

    function setCodigoSrh($codigoSrh) {
        $this->codigoSrh = $codigoSrh;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCodigoIbge($codigoIbge) {
        $this->codigoIbge = $codigoIbge;
    }

    function setCodigoIbgeCompleto($codigoIbgeCompleto) {
        $this->codigoIbgeCompleto = $codigoIbgeCompleto;
    }

    function setIdPai($idPai) {
        $this->idPai = $idPai;
    }

    function bind($array, $prefixo = "") {
        !empty($array["{$prefixo}ID_LOCALIDADE"]) ? $this->setId(trim($array["{$prefixo}ID_LOCALIDADE"])) : null;
        !empty($array["{$prefixo}CODIGOSRH"]) ? $this->setCodigoSrh(trim($array["{$prefixo}CODIGOSRH"])) : null;
        !empty($array["{$prefixo}FLSUBCLASSE"]) ? $this->setFlSubclasse(trim($array["{$prefixo}FLSUBCLASSE"])) : null;
        !empty($array["{$prefixo}NOME"]) ? $this->setNome(trim($array["{$prefixo}NOME"])) : null;
        !empty($array["{$prefixo}CODIGOIBGE"]) ? $this->setCodigoIbge(trim($array["{$prefixo}CODIGOIBGE"])) : null;
        !empty($array["{$prefixo}CODIGOIBGECOMPLETO"]) ? $this->setCodigoIbgeCompleto(trim($array["{$prefixo}CODIGOIBGECOMPLETO"])) : null;
        !empty($array["{$prefixo}ID_PAI"]) ? $this->setIdPai(trim($array["{$prefixo}ID_PAI"])) : null;

        !empty($array["{$prefixo}MODIFICADO_EM"]) ? $this->setModificadoEm(trim($array["{$prefixo}MODIFICADO_EM"])) : null;
        !empty($array["{$prefixo}EXCLUIDO"]) ? $this->setExcluido(trim($array["{$prefixo}EXCLUIDO"])) : null;
    }

}
