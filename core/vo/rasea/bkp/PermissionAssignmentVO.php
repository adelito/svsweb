<?php

namespace core\vo\teste;
use core\vo\rasea\OperationVO;
use core\vo\rasea\ResourceVO;

class permissionAssignmentVO {

    private $id;
    private $allowed;
    private $descricao;
    private $idUser;
    private $operationId;
    private $resourceId;
    private $roleId;
    
    function __construct() {
        $this->operationId = new OperationVO;
        $this->resourceId = new ResourceVO();
    }

    function getId() {
        return $this->id;
    }

    function getAllowed() {
        return $this->allowed;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getIdUser() {
        return $this->idUser;
    }

    function getOperationId() {
        return $this->operationId;
    }

    function getResourceId() {
        return $this->resourceId;
    }

    function getRoleId() {
        return $this->roleId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAllowed($allowed) {
        $this->allowed = $allowed;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    function setOperationId($operationId) {
        $this->operationId = $operationId;
    }

    function setResourceId($resourceId) {
        $this->resourceId = $resourceId;
    }

    function setRoleId($roleId) {
        $this->roleId = $roleId;
    }


}
