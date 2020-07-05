<?php

namespace module\pessoa\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use core\vo\pessoa\TipoEmailVO;

/**
 * Classe de persistencia TipoEmail
 */
class TipoEmailDAO extends AbstractDAO {

    /**
     * @param void
     * @return ArrayIterator
     * @access public
     */
    public function listar($objTipoEmailVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));
            $aux = "";
            if (!is_null($objTipoEmailVO)) {
                if (strlen($objTipoEmailVO->getDescricao()) > 0) {
                    $aux .= "AND DESCRICAO = :DESCRICAO";
                }
            }
// Comando SQL

            $objDaoHelper->setSql("SELECT ID_TIPO_EMAIL, DESCRICAO
                                    FROM
                                    PESSOA.TIPO_EMAIL
                                    WHERE EXCLUIDO = :EXCLUIDO
                                   $aux");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);

            if (!is_null($objTipoEmailVO)) {
                if (strlen($objTipoEmailVO->getDescricao()) > 0) {
                    $objDaoHelper->bindValue(":DESCRICAO", $objTipoEmailVO->getDescricao());
                }
            }

// Executando comando
            $objDaoHelper->execute();

// Instanciando classes de apoio
            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->fetchAll() as $TipoEmail) {

                $objTipoEmailVO = new TipoEmailVO();

                $objTipoEmailVO->bind($TipoEmail);

                $arrayIterator->append($objTipoEmailVO);
            }

            $objDaoHelper->setRetornoOperacao($arrayIterator);
//Fechando conexão
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
//      LogHelper::registrar(__CLASS__, __FUNCTION__, $ex->getMessage());
            throw new \Exception($ex->getMessage());
        }


// Retornando resposta
        return $objDaoHelper->getRetorno();
    }

    /**
     * @param TipoEmailVO $objTipoEmailVO
     * @return boolean
     * @access public
     */
    public function inserir($objTipoEmailVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

//Setando Id do grupo
            $objTipoEmailVO->setId($this->getSequenceNextVal("PESSOA.SEQ_TIPO_EMAIL", $objDaoHelper->getConexao()));

// Comando SQL
            $objDaoHelper->setSql("INSERT INTO PESSOA.TIPO_EMAIL (ID_TIPO_EMAIL, DESCRICAO, MODIFICADO_EM, EXCLUIDO) 
                                 VALUES (
                                 :ID_TIPO_EMAIL,
                                 :DESCRICAO,
                                 :MODIFICADO_EM,
                                 :EXCLUIDO
                                 )");

// Atribuindo valores

            $objDaoHelper->bindValue(":ID_TIPO_EMAIL", $objTipoEmailVO->getId());
            $objDaoHelper->bindValue(":DESCRICAO", $objTipoEmailVO->getDescricao());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTipoEmailVO->getModificadoEm());
            $objDaoHelper->bindValue(":EXCLUIDO", 0);

// Executando comando
            $objDaoHelper->execute();

// Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE.
            $objDaoHelper->setRetornoOperacao(TRUE);

//Fechando conexão
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
//      LogHelper::registrar(__CLASS__, __FUNCTION__, $ex->getMessage());
            throw new \Exception($ex->getMessage());
        }


// Retornando resposta
        return $objDaoHelper->getRetorno();
    }

    /**
     * @param TipoEmailVO $objTipoEmailVO
     * @return mixed
     * @access public
     */
    public function alterar($objTipoEmailVO) {

        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE PESSOA.TIPO_EMAIL
                                    SET    DESCRICAO              = :DESCRICAO,
                                           MODIFICADO_EM          = :MODIFICADO_EM
                                    WHERE  ID_TIPO_EMAIL          = :ID_TIPO_EMAIL
                                    ");

// Atribuindo valores
            $objDaoHelper->bindValue(":DESCRICAO", $objTipoEmailVO->getDescricao());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTipoEmailVO->getModificadoEm());
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);
            $objDaoHelper->bindValue(":ID_TIPO_EMAIL", $objTipoEmailVO->getId(), false);

// Executando comando
            $objDaoHelper->execute();

// Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE.
            $objDaoHelper->setRetornoOperacao(TRUE);

//Fechando conexão
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
//      LogHelper::registrar(__CLASS__, __FUNCTION__, $ex->getMessage());
            throw new \Exception($ex->getMessage());
        }


// Retornando resposta
        return $objDaoHelper->getRetorno();
    }

    /**
     * @param TipoEmailVO $objTipoEmailVO
     * @return boolean
     * @access public
     */
    public function excluir($objTipoEmailVO) {


        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE PESSOA.TIPO_EMAIL
                                    SET    MODIFICADO_EM     = :MODIFICADO_EM,
                                           EXCLUIDO          = :EXCLUIDO,
                                    WHERE  ID_TIPO_EMAIL   = :ID_TIPO_EMAIL");


// Atribuindo valores
            $objDaoHelper->bindValue(":ID_TIPO_EMAIL", $objTipoEmailVO->getId());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTipoEmailVO->getModificadoEm());
            $objDaoHelper->bindValue(":EXCLUIDO", 1);


// Executando comando
            $objDaoHelper->execute();

// Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE.
            $objDaoHelper->setRetornoOperacao(TRUE);

//Fechando conexão
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
//      LogHelper::registrar(__CLASS__, __FUNCTION__, $ex->getMessage());
            throw new \Exception($ex->getMessage());
        }


// Retornando resposta
        return $objDaoHelper->getRetorno();
    }

    /**
     * @param TipoEmailVO $objTipoEmailVO
     * @return boolean
     * @access public
     */
    public function selecionar($objTipoEmailVO) {


        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("SELECT ID_TIPO_EMAIL, DESCRICAO, EXCLUIDO
                                    FROM PESSOA.TIPO_EMAIL
                                   WHERE EXCLUIDO  = :EXCLUIDO 
                                   AND ID_TIPO_EMAIL = :ID_TIPO_EMAIL");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0);
            $objDaoHelper->bindValue(":ID_TIPO_EMAIL", $objTipoEmailVO->getId(), false);

// Executando comando
            $objDaoHelper->execute();

// Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE.
            foreach ($objDaoHelper->fetchAll() as $TipoEmail) {

                $objTipoEmailVO = new TipoEmailVO();

                $objTipoEmailVO->bind($TipoEmail);
            }

            $objDaoHelper->setRetornoOperacao($objTipoEmailVO);

//Fechando conexão
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
//      LogHelper::registrar(__CLASS__, __FUNCTION__, $ex->getMessage());
            throw new \Exception($ex->getMessage());
        }


// Retornando resposta
        return $objDaoHelper->getRetorno();
    }

}
