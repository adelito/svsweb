<?php

namespace module\pessoa\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use core\vo\pessoa\TipoEnderecoVO;

/**
 * Classe de persistencia TipoEndereco
 */
class TipoEnderecoDAO extends AbstractDAO {

    /**
     * @param void
     * @return ArrayIterator
     * @access public
     */
    public function listar($objTipoEnderecoVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));
            $aux = "";
            if (!is_null($objTipoEnderecoVO)) {
                if (strlen($objTipoEnderecoVO->getDescricao()) > 0) {
                    $aux .= "AND DESCRICAO = :DESCRICAO";
                }
            }
// Comando SQL

            $objDaoHelper->setSql("SELECT ID_TIPO_ENDERECO, DESCRICAO
                                    FROM
                                    PESSOA.TIPO_ENDERECO
                                    WHERE EXCLUIDO = :EXCLUIDO
                                   $aux");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);

            if (!is_null($objTipoEnderecoVO)) {
                if (strlen($objTipoEnderecoVO->getDescricao()) > 0) {
                    $objDaoHelper->bindValue(":DESCRICAO", $objTipoEnderecoVO->getDescricao());
                }
            }

// Executando comando
            $objDaoHelper->execute();

// Instanciando classes de apoio
            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->fetchAll() as $TipoEndereco) {

                $objTipoEnderecoVO = new TipoEnderecoVO();

                $objTipoEnderecoVO->bind($TipoEndereco);

                $arrayIterator->append($objTipoEnderecoVO);
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
     * @param TipoEnderecoVO $objTipoEnderecoVO
     * @return boolean
     * @access public
     */
    public function inserir($objTipoEnderecoVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

//Setando Id do grupo
            $objTipoEnderecoVO->setId($this->getSequenceNextVal("PESSOA.SEQ_TIPO_ENDERECO", $objDaoHelper->getConexao()));

// Comando SQL
            $objDaoHelper->setSql("INSERT INTO PESSOA.TIPO_ENDERECO (ID_TIPO_ENDERECO, DESCRICAO, MODIFICADO_EM, EXCLUIDO) 
                                 VALUES (
                                 :ID_TIPO_ENDERECO,
                                 :DESCRICAO,
                                 :MODIFICADO_EM,
                                 :EXCLUIDO
                                 )");

// Atribuindo valores

            $objDaoHelper->bindValue(":ID_TIPO_ENDERECO", $objTipoEnderecoVO->getId());
            $objDaoHelper->bindValue(":DESCRICAO", $objTipoEnderecoVO->getDescricao());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTipoEnderecoVO->getModificadoEm());
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
     * @param TipoEnderecoVO $objTipoEnderecoVO
     * @return mixed
     * @access public
     */
    public function alterar($objTipoEnderecoVO) {

        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE PESSOA.TIPO_ENDERECO
                                    SET    DESCRICAO              = :DESCRICAO,
                                           MODIFICADO_EM          = :MODIFICADO_EM
                                    WHERE  ID_TIPO_ENDERECO       = :ID_TIPO_ENDERECO
                                    ");

// Atribuindo valores
            $objDaoHelper->bindValue(":DESCRICAO", $objTipoEnderecoVO->getDescricao());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTipoEnderecoVO->getModificadoEm());
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);
            $objDaoHelper->bindValue(":ID_TIPO_ENDERECO", $objTipoEnderecoVO->getId(), false);

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
     * @param TipoEnderecoVO $objTipoEnderecoVO
     * @return boolean
     * @access public
     */
    public function excluir($objTipoEnderecoVO) {


        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE PESSOA.TIPO_ENDERECO
                                    SET    MODIFICADO_EM     = :MODIFICADO_EM,
                                           EXCLUIDO          = :EXCLUIDO,
                                    WHERE  ID_TIPO_ENDERECO  = :ID_TIPO_ENDERECO");


// Atribuindo valores
            $objDaoHelper->bindValue(":ID_TIPO_ENDERECO", $objTipoEnderecoVO->getId());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTipoEnderecoVO->getModificadoEm());
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
     * @param TipoEnderecoVO $objTipoEnderecoVO
     * @return boolean
     * @access public
     */
    public function selecionar($objTipoEnderecoVO) {


        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("SELECT ID_TIPO_ENDERECO, DESCRICAO, EXCLUIDO
                                    FROM PESSOA.TIPO_ENDERECO
                                   WHERE EXCLUIDO       = :EXCLUIDO 
                                   AND ID_TIPO_ENDERECO = :ID_TIPO_ENDERECO");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0);
            $objDaoHelper->bindValue(":ID_TIPO_ENDERECO", $objTipoEnderecoVO->getId(), false);

// Executando comando
            $objDaoHelper->execute();

// Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE.
            foreach ($objDaoHelper->fetchAll() as $TipoEndereco) {

                $objTipoEnderecoVO = new TipoEnderecoVO();

                $objTipoEnderecoVO->bind($TipoEndereco);
            }

            $objDaoHelper->setRetornoOperacao($objTipoEnderecoVO);

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
