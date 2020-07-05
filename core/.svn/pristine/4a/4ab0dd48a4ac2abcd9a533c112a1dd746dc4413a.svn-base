<?php

namespace core\dao;

use core\helper\DaoHelper;
use module\sistema\factory\ConnectionFactory;

/**
 * Classe de abstração Data Access Object
 * @package core
 * @subpackage dao
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
abstract class AbstractDAO extends ConnectionFactory {

    /**
     * Método retorna uma nova instância do DaoHelper
     * @final
     * @access protected
     * @param void
     * @return DaoHelper
     */
    final protected function getNewInstanceDaoHelper() {
        return new DaoHelper();
    }

    /**
     * Metodo que captura o próximo valor da sequência
     * @final
     * @access protected
     * @param string $sequence Nome da Sequencia
     * @return integer Valor da sequência
     */
    final protected function getSequenceNextVal($sequence, $instanceDb,$autocommit = false) {

        $objDaoHelper = new DaoHelper();

        try {
            // Obtendo conexao
            $objDaoHelper->setConexao($instanceDb);

            // Comando SQL
            $objDaoHelper->setSql("SELECT " . $sequence . ".NEXTVAL FROM DUAL");

            // Preparando
//            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));
            // Executando comando
            $objDaoHelper->execute($autocommit);

            return $objDaoHelper->fetch()[0];
        } catch (Exception $ex) {
            //      LogHelper::registrar(__CLASS__, __FUNCTION__, $ex->getMessage());
            throw new \Exception($ex->getMessage());
        }
    }

}
