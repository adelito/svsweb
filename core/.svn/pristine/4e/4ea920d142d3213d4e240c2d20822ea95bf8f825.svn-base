<?php

namespace module\pessoa\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use core\vo\pessoa\TelefoneVO;

/**
 * Classe de persistencia Telefone
 */
class TelefoneDAO extends AbstractDAO {

    /**
     * @param void
     * @return ArrayIterator
     * @access public
     */
    public function listar($objTelefoneVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));
            $aux = "";
            if (!is_null($objTelefoneVO)) {
                if (strlen($objTelefoneVO->getIdTipoTelefone()->getId()) > 0) {
                    $aux .= "AND ID_TIPO_TELEFONE = :ID_TIPO_TELEFONE";
                }
                if (strlen($objTelefoneVO->getIdPessoa()->getId()) > 0) {
                    $aux .= "AND ID_PESSOA = :ID_PESSOA";
                }
                if (strlen($objTelefoneVO->getDdd()) > 0) {
                    $aux .= "AND DDD = :DDD";
                }
                if (strlen($objTelefoneVO->getNumero()) > 0) {
                    $aux .= "AND NUMERO = :NUMERO";
                }
            }
// Comando SQL

            $objDaoHelper->setSql("SELECT ID_TELEFONE, ID_TIPO_TELEFONE, ID_PESSOA,
                                    DDD,
                                    NUMERO 
                                    FROM
                                    PESSOA.TELEFONE
                                    WHERE EXCLUIDO = :EXCLUIDO
                                   $aux");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);

            if (!is_null($objTelefoneVO)) {
                if (strlen($objTelefoneVO->getIdTipoTelefone()->getId()) > 0) {
                    $objDaoHelper->bindValue(":ID_TIPO_TELEFONE", $objTelefoneVO->getIdTipoTelefone()->getId());
                }
                if (strlen($objTelefoneVO->getIdPessoa()->getId()) > 0) {
                    $objDaoHelper->bindValue(":ID_PESSOA", $objTelefoneVO->getIdPessoa()->getId());
                }
                if (strlen($objTelefoneVO->getDdd()) > 0) {
                    $objDaoHelper->bindValue(":DDD", $objTelefoneVO->getDdd());
                }
                if (strlen($objTelefoneVO->getNumero()) > 0) {
                    $objDaoHelper->bindValue(":NUMERO", $objTelefoneVO->getNumero());
                }
            }

// Executando comando
            $objDaoHelper->execute();

// Instanciando classes de apoio
            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->fetchAll() as $Telefone) {

                $objTelefoneVO = new TelefoneVO();

                $objTelefoneVO->bind($Telefone);

                $arrayIterator->append($objTelefoneVO);
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
     * @param TelefoneVO $objTelefoneVO
     * @return boolean
     * @access public
     */
    public function inserir($objTelefoneVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

//Setando Id do grupo
            $objTelefoneVO->setId($this->getSequenceNextVal("PESSOA.SEQ_TELEFONE", $objDaoHelper->getConexao()));

// Comando SQL
            $objDaoHelper->setSql("INSERT INTO PESSOA.TELEFONE (ID_TELEFONE, ID_TIPO_TELEFONE, ID_PESSOA,
                                    DDD, NUMERO, MODIFICADO_EM, EXCLUIDO) 
                                 VALUES (
                                 :ID_TELEFONE,
                                 :ID_TIPO_TELEFONE,
                                 :ID_PESSOA,
                                 :DDD,
                                 :NUMERO,
                                 :MODIFICADO_EM,
                                 :EXCLUIDO
                                 )");

// Atribuindo valores

            $objDaoHelper->bindValue(":ID_TELEFONE", $objTelefoneVO->getId());
            $objDaoHelper->bindValue(":ID_TIPO_TELEFONE", $objTelefoneVO->getIdTipoTelefone()->getId());
            $objDaoHelper->bindValue(":ID_PESSOA", $objTelefoneVO->getIdPessoa()->getId());
            $objDaoHelper->bindValue(":DDD", $objTelefoneVO->getDdd());
            $objDaoHelper->bindValue(":NUMERO", $objTelefoneVO->getNumero());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTelefoneVO->getModificadoEm());
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
     * @param TelefoneVO $objTelefoneVO
     * @return mixed
     * @access public
     */
    public function alterar($objTelefoneVO) {

        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE PESSOA.TELEFONE
                                    SET    ID_TIPO_TELEFONE     = :ID_TIPO_TELEFONE,
                                           ID_PESSOA            = :ID_PESSOA,
                                           DDD                  = :DDD,
                                           NUMERO               = :NUMERO,
                                           MODIFICADO_EM        = :MODIFICADO_EM,
                                           EXCLUIDO             = :EXCLUIDO
                                    WHERE  ID_TELEFONE          = :ID_TELEFONE
                                    ");

// Atribuindo valores
            $objDaoHelper->bindValue(":ID_TIPO_TELEFONE", $objTelefoneVO->getIdTipoTelefone()->getId());
            $objDaoHelper->bindValue(":ID_PESSOA", $objTelefoneVO->getIdPessoa()->getId());
            $objDaoHelper->bindValue(":DDD", $objTelefoneVO->getDdd());
            $objDaoHelper->bindValue(":NUMERO", $objTelefoneVO->getNumero());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTelefoneVO->getModificadoEm());
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);
            $objDaoHelper->bindValue(":ID_TELEFONE", $objTelefoneVO->getId(), false);

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
     * @param TelefoneVO $objTelefoneVO
     * @return boolean
     * @access public
     */
    public function excluir($objTelefoneVO) {


        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE PESSOA.TELEFONE
                                    SET    MODIFICADO_EM     = :MODIFICADO_EM,
                                           EXCLUIDO          = :EXCLUIDO
                                    WHERE  ID_TELEFONE       = :ID_TELEFONE");


// Atribuindo valores
            $objDaoHelper->bindValue(":ID_TELEFONE", $objTelefoneVO->getId());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objTelefoneVO->getModificadoEm());
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
     * @param TelefoneVO $objTelefoneVO
     * @return boolean
     * @access public
     */
    public function selecionar($objTelefoneVO) {


        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("SELECT ID_TIPO_TELEFONE, ID_PESSOA, DDD, NUMERO, EXCLUIDO
                                    FROM PESSOA.TELEFONE
                                    WHERE EXCLUIDO  = :EXCLUIDO 
                                    AND ID_TELEFONE = :ID_TELEFONE");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0);
            $objDaoHelper->bindValue(":ID_TELEFONE", $objTelefoneVO->getId(), false);

// Executando comando
            $objDaoHelper->execute();

// Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE.
            foreach ($objDaoHelper->fetchAll() as $Telefone) {
                $objTelefoneVO = new TelefoneVO();
                $objTelefoneVO->bind($Telefone);
            }

            $objDaoHelper->setRetornoOperacao($objTelefoneVO);

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
