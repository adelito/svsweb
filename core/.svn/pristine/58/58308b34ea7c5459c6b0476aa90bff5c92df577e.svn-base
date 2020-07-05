<?php

namespace module\pessoa\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use core\vo\pessoa\TipoTelefoneVO;

/**
 * Classe de persistencia TipoTelefone
 */
class TipoTelefoneDAO extends AbstractDAO {

    /**
     * @param void
     * @return ArrayIterator
     * @access public
     */
    public function listar($objTipoTelefoneVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));
            $aux = "";
            if (!is_null($objTipoTelefoneVO)) {
                if (strlen($objTipoTelefoneVO->getDescricao()) > 0) {
                    $aux .= "AND DESCRICAO = :DESCRICAO";
                }
            }
// Comando SQL

            $objDaoHelper->setSql("SELECT ID_TIPO_TELEFONE, DESCRICAO
                                    FROM
                                    PESSOA.TIPO_TELEFONE
                                    WHERE EXCLUIDO = :EXCLUIDO
                                   $aux");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);

            if (!is_null($objTipoTelefoneVO)) {
                if (strlen($objTipoTelefoneVO->getDescricao()) > 0) {
                    $objDaoHelper->bindValue(":DESCRICAO", $objTipoTelefoneVO->getDescricao());
                }
            }

// Executando comando
            $objDaoHelper->execute();

// Instanciando classes de apoio
            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->fetchAll() as $TipoTelefone) {

                $objTipoTelefoneVO = new TipoTelefoneVO();

                $objTipoTelefoneVO->bind($TipoTelefone);

                $arrayIterator->append($objTipoTelefoneVO);
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
     * @param TipoTelefoneVO $objTipoTelefoneVO
     * @return boolean
     * @access public
     */
    public function inserir($objTipoTelefoneVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

//Setando Id do grupo
            $objTipoTelefoneVO->setId($this->getSequenceNextVal("PESSOA.SEQ_TIPO_TELEFONE", $objDaoHelper->getConexao()));

// Comando SQL
            $objDaoHelper->setSql("INSERT INTO PESSOA.TIPO_TELEFONE (ID_TIPO_TELEFONE, DESCRICAO, MODIFICADO_EM, EXCLUIDO) 
                                 VALUES (
                                 :ID_TIPO_TELEFONE,
                                 :DESCRICAO,
                                 :MODIFICADO_EM,
                                 :EXCLUIDO
                                 )");

// Atribuindo valores

            $objDaoHelper->bindValue(":ID_TIPO_TELEFONE", $objTipoTelefoneVO->getId());
            $objDaoHelper->bindValue(":DESCRICAO", $objTipoTelefoneVO->getDescricao());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTipoTelefoneVO->getModificadoEm());
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
     * @param TipoTelefoneVO $objTipoTelefoneVO
     * @return mixed
     * @access public
     */
    public function alterar($objTipoTelefoneVO) {

        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE PESSOA.TIPO_TELEFONE
                                    SET    DESCRICAO            = :DESCRICAO,
                                           MODIFICADO_EM        = :MODIFICADO_EM
                                    WHERE  ID_TIPO_TELEFONE     = :ID_TIPO_TELEFONE
                                    ");

// Atribuindo valores
            $objDaoHelper->bindValue(":DESCRICAO", $objTipoTelefoneVO->getDescricao());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTipoTelefoneVO->getModificadoEm());
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);
            $objDaoHelper->bindValue(":ID_TIPO_TELEFONE", $objTipoTelefoneVO->getId(), false);

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
     * @param TipoTelefoneVO $objTipoTelefoneVO
     * @return boolean
     * @access public
     */
    public function excluir($objTipoTelefoneVO) {


        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE PESSOA.TIPO_TELEFONE
                                    SET    MODIFICADO_EM      = :MODIFICADO_EM,
                                           EXCLUIDO           = :EXCLUIDO,
                                    WHERE  ID_TIPO_TELEFONE   = :ID_TIPO_TELEFONE");


// Atribuindo valores
            $objDaoHelper->bindValue(":ID_TIPO_TELEFONE", $objTipoTelefoneVO->getId());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTipoTelefoneVO->getModificadoEm());
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
     * @param TipoTelefoneVO $objTipoTelefoneVO
     * @return boolean
     * @access public
     */
    public function selecionar($objTipoTelefoneVO) {


        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("SELECT ID_TIPO_TELEFONE, DESCRICAO, EXCLUIDO
                                    FROM PESSOA.TIPO_TELEFONE
                                   WHERE EXCLUIDO       = :EXCLUIDO 
                                   AND ID_TIPO_TELEFONE = :ID_TIPO_TELEFONE");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0);
            $objDaoHelper->bindValue(":ID_TIPO_TELEFONE", $objTipoTelefoneVO->getId(), false);

// Executando comando
            $objDaoHelper->execute();

// Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE.
            foreach ($objDaoHelper->fetchAll() as $TipoTelefone) {

                $objTipoTelefoneVO = new TipoTelefoneVO();

                $objTipoTelefoneVO->bind($TipoTelefone);
            }

            $objDaoHelper->setRetornoOperacao($objTipoTelefoneVO);

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
