<?php

namespace core\vo\rasea;

use core\vo\rasea\ApplicationVO;

class ApplicationAssignmentVO {

    private $applicationId;
    private $username;
    
    
    function __construct() {
        $this->applicationId = new ApplicationVO();
    }

    
    function getApplicationId() {
        return $this->applicationId;
    }

    function getUsername() {
        return $this->username;
    }

    function setApplicationId($applicationId) {
        $this->applicationId = $applicationId;
    }

    function setUsername($username) {
        $this->username = $username;
    }

}

