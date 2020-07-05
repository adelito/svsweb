<?php

namespace module\pessoa\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use core\vo\pessoa\LocalidadeVO;

/**
 * Classe de persistencia Localidade
 */
class LocalidadeDAO extends AbstractDAO {

    /**
     * @param void
     * @return ArrayIterator
     * @access public
     */
    public function listar($objLocalidadeVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));
            $aux = "";
            if (!is_null($objLocalidadeVO)) {
                if (strlen($objLocalidadeVO->getId()) > 0) {
                    $aux .= "AND ID_LOCALIDADE = :ID_LOCALIDADE";
                }
                if (strlen($objLocalidadeVO->getFlSubclasse()) > 0) {
                    $aux .= "AND FLSUBCLASSE = :FLSUBCLASSE";
                }
                if (strlen($objLocalidadeVO->getCodigoSrh()) > 0) {
                    $aux .= "AND CODIGOSRH = :CODIGOSRH";
                }
                if (strlen($objLocalidadeVO->getNome()) > 0) {
                    $aux .= "AND NOME = :NOME";
                }
                if (strlen($objLocalidadeVO->getCodigoIbge()) > 0) {
                    $aux .= "AND CODIGOIBGE = :CODIGOIBGE";
                }
                if (strlen($objLocalidadeVO->getCodigoIbgeCompleto()) > 0) {
                    $aux .= "AND CODIGOIBGECOMPLETO = :CODIGOIBGECOMPLETO";
                }
            }
// Comando SQL

            $objDaoHelper->setSql("SELECT ID_LOCALIDADE, 
                                          ID_PAI,
                                          FLSUBCLASSE, 
                                          CODIGOSRH, 
                                          NOME, 
                                          CODIGOIBGE, 
                                          CODIGOIBGECOMPLETO,                                            
                                          EXCLUIDO, 
                                          MODIFICADO_EM 
                                          FROM PESSOA.LOCALIDADE
                                    WHERE EXCLUIDO = :EXCLUIDO
                                   $aux");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);

            if (!is_null($objLocalidadeVO)) {
                if (strlen($objLocalidadeVO->getId()) > 0) {
                    $objDaoHelper->bindValue(":ID_LOCALIDADE", $objLocalidadeVO->getId());
                }
                if (strlen($objLocalidadeVO->getFlSubclasse()) > 0) {
                    $objDaoHelper->bindValue(":FLSUBCLASSE", $objLocalidadeVO->getDdd());
                }
                if (strlen($objLocalidadeVO->getCodigoIbge()) > 0) {
                    $objDaoHelper->bindValue(":CODIGOSRH", $objLocalidadeVO->getCodigoIbge());
                }
                if (strlen($objLocalidadeVO->getNome()) > 0) {
                    $objDaoHelper->bindValue(":NOME", $objLocalidadeVO->getNome());
                }
                if (strlen($objLocalidadeVO->getCodigoIbge()) > 0) {
                    $objDaoHelper->bindValue(":CODIGOIBGE", $objLocalidadeVO->getCodigoIbge());
                }
                if (strlen($objLocalidadeVO->getCodigoIbgeCompleto()) > 0) {
                    $objDaoHelper->bindValue(":CODIGOIBGECOMPLETO", $objLocalidadeVO->getCodigoIbgeCompleto());
                }
            }

// Executando comando
            $objDaoHelper->execute();

// Instanciando classes de apoio
            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->fetchAll() as $Localidade) {

                $objLocalidadeVO = new LocalidadeVO();

                $objLocalidadeVO->bind($Localidade);

                $arrayIterator->append($objLocalidadeVO);
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
     * @param LocalidadeVO $objLocalidadeVO
     * @return boolean
     * @access public
     */
    public function inserir($objLocalidadeVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

//Setando Id do grupo
            $objLocalidadeVO->setId($this->getSequenceNextVal("PESSOA.SEQ_TELEFONE", $objDaoHelper->getConexao()));

// Comando SQL
            $objDaoHelper->setSql("INSERT INTO PESSOA.LOCALIDADE ( 
                                          ID_LOCALIDADE, 
                                          ID_PAI,
                                          FLSUBCLASSE, 
                                          CODIGOSRH, 
                                          NOME, 
                                          CODIGOIBGE, 
                                          CODIGOIBGECOMPLETO,                                            
                                          MODIFICADO_EM,
                                          EXCLUIDO) 
                                 VALUES (
                                 :ID_LOCALIDADE,
                                 :ID_PAI,
                                 :FLSUBCLASSE,
                                 :CODIGOSRH,
                                 :NOME,
                                 :CODIGOIBGE,
                                 :CODIGOIBGECOMPLETO,
                                 :MODIFICADO_EM,
                                 :EXCLUIDO)");

// Atribuindo valores

            $objDaoHelper->bindValue(":ID_LOCALIDADE", $objLocalidadeVO->getId());
            $objDaoHelper->bindValue(":ID_PAI", $objLocalidadeVO->getIdPai());
            $objDaoHelper->bindValue(":FLSUBCLASSE", $objLocalidadeVO->getFlSubclasse());
            $objDaoHelper->bindValue(":CODIGOSRH", $objLocalidadeVO->getCodigoSrh());
            $objDaoHelper->bindValue(":NOME", $objLocalidadeVO->getNome());
            $objDaoHelper->bindValue(":CODIGOIBGE", $objLocalidadeVO->getCodigoIbge());
            $objDaoHelper->bindValue(":CODIGOIBGECOMPLETO", $objLocalidadeVO->getCodigoIbgeCompleto());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objLocalidadeVO->getModificadoEm());
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
     * @param LocalidadeVO $objLocalidadeVO
     * @return mixed
     * @access public
     */
    public function alterar($objLocalidadeVO) {

        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE PESSOA.LOCALIDADE
                                    SET    ID_TIPO_TELEFONE     = :ID_TIPO_TELEFONE,
                                           ID_PESSOA            = :ID_PESSOA,
                                           DDD                  = :DDD,
                                           NUMERO               = :NUMERO,
                                           MODIFICADO_EM        = :MODIFICADO_EM,
                                           EXCLUIDO             = :EXCLUIDO
                                    WHERE  ID_TELEFONE          = :ID_TELEFONE
                                    ");

// Atribuindo valores
            $objDaoHelper->bindValue(":ID_TIPO_TELEFONE", $objLocalidadeVO->getIdTipoLocalidade()->getId());
            $objDaoHelper->bindValue(":ID_PESSOA", $objLocalidadeVO->getIdPessoa()->getId());
            $objDaoHelper->bindValue(":DDD", $objLocalidadeVO->getDdd());
            $objDaoHelper->bindValue(":NUMERO", $objLocalidadeVO->getNumero());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objLocalidadeVO->getModificadoEm());
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);
            $objDaoHelper->bindValue(":ID_TELEFONE", $objLocalidadeVO->getId(), false);

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
     * @param LocalidadeVO $objLocalidadeVO
     * @return boolean
     * @access public
     */
    public function excluir($objLocalidadeVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE PESSOA.LOCALIDADE
                                    SET    MODIFICADO_EM       = :MODIFICADO_EM,
                                           EXCLUIDO            = :EXCLUIDO,
                                    WHERE  ID_LOCALIDADE       = :ID_LOCALIDADE");
// Atribuindo valores
            $objDaoHelper->bindValue(":ID_LOCALIDADE", $objLocalidadeVO->getId());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objLocalidadeVO->getModificadoEm());
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
     * @param LocalidadeVO $objLocalidadeVO
     * @return boolean
     * @access public
     */
    public function selecionar($objLocalidadeVO) {


        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("SELECT ID_LOCALIDADE, 
                                          ID_PAI,
                                          FLSUBCLASSE, 
                                          CODIGOSRH, 
                                          NOME, 
                                          CODIGOIBGE, 
                                          CODIGOIBGECOMPLETO,                                            
                                          EXCLUIDO, 
                                          MODIFICADO_EM 
                                    FROM PESSOA.LOCALIDADE
                                   WHERE EXCLUIDO  = :EXCLUIDO 
                                   AND ID_LOCALIDADE = :ID_LOCALIDADE");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0);
            $objDaoHelper->bindValue(":ID_LOCALIDADE", $objLocalidadeVO->getId(), false);

// Executando comando
            $objDaoHelper->execute();

// Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE.
            foreach ($objDaoHelper->fetchAll() as $Localidade) {

                $objLocalidadeVO = new LocalidadeVO();

                $objLocalidadeVO->bind($Localidade);
            }

            $objDaoHelper->setRetornoOperacao($objLocalidadeVO);

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
