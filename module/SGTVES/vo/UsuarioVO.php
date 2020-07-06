<?php

namespace module\SGTVES\vo;

use core\vo\AbstractVO;

class UsuarioVO extends AbstractVO {

    private $id;
    private $users;
    private $password;
    private $nameUsers;
    private $statusUsers;

    public function __construct() {
        parent::__construct();
        // $this->idSetor = new SetorVO();
    }

    function getId() {
        return $this->id;
    }

    function getUsers() {
        return $this->users;
    }
    
    function getPassword() {
        return $this->password;
    }

    function getNameUsers() {
        return $this->nameUsers;
    }

    function getStatusUsers() {
        return $this->statusUsers;
    }


    function setId($id) {
        $this->id = $id;
    }

    function setUsers($users) {
        $this->users = $users;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setNameUsers($nameUsers) {
        $this->nameUsers = $nameUsers;
    }

    function setStatusUsers($statusUsers) {
        $this->statusUsers = $statusUsers;
    }

    
    public function bind($array, $prefixo = "") {
        !empty($array["{$prefixo}ID_USERS"]) ? $this->setId(trim($array["{$prefixo}ID_USERS"])) : null;
        !empty($array["{$prefixo}USERS"]) ? $this->setUsers(trim($array["{$prefixo}USERS"])) : null;
        !empty($array["{$prefixo}PASSWORD"]) ? $this->setPassword(trim($array["{$prefixo}PASSWORD"])) : null;
        !empty($array["{$prefixo}NAMEUSERS"]) ? $this->setNameUsers(trim($array["{$prefixo}NAMEUSERS"])) : null;
        !empty($array["{$prefixo}STATUSUSERS"]) ? $this->setStatusUsers(trim($array["{$prefixo}STATUSUSERS"])) : null;

        !empty($array["{$prefixo}usuario_inclusao"]) ? $this->setUsuarioInclusao(trim($array["{$prefixo}usuario_inclusao"])) : null;
        !empty($array["{$prefixo}usuario_alteracao"]) ? $this->setUsuarioAlteracao(trim($array["{$prefixo}usuario_alteracao"])) : null;
        !empty($array["{$prefixo}data_inclusao"]) ? $this->setDataInclusao(trim($array["{$prefixo}data_inclusao"])) : null;
        !empty($array["{$prefixo}data_alteracao"]) ? $this->setDataAlteracao(trim($array["{$prefixo}data_alteracao"])) : null;
        !empty($array["{$prefixo}excluido"]) ? $this->setExcluido(trim($array["{$prefixo}excluido"])) : null;
    }

}