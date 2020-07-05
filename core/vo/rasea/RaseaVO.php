<?php

namespace core\vo\rasea;

class RaseaVO {

    private $usuarioNome;
    private $usuarioEmail;
    private $usuarioLogin;
    private $aplicacaoNome;
    private $aplicacaoId;
    private $recursoNome;
    private $recursoId;
    private $acaoNome;
    private $acaoId;
    private $permitido;
    private $usuarioSenha;
    private $perfilDescricao;
    private $perfilNome;
    private $perfilId;

    /* Transient */
    private $novaSenha;
    private $novaSenhaConfirmacao;
    private $dadosRasea;

    public function __construct() {
        $this->recuperaSenha = FALSE;
    }

    public function getRecuperaSenha() {
        return $this->recuperaSenha;
    }

    public function setRecuperaSenha($recuperaSenha) {
        return $this->recuperaSenha = $recuperaSenha;
    }

    public function getNovaSenha() {
        return $this->novaSenha;
    }

    public function getNovaSenhaConfirmacao() {
        return $this->novaSenhaConfirmacao;
    }

    public function setNovaSenha($novaSenha) {
        $this->novaSenha = $novaSenha;
    }

    public function setNovaSenhaConfirmacao($novaSenhaConfirmacao) {
        $this->novaSenhaConfirmacao = $novaSenhaConfirmacao;
    }

    public function getPerfilDescricao() {
        return $this->perfilDescricao;
    }

    public function getPerfilNome() {
        return $this->perfilNome;
    }

    public function setPerfilDescricao($perfilDescricao) {
        $this->perfilDescricao = $perfilDescricao;
    }

    public function setPerfilNome($perfilNome) {
        $this->perfilNome = $perfilNome;
    }

    function getUsuarioEmail() {
        return $this->usuarioEmail;
    }

    function setUsuarioEmail($usuarioEmail) {
        $this->usuarioEmail = $usuarioEmail;
    }

    public function getUsuarioNome() {
        return $this->usuarioNome;
    }

    public function getUsuarioLogin() {
        return $this->usuarioLogin;
    }

    public function getAplicacaoNome() {
        return $this->aplicacaoNome;
    }

    public function getAplicacaoId() {
        return $this->aplicacaoId;
    }

    public function getRecursoNome() {
        return $this->recursoNome;
    }

    public function getRecursoId() {
        return $this->recursoId;
    }

    public function getAcaoNome() {
        return $this->acaoNome;
    }

    public function getAcaoId() {
        return $this->acaoId;
    }

    public function getPermitido() {
        return $this->permitido;
    }

    public function getUsuarioSenha() {
        return $this->usuarioSenha;
    }

    public function getPerfilId() {
        return $this->perfilId;
    }

    public function setUsuarioNome($usuarioNome) {
        $this->usuarioNome = $usuarioNome;
    }

    public function setUsuarioLogin($usuarioLogin) {
        $this->usuarioLogin = $usuarioLogin;
    }

    public function setAplicacaoNome($aplicacaoNome) {
        $this->aplicacaoNome = $aplicacaoNome;
    }

    public function setAplicacaoId($aplicacaoId) {
        $this->aplicacaoId = $aplicacaoId;
    }

    public function setRecursoNome($recursoNome) {
        $this->recursoNome = $recursoNome;
    }

    public function setRecursoId($recursoId) {
        $this->recursoId = $recursoId;
    }

    public function setAcaoNome($acaoNome) {
        $this->acaoNome = $acaoNome;
    }

    public function setAcaoId($acaoId) {
        $this->acaoId = $acaoId;
    }

    public function setPermitido($permitido) {
        $this->permitido = $permitido;
    }

    public function setUsuarioSenha($usuarioSenha) {
        $this->usuarioSenha = $usuarioSenha;
    }

    public function setPerfilId($perfilId) {
        $this->perfilId = $perfilId;
    }

    /**
     * @return mixed
     */
    public function getDadosRasea()
    {
        return $this->dadosRasea;
    }

    /**
     * @param mixed $dadosRasea
     */
    public function setDadosRasea($dadosRasea)
    {
        $this->dadosRasea = $dadosRasea;
    }

    public function bind($array, $prefixo = "") {
        !empty($array["{$prefixo}USUARIO_LOGIN"]) ? $this->setUsuarioLogin(trim($array["{$prefixo}USUARIO_LOGIN"])) : null;
        !empty($array["{$prefixo}USUARIO_NOME"]) ? $this->setUsuarioNome(trim($array["{$prefixo}USUARIO_NOME"])) : null;
        !empty($array["{$prefixo}USUARIO_EMAIL"]) ? $this->setUsuarioEmail(trim($array["{$prefixo}USUARIO_EMAIL"])) : null;
        !empty($array["{$prefixo}APLICACAO_NOME"]) ? $this->setAplicacaoNome(trim($array["{$prefixo}APLICACAO_NOME"])) : null;
        !empty($array["{$prefixo}APLICACAO_ID"]) ? $this->setAplicacaoId(trim($array["{$prefixo}APLICACAO_ID"])) : null;
        !empty($array["{$prefixo}RECURSO_NOME"]) ? $this->setRecursoNome(trim($array["{$prefixo}RECURSO_NOME"])) : null;
        !empty($array["{$prefixo}RECURSO_ID"]) ? $this->setRecursoId(trim($array["{$prefixo}RECURSO_ID"])) : null;
        !empty($array["{$prefixo}ACAO_NOME"]) ? $this->setAcaoNome(trim($array["{$prefixo}ACAO_NOME"])) : null;
        !empty($array["{$prefixo}ACAO_ID"]) ? $this->setAcaoId(trim($array["{$prefixo}ACAO_ID"])) : null;
        !empty($array["{$prefixo}PERMITIDO"]) ? $this->setPermitido(trim($array["{$prefixo}PERMITIDO"])) : null;
        !empty($array["{$prefixo}PERFIL_NOME"]) ? $this->setPerfilNome(trim($array["{$prefixo}PERFIL_NOME"])) : null;
        !empty($array["{$prefixo}PERFIL_DESCRICAO"]) ? $this->setPerfilDescricao(trim($array["{$prefixo}PERFIL_DESCRICAO"])) : null;
        !empty($array["{$prefixo}ROLE_ID"]) ? $this->setPerfilId(trim($array["{$prefixo}ROLE_ID"])) : null;
        !empty($array["{$prefixo}APPLICATION_ID"]) ? $this->setAplicacaoId(trim($array["{$prefixo}APPLICATION_ID"])) : null;
    }

}
