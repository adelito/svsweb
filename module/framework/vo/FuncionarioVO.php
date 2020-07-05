<?php

namespace module\framework\vo;

use core\vo\AbstractVO;

class FuncionarioVO extends AbstractVO {

    private $id;
    private $idSetor;
    private $matricula;
    private $nome;
    private $cpf;
    private $telefone;
    private $celular;
    private $tipoUsuario;
    private $senha;
    //TRANSIENTE
    private $execto;

    public function __construct() {
        parent::__construct();
        $this->idSetor = new SetorVO();
    }

    function getId() {
        return $this->id;
    }

    function getIdSetor() {
        return $this->idSetor;
    }

    function getMatricula() {
        return $this->matricula;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getCelular() {
        return $this->celular;
    }

    function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdSetor($idSetor) {
        $this->idSetor = $idSetor;
    }

    function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function getExecto() {
        return $this->execto;
    }

    public function setExecto($execto) {
        $this->execto = $execto;
    }
    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    
    public function bind($array, $prefixo = "") {
        !empty($array["{$prefixo}id_funcionario_usuario"]) ? $this->setId(trim($array["{$prefixo}id_funcionario_usuario"])) : null;
        !empty($array["{$prefixo}id_setor"]) ? $this->getIdSetor()->setId(trim($array["{$prefixo}id_setor"])) : null; # FK #
        !empty($array["{$prefixo}matricula"]) ? $this->setMatricula(trim($array["{$prefixo}matricula"])) : null;
        !empty($array["{$prefixo}nome"]) ? $this->setNome(trim($array["{$prefixo}nome"])) : null;
        !empty($array["{$prefixo}cpf"]) ? $this->setCpf(trim($array["{$prefixo}cpf"])) : null;
        !empty($array["{$prefixo}telefone"]) ? $this->setTelefone(trim($array["{$prefixo}telefone"])) : null;
        !empty($array["{$prefixo}celular"]) ? $this->setCelular(trim($array["{$prefixo}celular"])) : null;
        !empty($array["{$prefixo}tipo_usuario"]) ? $this->setTipoUsuario(trim($array["{$prefixo}tipo_usuario"])) : null;
        !empty($array["{$prefixo}passoword"]) ? $this->setSenha(trim($array["{$prefixo}passoword"])) : null;

        !empty($array["{$prefixo}usuario_inclusao"]) ? $this->setUsuarioInclusao(trim($array["{$prefixo}usuario_inclusao"])) : null;
        !empty($array["{$prefixo}usuario_alteracao"]) ? $this->setUsuarioAlteracao(trim($array["{$prefixo}usuario_alteracao"])) : null;
        !empty($array["{$prefixo}data_inclusao"]) ? $this->setDataInclusao(trim($array["{$prefixo}data_inclusao"])) : null;
        !empty($array["{$prefixo}data_alteracao"]) ? $this->setDataAlteracao(trim($array["{$prefixo}data_alteracao"])) : null;
        !empty($array["{$prefixo}excluido"]) ? $this->setExcluido(trim($array["{$prefixo}excluido"])) : null;
    }

}
