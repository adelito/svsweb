<?php

namespace core\vo\rasea;

class ResourceVO {

    private $id;
    private $name;
    private $description;
    private $applicationId;

    function __construct() {
        $this->applicationId = new ApplicationVO();
    }
    
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getApplicationId() {
        return $this->applicationId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setApplicationId($applicationId) {
        $this->applicationId = $applicationId;
    }





}
