<?php

namespace module\pessoa\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use core\vo\pessoa\EnderecoVO;
use core\vo\pessoa\TipoLogradouroVO;

/**
 * Classe de persistencia Endereco
 */
class EnderecoDAO extends AbstractDAO {

    /**
     * @param void
     * @return ArrayIterator
     * @access public
     */
    public function listar($objEnderecoVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));
            $aux = "";
            if (!is_null($objEnderecoVO)) {
                if (strlen($objEnderecoVO->getIdTipoEndereco()->getId()) > 0) {
                    $aux .= "AND ID_TIPO_ENDERECO = :ID_TIPO_ENDERECO";
                }
                if (strlen($objEnderecoVO->getIdTipoLogradouro()->getId()) > 0) {
                    $aux .= "AND ID_TIPO_LOGRADOURO = :ID_TIPO_LOGRADOURO";
                }
                if (strlen($objEnderecoVO->getIdTipoEndereco()->getId()) > 0) {
                    $aux .= "AND ID_TIPO_ENDERECO = :ID_TIPO_ENDERECO";
                }
                if (strlen($objEnderecoVO->getIdPessoa()->getId()) > 0) {
                    $aux .= "AND ID_PESSOA = :ID_PESSOA";
                }                
                if (strlen($objEnderecoVO->getLogradouro()) > 0) {
                    $aux .= "AND LOGRADOURO = :LOGRADOURO";
                }
                if (strlen($objEnderecoVO->getComplemento()) > 0) {
                    $aux .= "AND COMPLEMENTO = :COMPLEMENTO";
                }
                if (strlen($objEnderecoVO->getCep()) > 0) {
                    $aux .= "AND CEP = :CEP";
                }
                if (strlen($objEnderecoVO->getBairro()) > 0) {
                    $aux .= "AND BAIRRO = :BAIRRO";
                }
                if (strlen($objEnderecoVO->getNumero()) > 0) {
                    $aux .= "AND NUMERO = :NUMERO";
                }
                if (strlen($objEnderecoVO->getZona()) > 0) {
                    $aux .= "AND ZONA = :ZONA";
                }
            }
// Comando SQL

            $objDaoHelper->setSql("SELECT SELECT ID_ENDERECO,
                                            ID_TIPO_LOGRADOURO,
                                            ID_TIPO_ENDERECO,
                                            ID_PESSOA,
                                            LOGRADOURO,
                                            COMPLEMENTO,
                                            CEP,
                                            MODIFICADO_EM,
                                            EXCLUIDO,
                                            ID_LOCALIDADE,
                                            BAIRRO,
                                            NUMERO,
                                            ZONA
                                       FROM PESSOA.ENDERECO
                                    WHERE EXCLUIDO = :EXCLUIDO
                                   $aux");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);

            if (!is_null($objEnderecoVO)) {
                if (strlen($objEnderecoVO->getIdTipoEndereco()->getId()) > 0) {
                    $objDaoHelper->bindValue(":ID_TIPO_TELEFONE", $objEnderecoVO->getIdTipoEndereco()->getId());
                }
                if (strlen($objEnderecoVO->getIdTipoLogradouro()->getId()) > 0) {
                    $objDaoHelper->bindValue(":ID_TIPO_LOGRADOURO", $objEnderecoVO->getIdTipoLogradouro()->getId());
                }
                if (strlen($objEnderecoVO->getIdTipoEndereco()->getId()) > 0) {
                    $objDaoHelper->bindValue(":ID_TIPO_ENDERECO", $objEnderecoVO->getIdTipoEndereco()->getId());
                }
                if (strlen($objEnderecoVO->getIdPessoa()->getId()) > 0) {
                    $objDaoHelper->bindValue(":ID_PESSOA", $objEnderecoVO->getIdPessoa()->getId());
                }
                if (strlen($objEnderecoVO->getLogradouro()) > 0) {
                    $objDaoHelper->bindValue(":LOGRADOURO", $objEnderecoVO->getLogradouro());
                }
                if (strlen($objEnderecoVO->getComplemento()) > 0) {
                    $objDaoHelper->bindValue(":COMPLEMENTO", $objEnderecoVO->getComplemento());
                }
                if (strlen($objEnderecoVO->getCep()) > 0) {
                    $objDaoHelper->bindValue(":CEP", $objEnderecoVO->getCep());
                }
                if (strlen($objEnderecoVO->getBairro()) > 0) {
                    $objDaoHelper->bindValue(":BAIRRO", $objEnderecoVO->getBairro());
                }
                if (strlen($objEnderecoVO->getNumero()) > 0) {
                    $objDaoHelper->bindValue(":NUMERO", $objEnderecoVO->getNumero());
                }
                if (strlen($objEnderecoVO->getZona()) > 0) {
                    $objDaoHelper->bindValue(":ZONA", $objEnderecoVO->getZona());
                }
            }

// Executando comando
            $objDaoHelper->execute();

// Instanciando classes de apoio
            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->fetchAll() as $Endereco) {

                $objEnderecoVO = new EnderecoVO();

                $objEnderecoVO->bind($Endereco);

                $arrayIterator->append($objEnderecoVO);
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
     * @param EnderecoVO $objEnderecoVO
     * @return boolean
     * @access public
     */
    public function inserir($objEnderecoVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

//Setando Id do grupo
            $objEnderecoVO->setId($this->getSequenceNextVal("PESSOA.SEQ_ENDERECO", $objDaoHelper->getConexao()));

// Comando SQL
            $objDaoHelper->setSql("INSERT INTO PESSOA.ENDERECO (ID_ENDERECO, ID_TIPO_LOGRADOURO, ID_TIPO_ENDERECO,
                                    ID_PESSOA, LOGRADOURO, COMPLEMENTO, CEP, ID_LOCALIDADE,BAIRRO, NUMERO,ZONA,MODIFICADO_EM, EXCLUIDO) 
                                 VALUES (
                                 :ID_ENDERECO,
                                 :ID_TIPO_LOGRADOURO,
                                 :ID_TIPO_ENDERECO,
                                 :ID_PESSOA,
                                 :LOGRADOURO,
                                 :COMPLEMENTO,
                                 :CEP,
                                 :ID_LOCALIDADE,
                                 :BAIRRO,
                                 :NUMERO,
                                 :ZONA,
                                 :MODIFICADO_EM,
                                 :EXCLUIDO)");

// Atribuindo valores

            $objDaoHelper->bindValue(":ID_ENDERECO", $objEnderecoVO->getId());
            $objDaoHelper->bindValue(":ID_TIPO_LOGRADOURO", $objEnderecoVO->getIdTipoLogradouro()->getId());
            $objDaoHelper->bindValue(":ID_TIPO_ENDERECO", $objEnderecoVO->getIdTipoEndereco()->getId());
            $objDaoHelper->bindValue(":ID_PESSOA", $objEnderecoVO->getIdPessoa()->getId());
            $objDaoHelper->bindValue(":LOGRADOURO", $objEnderecoVO->getLogradouro());
            $objDaoHelper->bindValue(":COMPLEMENTO", $objEnderecoVO->getComplemento());
            $objDaoHelper->bindValue(":CEP", $objEnderecoVO->getCep());
            $objDaoHelper->bindValue(":ID_LOCALIDADE", $objEnderecoVO->getIdLocalidade()->getId());
            $objDaoHelper->bindValue(":BAIRRO", $objEnderecoVO->getBairro());
            $objDaoHelper->bindValue(":NUMERO", $objEnderecoVO->getNumero());
            $objDaoHelper->bindValue(":ZONA", $objEnderecoVO->getZona());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objEnderecoVO->getModificadoEm());
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
     * @param EnderecoVO $objEnderecoVO
     * @return mixed
     * @access public
     */
    public function alterar($objEnderecoVO) {

        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE PESSOA.ENDERECO
                                    SET    ID_TIPO_LOGRADOURO   = :ID_TIPO_LOGRADOURO,
                                           ID_TIPO_ENDERECO     = :ID_TIPO_ENDERECO,
                                           ID_LOCALIDADE        = :ID_LOCALIDADE,                                           
                                           ID_PESSOA            = :ID_PESSOA,
                                           LOGRADOURO           = :LOGRADOURO,
                                           COMPLEMENTO          = :COMPLEMENTO,
                                           CEP                  = :CEP,                                                                                      
                                           BAIRRO               = :BAIRRO,
                                           NUMERO               = :NUMERO,
                                           ZONA                 = :ZONA,
                                           MODIFICADO_EM        = :MODIFICADO_EM,
                                           EXCLUIDO             = :EXCLUIDO
                                    WHERE  ID_ENDERECO          = :ID_ENDERECO
                                    ");

// Atribuindo valores
            $objDaoHelper->bindValue(":ID_TIPO_LOGRADOURO", $objEnderecoVO->getIdTipoLogradouro()->getId());
            $objDaoHelper->bindValue(":ID_TIPO_ENDERECO", $objEnderecoVO->getIdTipoEndereco()->getId());
            $objDaoHelper->bindValue(":ID_LOCALIDADE", $objEnderecoVO->getIdLocalidade()->getId());
            $objDaoHelper->bindValue(":ID_PESSOA", $objEnderecoVO->getIdPessoa()->getId());
            $objDaoHelper->bindValue(":LOGRADOURO", $objEnderecoVO->getLogradouro());
            $objDaoHelper->bindValue(":COMPLEMENTO", $objEnderecoVO->getComplemento());
            $objDaoHelper->bindValue(":CEP", $objEnderecoVO->getCep());
            $objDaoHelper->bindValue(":BAIRRO", $objEnderecoVO->getBairro());
            $objDaoHelper->bindValue(":NUMERO", $objEnderecoVO->getNumero());
            $objDaoHelper->bindValue(":ZONA", $objEnderecoVO->getZona());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objEnderecoVO->getModificadoEm());
            $objDaoHelper->bindValue(":EXCLUIDO", 0, false);
            $objDaoHelper->bindValue(":ID_ENDERECO", $objEnderecoVO->getId(), false);

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
     * @param EnderecoVO $objEnderecoVO
     * @return boolean
     * @access public
     */
    public function excluir($objEnderecoVO) {


        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("UPDATE  PESSOA.ENDERECO
                                    SET    MODIFICADO_EM     = :MODIFICADO_EM,
                                           EXCLUIDO          = :EXCLUIDO,
                                    WHERE  ID_ENDERECO   = :ID_ENDERECO");

// Atribuindo valores
            $objDaoHelper->bindValue(":ID_ENDERECO", $objEnderecoVO->getId());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objEnderecoVO->getModificadoEm());
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
     * @param EnderecoVO $objEnderecoVO
     * @return boolean
     * @access public
     */
    public function selecionar($objEnderecoVO) {


        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

// Comando SQL
            $objDaoHelper->setSql("SELECT
                                        ID_ENDERECO, ID_TIPO_LOGRADOURO, ID_TIPO_ENDERECO,
                                        ID_PESSOA, LOGRADOURO, COMPLEMENTO, CEP,
                                        MODIFICADO_EM, EXCLUIDO, ID_LOCALIDADE, BAIRRO,NUMERO,
                                        ZONA, EXCLUIDO 
                                        FROM PESSOA.TELEFONE
                                        WHERE EXCLUIDO  = :EXCLUIDO 
                                        AND ID_TELEFONE = :ID_TELEFONE");

// Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0);
            $objDaoHelper->bindValue(":ID_TELEFONE", $objEnderecoVO->getId(), false);

// Executando comando
            $objDaoHelper->execute();

// Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE.
            foreach ($objDaoHelper->fetchAll() as $Endereco) {

                $objEnderecoVO = new EnderecoVO();

                $objEnderecoVO->bind($Endereco);
            }

            $objDaoHelper->setRetornoOperacao($objEnderecoVO);

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
