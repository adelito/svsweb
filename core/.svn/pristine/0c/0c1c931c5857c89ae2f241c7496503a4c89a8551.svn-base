<?php

namespace core\dao\framework;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use core\vo\framework\FrameworkVO;

/**
 * Classe de persistência referente a Framework
 * @access public
 * @package core
 * @subpackage dao
 */
class FrameworkDAO extends AbstractDAO {

    /**
     * Método que realiza a listagem de series ativos
     * @param FrameworkVO $objFrameworkVO
     * @return bool
     * @throws Exception Em caso de erro de banco de dados
     */
    public function existeConfiguracaoParaUsuario(FrameworkVO $objFrameworkVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance($objFrameworkVO->getEsquemaTabela()));

            $objDaoHelper->setSql(" SELECT 
                                       COUNT(ID_FRAMEWORK_CONF) AS TOTAL
                                    FROM :ESQUEMA.FRAMEWORK_CONF
                                    WHERE USUARIO = :USUARIO
                                   ");
            // Atribuindo valores
            $objDaoHelper->bindValue(":USUARIO", $objFrameworkVO->getUsuario());
            $objDaoHelper->bindValue(":ESQUEMA", $objFrameworkVO->getEsquemaTabela(), false);

            
            // Executando comando
            $objDaoHelper->execute();

            if ($objDaoHelper->fetch()[0] > 0) { 
                $objDaoHelper->setRetornoOperacao(TRUE);
            }
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        return $objDaoHelper->getRetorno();
    }

    /**
     * Método que cria um registro de configuração inicial para um determinado usuário
     * @param FrameworkVO $objFrameworkVO
     * @return bool
     * @throws Exception Em caso de erro de banco de dados
     */
    public function criarConfiguracaoParaUsuario(FrameworkVO $objFrameworkVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance($objFrameworkVO->getEsquemaTabela()));
            $objFrameworkVO->setId($this->getSequenceNextVal($objFrameworkVO->getEsquemaTabela().".SEQ_FRAMEWORK_CONF", $objDaoHelper->getConexao()));

            $objDaoHelper->setSql(" INSERT INTO :ESQUEMA.FRAMEWORK_CONF (
                                    ID_FRAMEWORK_CONF, USUARIO, DATA_INCLUSAO,  USUARIO_INCLUSAO ) 
                                    VALUES (:ID_FRAMEWORK_CONF, :USUARIO, :DATA_INCLUSAO, :USUARIO_INCLUSAO)");

            // Atribuindo valores
            
            $objDaoHelper->bindValue(":ID_FRAMEWORK_CONF", $objFrameworkVO->getId(), false);
            $objDaoHelper->bindValue(":ESQUEMA", $objFrameworkVO->getEsquemaTabela(), false);
            $objDaoHelper->bindValue(":DATA_INCLUSAO", "SYSDATE", false);
            $objDaoHelper->bindValue(":USUARIO_INCLUSAO", $objFrameworkVO->getUsuario());
            $objDaoHelper->bindValue(":USUARIO", $objFrameworkVO->getUsuario());

            // Executando comando

            $objDaoHelper->execute();
            $objDaoHelper->setRetornoOperacao(TRUE);
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        return $objDaoHelper->getRetorno();
    }

    /**
     * Método que atualiza a foto do perfil de acesso do usuário
     * @param FrameworkVO $objFrameworkVO
     * @return bool
     * @throws Exception Em caso de erro de banco de dados
     */
    public function atualizarFotoPerfil(FrameworkVO $objFrameworkVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance($objFrameworkVO->getEsquemaTabela()));

            $objDaoHelper->setSql(" UPDATE :ESQUEMA.FRAMEWORK_CONF 
                                    SET FOTO_PERFIL = :FOTO_PERFIL, 
                                        DATA_ALTERACAO = :DATA_ALTERACAO,
                                        USUARIO_ALTERACAO = :USUARIO_ALTERACAO
                                    WHERE USUARIO = :USUARIO");

            // Atribuindo valores
            $objDaoHelper->bindValue(":ESQUEMA", $objFrameworkVO->getEsquemaTabela(),false);
            $objDaoHelper->bindValue(":DATA_ALTERACAO", "SYSDATE", false);
            $objDaoHelper->bindValue(":USUARIO_ALTERACAO", $objFrameworkVO->getUsuario());
            $objDaoHelper->bindValue(":FOTO_PERFIL", $objFrameworkVO->getFotoPerfil());
            $objDaoHelper->bindValue(":USUARIO", $objFrameworkVO->getUsuario());
            // Executando comando

            $objDaoHelper->execute();
            $objDaoHelper->setRetornoOperacao(TRUE);

            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        return $objDaoHelper->getRetorno();
    }

    /**
     * Método que realiza a listagem de series ativos
     * @param FrameworkVO $objFrameworkVO
     * @return ArrayIterator
     * @throws Exception Em caso de erro de banco de dados
     */
    public function getConfiguracaoUsuario(FrameworkVO $objFrameworkVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objDaoHelper = new DaoHelper();

        try {
            /**
             *  Obtendo conexao
             */
            $objDaoHelper->setConexao(parent::getInstance($objFrameworkVO->getEsquemaTabela()));

            /**
             *  Comando SQL
             */
            $objDaoHelper->setSql("SELECT 
                                       ID_FRAMEWORK_CONF, USUARIO, ULTIMO_ACESSO, 
                                       TOTAL_ACESSO, EXCLUIDO, DATA_INCLUSAO, 
                                       USUARIO_INCLUSAO, FOTO_PERFIL, DATA_ALTERACAO, 
                                       USUARIO_ALTERACAO
                                    FROM :ESQUEMA.FRAMEWORK_CONF
                                    WHERE USUARIO = :USUARIO
                                    ");

            /**
             *  Atribuindo valores
             */
            $objDaoHelper->bindValue(":USUARIO", $objFrameworkVO->getUsuario());
            $objDaoHelper->bindValue(":ESQUEMA", $objFrameworkVO->getEsquemaTabela(),false);

            
            /**
             *  Executando comando
             */
            $objDaoHelper->execute();

            /**
             *  Construindo resultado
             */
            foreach ($objDaoHelper->fetchAll() as $configuracao) {
                
                $objFrameworkVO = new FrameworkVO();
                $objFrameworkVO->bind($configuracao);
            }
            
            $objDaoHelper->setRetornoOperacao($objFrameworkVO);

            /**
             *  Fechando conexão
             */
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            //LogHelper::registrar(__CLASS__, __FUNCTION__, $ex->getMessage());
            throw new \Exception($ex->getMessage());
        }

        /**
         *  Retornando resultado
         */
        return $objDaoHelper->getRetorno();
    }

}
