<?php

namespace core\vo\framework;

use core\vo\AbstractVO;

/**
 * Classe de modelo referente a Framework
 * @access public
 * @package core
 * @subpackage vo
 * 
 */
class FrameworkVO extends AbstractVO {

    private $id;
    private $ultimoAcesso;
    private $totalAcesso;
    private $fotoPerfil;
    private $usuario;

    public function getId() {
        return $this->id;
    }

    public function getUltimoAcesso() {
        return $this->ultimoAcesso;
    }

    public function getTotalAcesso() {
        return $this->totalAcesso;
    }

    public function getFotoPerfil() {
        return $this->fotoPerfil;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUltimoAcesso($ultimoAcesso) {
        $this->ultimoAcesso = $ultimoAcesso;
    }

    public function setTotalAcesso($totalAcesso) {
        $this->totalAcesso = $totalAcesso;
    }

    public function setFotoPerfil($fotoPerfil) {
        $this->fotoPerfil = $fotoPerfil;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function bind($array, $prefixo = "") {

        !empty($array["{$prefixo}ID_FRAMEWORK_CONF"]) ? $this->setId(trim($array["{$prefixo}ID_FRAMEWORK_CONF"])) : null;
        !empty($array["{$prefixo}USUARIO"]) ? $this->setUsuario(trim($array["{$prefixo}USUARIO"])) : null;
        !empty($array["{$prefixo}FOTO_PERFIL"]) ? $this->setFotoPerfil(trim($array["{$prefixo}FOTO_PERFIL"])) : null;
        !empty($array["{$prefixo}ULTIMO_ACESSO"]) ? $this->setUltimoAcesso(trim($array["{$prefixo}ULTIMO_ACESSO"])) : null;
        isset($array["{$prefixo}TOTAL_ACESSO"]) ? $this->setTotalAcesso(trim($array["{$prefixo}TOTAL_ACESSO"])) : null;

        !empty($array["{$prefixo}DATA_INCLUSAO"]) ? $this->setDataInclusao(trim($array["{$prefixo}DATA_INCLUSAO"])) : null;
        !empty($array["{$prefixo}DATA_ALTERACAO"]) ? $this->setDataAlteracao(trim($array["{$prefixo}DATA_ALTERACAO"])) : null;
        !empty($array["{$prefixo}USUARIO_INCLUSAO"]) ? $this->setUsuarioInclusao(trim($array["{$prefixo}USUARIO_INCLUSAO"])) : null;
        !empty($array["{$prefixo}USUARIO_ALTERACAO"]) ? $this->setUsuarioAlteracao(trim($array["{$prefixo}USUARIO_ALTERACAO"])) : null;
        isset($array["{$prefixo}EXCLUIDO"]) ? $this->setExcluido(trim($array["{$prefixo}EXCLUIDO"])) : null;
    }

}
