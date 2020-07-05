<?php

namespace module\pessoa\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use core\vo\pessoa\EmailVO;

/**
 * Classe de persistência referente a E-mail
 * @access public
 * @package core
 * @subpackage dao
 */
class EmailDAO extends AbstractDAO {

    /**
     * Método que realiza a listagem de e-mails ativos
     * @param EmailVO $objEmailVO
     * @return ArrayIterator
     * @throws Exception Em caso de erro de banco de dados
     */
    public function listar(EmailVO $objEmailVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objDaoHelper = new DaoHelper();

        try {

            /**
             *  Obtendo conexao
             */
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

            /**
             *  Comando SQL
             */
            $objDaoHelper->setSql("SELECT  ID_EMAIL,
                                    ID_TIPO_EMAIL,
                                    ID_PESSOA,
                                    MODIFICADO_EM,
                                    EXCLUIDO, ENDERECO
                                    FROM  PESSOA.EMAIL
                                    WHERE EXCLUIDO = :EXCLUIDO
                                    AND (ID_TIPO_TELEFONE = :ID_TIPO_TELEFONE OR :ID_TIPO_TELEFONE IS NULL)
                                    AND (ID_PESSOA = :ID_PESSOA OR :ID_PESSOA IS NULL)
                                    AND (ENDERECO = :ENDERECO OR :ENDERECO IS NULL)");

            /**
             *  Atribuindo valores
             */
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);
            $objDaoHelper->bindValue(":ID_TIPO_TELEFONE", $objEmailVO->getIdTipoEmail()->getId());

            /**
             *  Executando comando
             */
            $objDaoHelper->execute();

            /**
             *  Construindo resultado
             */
            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->fetchAll() as $Email) {

                $objEmailVO = new EmailVO();

                $objEmailVO->bind($Email);

                $arrayIterator->append($objEmailVO);
            }

            $objDaoHelper->setRetornoOperacao($arrayIterator);

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

    /**
     * Método que realiza a seleção de um determinado e-mail
     * @param EmailVO $objEmailVO
     * @return EmailVO
     * @throws Exception Em caso de erro de banco de dados
     */
    public function selecionar(EmailVO $objEmailVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objDaoHelper = new DaoHelper();

        try {

            /**
             *  Obtendo conexao
             */
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

            /**
             *  Comando SQL
             */
            $objDaoHelper->setSql("SELECT ID_EMAIL,ID_TIPO_EMAIL, ID_PESSOA, ENDERECO EXCLUIDO
                                    FROM PESSOA.EMAIL
                                   WHERE EXCLUIDO  = :EXCLUIDO 
                                   AND ID_EMAIL    = :ID_EMAIL");

            /**
             *  Atribuindo valores
             */
            $objDaoHelper->bindValue(":EXCLUIDO", 0);
            $objDaoHelper->bindValue(":ID_EMAIL", $objEmailVO->getId(), false);

            /**
             *  Executando comando
             */
            $objDaoHelper->execute();

            /**
             *  Construindo resultado
             */
            foreach ($objDaoHelper->fetchAll() as $Email) {

                $objEmailVO = new EmailVO();

                $objEmailVO->bind($Email);
            }

            $objDaoHelper->setRetornoOperacao($objEmailVO);

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

    /**
     * Método que realiza a inclusão de um e-mail
     * @param EmailVO $objEmailVO
     * @return boolean
     * @throws Exception Em caso de erro de banco de dados
     */
    public function inserir(EmailVO $objEmailVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objDaoHelper = new DaoHelper();

        try {

            /**
             *  Obtendo conexao
             */
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));


            /**
             *  Execução da sequence para obter próximo valor
             */
            $objEmailVO->setId($this->getSequenceNextVal("PESSOA.SEQ_EMAIL", $objDaoHelper->getConexao()));

            /**
             *  Comando SQL
             */
            $objDaoHelper->setSql("INSERT INTO PESSOA.EMAIL
                                (ID_EMAIL,
                                 ID_TIPO_EMAIL,
                                 ID_PESSOA,
                                 MODIFICADO_EM,
                                 ENDERECO,
                                 EXCLUIDO)
                                     VALUES (
                                 :ID_EMAIL,
                                 :ID_TIPO_EMAIL,
                                 :ID_PESSOA,
                                 :MODIFICADO_EM,
                                 :ENDERECO,
                                 :EXCLUIDO)");

            /**
             *  Atribuindo valores
             */
            $objDaoHelper->bindValue(":ID_EMAIL", $objEmailVO->getId());
            $objDaoHelper->bindValue(":ID_TIPO_TELEFONE", $objEmailVO->getIdTipoEmail()->getId());
            $objDaoHelper->bindValue(":ID_PESSOA", $objEmailVO->getIdPessoa()->getId());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objEmailVO->getModificadoEm());
            $objDaoHelper->bindValue(":ENDERECO", $objEmailVO->getEndereco());
            $objDaoHelper->bindValue(":EXCLUIDO", 0);

            /**
             *  Executando comando
             */
            $objDaoHelper->execute();

            /**
             *  Construindo resultado
             */
            $objDaoHelper->setRetornoOperacao(TRUE);

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

    /**
     * Método que realiza alteração de um e-mail
     * @param EmailVO $objEmailVO
     * @return boolean
     * @throws Exception Em caso de erro de banco de dados
     */
    public function alterar(EmailVO $objEmailVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objDaoHelper = new DaoHelper();

        try {

            /**
             *  Obtendo conexao
             */
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

            /**
             *  Comando SQL
             */
            $objDaoHelper->setSql("UPDATE PESSOA.EMAIL
                                    SET    ID_TIPO_EMAIL        = :ID_TIPO_EMAIL,
                                           ID_PESSOA            = :ID_PESSOA,
                                           ENDERECO             = :ENDERECO,
                                           MODIFICADO_EM        = :MODIFICADO_EM,
                                           EXCLUIDO             = :EXCLUIDO
                                    WHERE  ID_EMAIL             = :ID_EMAIL
                                    ");

            /**
             *  Atribuindo valores
             */
            $objDaoHelper->bindValue(":ID_TIPO_EMAIL", $objEmailVO->getIdTipoEmail()->getId());
            $objDaoHelper->bindValue(":ID_PESSOA", $objEmailVO->getIdPessoa()->getId());
            $objDaoHelper->bindValue(":ENDERECO", $objEmailVO->getEndereco());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objEmailVO->getModificadoEm());
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);
            $objDaoHelper->bindValue(":ID_EMAIL", $objEmailVO->getId(), false);

            /**
             *  Executando comando
             */
            $objDaoHelper->execute();

            /**
             *  Construindo resultado
             */
            $objDaoHelper->setRetornoOperacao(TRUE);

            /**
             *  Fechando conexão
             */
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            // LogHelper::registrar(__CLASS__, __FUNCTION__, $ex->getMessage());
            throw new \Exception($ex->getMessage());
        }

        /**
         *  Retornando resultado
         */
        return $objDaoHelper->getRetorno();
    }

    /**
     * Método que realiza a exclusão de um e-mail
     * @param EmailVO $objEmailVO
     * @return boolean
     * @throws Exception Em caso de erro de banco de dados
     */
    public function excluir(EmailVO $objEmailVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objDaoHelper = new DaoHelper();


        try {

            /**
             *  Obtendo conexao
             */
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

            /**
             *  Comando SQL
             */
            $objDaoHelper->setSql("UPDATE PESSOA.EMAIL
                                    SET    MODIFICADO_EM     = :MODIFICADO_EM,
                                           EXCLUIDO          = :EXCLUIDO,
                                    WHERE  ID_EMAIL          = :ID_EMAIL");


            /**
             *  Atribuindo valores
             */
            $objDaoHelper->bindValue(":ID_EMAIL", $objEmailVO->getId());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objEmailVO->getModificadoEm());
            $objDaoHelper->bindValue(":EXCLUIDO", 1);


            /**
             *  Executando comando
             */
            $objDaoHelper->execute();

            /**
             *  Construindo resultado
             */
            $objDaoHelper->setRetornoOperacao(TRUE);

            /**
             *  Fechando conexão
             */
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            // LogHelper::registrar(__CLASS__, __FUNCTION__, $ex->getMessage());
            throw new \Exception($ex->getMessage());
        }

        /**
         *  Retornando resultado
         */
        return $objDaoHelper->getRetorno();
    }

}
