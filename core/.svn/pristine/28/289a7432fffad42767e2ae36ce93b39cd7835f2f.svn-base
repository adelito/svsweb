<?php

namespace core\exception;

use Exception;

/**
 * Classe de Exceção de Aplicação
 * @package core
 * @subpackage exception
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
class AppException extends Exception {

    public function __construct($msg) {
        parent::__construct($msg);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}
