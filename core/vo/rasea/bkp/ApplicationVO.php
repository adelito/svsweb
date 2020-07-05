<?php

namespace core\vo\rasea;

class ApplicationVO {

    private $description;
    private $id;
    private $name;
    
    
    function getDescription() {
        return $this->description;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }


}

	