<?php

namespace core\vo\rasea;

class UserVO {

    private $alternateEmail;
    private $cpf;
    private $dataLogin;
    private $dateChgPass;
    private $dddTelefone;
    private $displayname;
    private $email;
    private $enabled;
    private $password;
    private $telefone;
    private $username;
    
    
    function getAlternateEmail() {
        return $this->alternateEmail;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getDataLogin() {
        return $this->dataLogin;
    }

    function getDateChgPass() {
        return $this->dateChgPass;
    }

    function getDddTelefone() {
        return $this->dddTelefone;
    }

    function getDisplayname() {
        return $this->displayname;
    }

    function getEmail() {
        return $this->email;
    }

    function getEnabled() {
        return $this->enabled;
    }

    function getPassword() {
        return $this->password;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getUsername() {
        return $this->username;
    }

    function setAlternateEmail($alternateEmail) {
        $this->alternateEmail = $alternateEmail;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setDataLogin($dataLogin) {
        $this->dataLogin = $dataLogin;
    }

    function setDateChgPass($dateChgPass) {
        $this->dateChgPass = $dateChgPass;
    }

    function setDddTelefone($dddTelefone) {
        $this->dddTelefone = $dddTelefone;
    }

    function setDisplayname($displayname) {
        $this->displayname = $displayname;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setUsername($username) {
        $this->username = $username;
    }

}
