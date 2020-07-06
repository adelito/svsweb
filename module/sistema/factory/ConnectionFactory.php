<?php

namespace module\sistema\factory;

use module\sistema\implementation\DbFrameworkDesenvolvimentoImplementation;
use module\sistema\implementation\DbFrameworkHomologacaoImplementation;
use module\sistema\implementation\DbFrameworkProducaoImplementation;
use core\factory\CoreConnectionFactory;
use config\SystemConfig;

class ConnectionFactory extends CoreConnectionFactory {

    private static $instanciaFrameworkDesenvolvimento;
    private static $instanciaFrameworkHomologacao;
    private static $instanciaFrameworkProducao;
  

    public static function getInstance($db) {

//        if(!is_null(parent::getDefaultInstance())){
//            return parent::getDefaultInstance();
//        }
        
        $db = strtoupper($db . "_" . SystemConfig::ENVIRONMENT);

        switch ($db) {
            case "TESTE_DESENVOLVIMENTO":
                if (!isset(self::$instanciaFrameworkDesenvolvimento)) {
                    self::$instanciaFrameworkDesenvolvimento = DbFrameworkDesenvolvimentoImplementation::connect();
                }
                return self::$instanciaFrameworkDesenvolvimento;
                break;

            case "NOVOFRAMEWORK_HOMOLOGACAO":
                if (!isset(self::$instanciaFrameworkHomologacao)) {
                    self::$instanciaFrameworkHomologacao = DbFrameworkHomologacaoImplementation::connect();
                }
                return self::$instanciaFrameworkHomologacao;
                break;

            case "NOVOFRAMEWORK_PRODUCAO":
                if (!isset(self::$instanciaFrameworkProducao)) {
                    self::$instanciaFrameworkProducao = DbFrameworkProducaoImplementation::connect();
                }
                return self::$instanciaFrameworkProducao;
                break;

            default :
                die('INSTANCIA NAO EXISTE');
                break;
        }

        return NULL;
    }

  

}

?>