<?php

namespace module\pessoa\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use core\vo\pessoa\TipoLogradouroVO;

/**
 * Classe de persistencia TipoLogradouro
 */
class TipoLogradouroDAO extends AbstractDAO {

    /**
     * @param void
     * @return ArrayIterator
     * @access public
     */
    public function listar($objTipoLogradouroVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));
            $aux = "";
            if (!is_null($objTipoLogradouroVO)) {
                if (strlen($objTipoLogradouroVO->getDescricao()) > 0) {
                    $aux .= "AND DESCRICAO = :DESCRICAO";
                }
            }
// Comando SQL

            $objDaoHelper->setSql("SELECT ID_TIPO_LOGRADOURO, DESCRICAO
                                    FROM
                                    PESSOA.TIPO_LOGRADOURO
                                    WHERE EXCLUIDO = :EXCLUIDO
                                   $aux");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);

            if (!is_null($objTipoLogradouroVO)) {
                if (strlen($objTipoLogradouroVO->getDescricao()) > 0) {
                    $objDaoHelper->bindValue(":DESCRICAO", $objTipoLogradouroVO->getDescricao());
                }
            }

// Executando comando
            $objDaoHelper->execute();

// Instanciando classes de apoio
            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->fetchAll() as $TipoLogradouro) {

                $objTipoLogradouroVO = new TipoLogradouroVO();

                $objTipoLogradouroVO->bind($TipoLogradouro);

                $arrayIterator->append($objTipoLogradouroVO);
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
     * @param TipoLogradouroVO $objTipoLogradouroVO
     * @return boolean
     * @access public
     */
    public function inserir($objTipoLogradouroVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

//Setando Id do grupo
            $objTipoLogradouroVO->setId($this->getSequenceNextVal("PESSOA.SEQ_TIPO_LOGRADOURO", $objDaoHelper->getConexao()));

// Comando SQL
            $objDaoHelper->setSql("INSERT INTO PESSOA.TIPO_LOGRADOURO (ID_TIPO_LOGRADOURO, DESCRICAO, MODIFICADO_EM, EXCLUIDO) 
                                 VALUES (
                                 :ID_TIPO_LOGRADOURO,
                                 :DESCRICAO,
                                 :MODIFICADO_EM,
                                 :EXCLUIDO
                                 )");

// Atribuindo valores

            $objDaoHelper->bindValue(":ID_TIPO_LOGRADOURO", $objTipoLogradouroVO->getId());
            $objDaoHelper->bindValue(":DESCRICAO", $objTipoLogradouroVO->getDescricao());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTipoLogradouroVO->getModificadoEm());
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
     * @param TipoLogradouroVO $objTipoLogradouroVO
     * @return mixed
     * @access public
     */
    public function alterar($objTipoLogradouroVO) {

        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE PESSOA.TIPO_LOGRADOURO
                                    SET    DESCRICAO              = :DESCRICAO,
                                           MODIFICADO_EM          = :MODIFICADO_EM
                                    WHERE  ID_TIPO_LOGRADOURO     = :ID_TIPO_LOGRADOURO
                                    ");

// Atribuindo valores
            $objDaoHelper->bindValue(":DESCRICAO", $objTipoLogradouroVO->getDescricao());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTipoLogradouroVO->getModificadoEm());
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);
            $objDaoHelper->bindValue(":ID_TIPO_LOGRADOURO", $objTipoLogradouroVO->getId(), false);

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
     * @param TipoLogradouroVO $objTipoLogradouroVO
     * @return boolean
     * @access public
     */
    public function excluir($objTipoLogradouroVO) {


        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE PESSOA.TIPO_LOGRADOURO
                                    SET    MODIFICADO_EM        = :MODIFICADO_EM,
                                           EXCLUIDO             = :EXCLUIDO,
                                    WHERE  ID_TIPO_LOGRADOURO   = :ID_TIPO_LOGRADOURO");


// Atribuindo valores
            $objDaoHelper->bindValue(":ID_TIPO_LOGRADOURO", $objTipoLogradouroVO->getId());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTipoLogradouroVO->getModificadoEm());
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
     * @param TipoLogradouroVO $objTipoLogradouroVO
     * @return boolean
     * @access public
     */
    public function selecionar($objTipoLogradouroVO) {


        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("SELECT ID_TIPO_LOGRADOURO, DESCRICAO, EXCLUIDO
                                    FROM PESSOA.TIPO_LOGRADOURO
                                   WHERE EXCLUIDO         = :EXCLUIDO 
                                   AND ID_TIPO_LOGRADOURO = :ID_TIPO_LOGRADOURO");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0);
            $objDaoHelper->bindValue(":ID_TIPO_LOGRADOURO", $objTipoLogradouroVO->getId(), false);

// Executando comando
            $objDaoHelper->execute();

// Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE.
            foreach ($objDaoHelper->fetchAll() as $TipoLogradouro) {

                $objTipoLogradouroVO = new TipoLogradouroVO();

                $objTipoLogradouroVO->bind($TipoLogradouro);
            }

            $objDaoHelper->setRetornoOperacao($objTipoLogradouroVO);

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
