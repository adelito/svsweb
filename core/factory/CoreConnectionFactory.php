<?php

namespace core\factory;

use core\implementation\DbRaseaHomologacaoImplementation;
use core\implementation\DbRaseaProducaoImplementation;

use config\SystemConfig;

/**
 * Classe fábrica de Conexão CORE
 * @package core
 * @subpackage factory
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
class CoreConnectionFactory {

    /**
     * Instância de RASEA Homologação
     * @access private
     * @static
     * @var \PDO Instância do banco de dados
     */
    private static $instanciaRaseaHomologacao;

    /**
     * Instância de RASEA Produção
     * @access private
     * @static
     * @var \PDO 
     */
    private static $instanciaRaseaProducao;

    /**
     * Retorna a instância de um banco de dados de acordo com o que foi solicitado
     * @access public
     * @static
     * @param string Nome da instância
     * @return \PDO Instância do banco de dados solicitado
     */
    public static function getInstance($db) {

        $db = strtoupper($db . "_" . SystemConfig::ENVIRONMENT);

        switch ($db) {
            case "RASEA_DESENVOLVIMENTO":
                if (!isset(self::$instanciaRaseaHomologacao)) {
                    self::$instanciaRaseaHomologacao = DbRaseaHomologacaoImplementation::connect();
                }
                return self::$instanciaRaseaHomologacao;
                break;

            case "RASEA_HOMOLOGACAO":
                if (!isset(self::$instanciaRaseaHomologacao)) {
                    self::$instanciaRaseaHomologacao = DbRaseaHomologacaoImplementation::connect();
                }
                return self::$instanciaRaseaHomologacao;
                break;

            case "RASEA_PRODUCAO":
                if (!isset(self::$instanciaRaseaProducao)) {
                    self::$instanciaRaseaProducao = DbRaseaProducaoImplementation::connect();
                }
                return self::$instanciaRaseaProducao;
                break;
            default :
                die('INSTANCIA NAO EXISTE');
                break;
        }

        return NULL;
    }

}

?>