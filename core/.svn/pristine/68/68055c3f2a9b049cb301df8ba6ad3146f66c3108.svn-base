<?php

namespace module\pessoa\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use core\helper\LogHelper;
use core\helper\formatHelper;
use core\vo\pessoa\PessoaJuridicaVO;
use core\helper\FormatHelper as FH;
use PDO;

/**
 * Classe de persistencia PessoaFisica
 */
class PessoaJuridicaDAO extends AbstractDAO {

    /**
     * @param void
     * @return ArrayIterator
     * @access public
     */
    public function listar(PessoaJuridicaVO $objPessoaJuridicaVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));
            $auxSQL = "";

            if (!is_null($objPessoaJuridicaVO)) {
               
                //Pessoa FISICA         //PESSOAFISICA
                
                if (strlen($objPessoaJuridicaVO->getNomeContato()) > 0) {
                    $auxSQL .= " AND TRANSLATE(UPPER(UPPER(    PESSOA_JURIDICA.NOME_CONTATO   )), 'Ã¢Ã Ã£Ã¡Ã�Ã‚Ã€ÃƒÃ©ÃªÃ‰ÃŠÃ­Ã�Ã³Ã´ÃµÃ“Ã”Ã•Ã¼ÃºÃœÃšÃ‡Ã§', 'AAAAAAAAEEEEIIOOOOOOUUUUCC') LIKE :NOME_CONTATO";
                }
                
                
                if (strlen($objPessoaJuridicaVO->getIdMatriz()) > 0) {
                    $auxSQL .= " AND PESSOA_JURIDICA.ID_MATRIZ = :CNPJ ";
                }
                
                if (strlen($objPessoaJuridicaVO->getCpf()) > 0) {
                    $auxSQL .= " AND PESSOA_JURIDICA.CNPJ = :CNPJ ";
                }
                if (strlen($objPessoaJuridicaVO->getInscricaoEstadual()) > 0) {
                    $auxSQL .= " AND PESSOA_JURIDICA.INSCRICAO_ESTADUAL = :INSCRICAO_ESTADUAL ";
                }
                
                
                if (strlen($objPessoaJuridicaVO->getNomeFantasia()) > 0) {
                    $auxSQL .= " AND TRANSLATE(UPPER(UPPER(    PESSOA_JURIDICA.NOME_FANTASIA   )), 'Ã¢Ã Ã£Ã¡Ã�Ã‚Ã€ÃƒÃ©ÃªÃ‰ÃŠÃ­Ã�Ã³Ã´ÃµÃ“Ã”Ã•Ã¼ÃºÃœÃšÃ‡Ã§', 'AAAAAAAAEEEEIIOOOOOOUUUUCC') LIKE :NOME_FANTASIA";
                }
                
                //Pessoa 
                if (strlen($objPessoaJuridicaVO->getTipoPessoa()) > 0) {
                    $auxSQL .= " AND PESSOA.TIPO_PESSOA = :TIPO_PESSOA";
                }
                if (strlen($objPessoaJuridicaVO->getNome()) > 0) {
                    $auxSQL .= " AND TRANSLATE(UPPER(UPPER(    PESSOA.NOME   )), 'Ã¢Ã Ã£Ã¡Ã�Ã‚Ã€ÃƒÃ©ÃªÃ‰ÃŠÃ­Ã�Ã³Ã´ÃµÃ“Ã”Ã•Ã¼ÃºÃœÃšÃ‡Ã§', 'AAAAAAAAEEEEIIOOOOOOUUUUCC') LIKE :NOME";
                }                
                
            }
            // Comando SQL
            $objDaoHelper->setSql("SELECT
                                        PESSOA.ID_PESSOA,
                                        PESSOA.NOME,
                                        PESSOA_JURIDICA.ID_MATRIZ,
                                        PESSOA_JURIDICA.CNPJ,
                                        PESSOA_JURIDICA.INSCRICAO_ESTADUAL,
                                        PESSOA_JURIDICA.NOME_FANTASIA,
                                        PESSOA_JURIDICA.NOME_CONTATO
                                   FROM PESSOA.PESSOA_JURIDICA
                                   INNER JOIN PESSOA.PESSOA ON PESSOA.ID_PESSOA = PESSOA_JURIDICA.ID_PESSOA
                                   WHERE PESSOA.EXCLUIDO = :EXCLUIDO
                                   $auxSQL");

            if (!is_null($objPessoaJuridicaVO)) {               
                
                //Pessoa FISICA         //PESSOAFISICA                
                
                 if (strlen($objPessoaJuridicaVO->getNome()) > 0) {
                        $objDaoHelper->bindValue(":NOME", '%' . FH::removerAcentos( $objPessoaJuridicaVO->getNome() ) . '%');
                }
                
                if (strlen($objPessoaJuridicaVO->getNomeFantasia()) > 0) {
                    $objDaoHelper->bindValue(":NOME_FANTASIA", '%' . FH::removerAcentos( $objPessoaJuridicaVO->getNomeFantasia() ) . '%');
                }  
                
                if (strlen($objPessoaJuridicaVO->getNomeContato()) > 0) {
                    $objDaoHelper->bindValue(":NOME_CONTATO", '%' . FH::removerAcentos( $objPessoaJuridicaVO->getNomeContato() ) . '%');
                }  
                if (strlen($objPessoaJuridicaVO->getIdMatriz()) > 0) {
                    $objDaoHelper->bindValue(":ID_MATRIZ", $objPessoaJuridicaVO->getIdMatriz() );
                }
                
                if (strlen($objPessoaJuridicaVO->getCnpj()) > 0) {
                    $objDaoHelper->bindValue(":CNPJ", $objPessoaJuridicaVO->getCnpj() );
                }
                if (strlen($objPessoaJuridicaVO->getInscricaoEstadual()) > 0) {
                    $objDaoHelper->bindValue(":INSCRICAO_ESTADUAL", $objPessoaJuridicaVO->getInscricaoEstadual() );
                }
                
                //Pessoa 
                if (strlen($objPessoaJuridicaVO->getTipoPessoa()) > 0) {
                    $objDaoHelper->bindValue(":TIPO_PESSOA", $objPessoaJuridicaVO->getTipoPessoa() );
                }
                
                
            }

            // Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0); //ATIVO 0 -- INATIVO 1
            
            //echo $objDaoHelper->getSql();exit();
            $objDaoHelper->execute();
            
            // Instanciando classes de apoio
            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->fetchAll() as $PessoaFisica) {
                $objPessoaJuridicaVO = new PessoaJuridicaVO();

                $objPessoaJuridicaVO->bind($PessoaFisica);
                $arrayIterator->append($objPessoaJuridicaVO);
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
     * @param PessoaJuridicaVO $objPessoaJuridicaVO
     * @return boolean
     * @access public
     */
    public function inserir($objPessoaJuridicaVO) {

        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

            //Setando Id do grupo
            $objPessoaJuridicaVO->setId($this->getSequenceNextVal("pessoa.SEQ_PESSOA", $objDaoHelper->getConexao()));
            
            // Comando SQL Pessoa
            $objDaoHelper->setSql("INSERT INTO PESSOA.PESSOA
                                  (
                                    ID_PESSOA,
                                    TIPO_PESSOA,
                                    NOME,
                                    MODIFICADO_EM,
                                    EXCLUIDO
                                  )                                    
                                 VALUES 
                                 (
                                    :ID_PESSOA,
                                    :TIPO_PESSOA,
                                    :NOME,                                    
                                     SYSDATE
                                    :EXCLUIDO
                                  )
                                  ");

            // Atribuindo valores
            $objDaoHelper->bindValue(":ID_PESSOA", $objPessoaJuridicaVO->getId());
            $objDaoHelper->bindValue(":TIPO_PESSOA", $objPessoaJuridicaVO->getTipoPessoa());
            $objDaoHelper->bindValue(":NOME", $objPessoaJuridicaVO->getNome());            
            $objDaoHelper->bindValue(":EXCLUIDO", 0);            
            
            //Executando a primeira query
            $objDaoHelper->execute(false);           


            $objDaoHelper->setSql("INSERT INTO PESSOA.PESSOA_JURIDICA
                                  (
                                    ID_PESSOA,
                                    ID_MATRIZ,
                                    CNPJ,
                                    INSCRICAO_ESTADUAL,
                                    NOME_FANTASIA,
                                    NOME_CONTATO
                                  )                                    
                                 VALUES 
                                 (
                                    :ID_PESSOA,
                                    :ID_MATRIZ,
                                    :CNPJ,
                                    :INSCRICAO_ESTADUAL,
                                    :NOME_FANTASIA,
                                    :NOME_CONTATO
                                  )
                                  ");

            // Atribuindo valores
            $objDaoHelper->bindValue(":ID_PESSOA", $objPessoaJuridicaVO->getId());
            $objDaoHelper->bindValue(":ID_MATRIZ", $objPessoaJuridicaVO->getIdMatriz());
            $objDaoHelper->bindValue(":CNPJ", $objPessoaJuridicaVO->getCnpj());
            $objDaoHelper->bindValue(":INSCRICAO_ESTADUAL", $objPessoaJuridicaVO->getInscricaoEstadual());
            $objDaoHelper->bindValue(":NOME_FANTASIA", $objPessoaJuridicaVO->getNomeFantasia());
            $objDaoHelper->bindValue(":NOME_CONTATO", $objPessoaJuridicaVO->getNomeContato());            
            
            //Executando a segunda query e dando commit
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
     * @param PessoaJuridicaVO $objPessoaJuridicaVO
     * @return mixed
     * @access public
     */
    public function alterar(PessoaJuridicaVO $objPessoaJuridicaVO) {

        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

            // Comando SQL PESSOA
            $objDaoHelper->setSql("UPDATE 
                                        PESSOA.PESSOA
                                   SET
                                       ID_PESSOA = :ID_PESSOA,
                                       TIPO_PESSOA = :TIPO_PESSOA,
                                       NOME = :NOME,
                                       MODIFICADO_EM = :MODIFICADO_EM,
                                       EXCLUIDO = :EXCLUIDO
                                    ");

            // Atribuindo valores pessoa
            $objDaoHelper->bindValue(":ID_PESSOA", $objPessoaJuridicaVO->getId());
            $objDaoHelper->bindValue(":TIPO_PESSOA", $objPessoaJuridicaVO->getTipoPessoa());
            $objDaoHelper->bindValue(":NOME", $objPessoaJuridicaVO->getNome());            
            $objDaoHelper->bindValue(":NOME", $objPessoaJuridicaVO->getModificadoEm());            
            $objDaoHelper->bindValue(":EXCLUIDO", $objPessoaJuridicaVO->getExcluido());   
            
            $objDaoHelper->execute(false);
            
            
            //SQL PESSOAFISICA
            $objDaoHelper->setSql("UPDATE 
                                        PESSOA.PESSOA_JURIDICA
                                   SET
                                        ID_PESSOA = :ID_PESSOA,
                                        ID_MATRIZ = :ID_MATRIZ,
                                        CNPJ      = :CNPJ,
                                        INSCRICAO_ESTADUAL = :INSCRICAO_ESTADUAL,
                                        NOME_FANTASIA = :NOME_FANTASIA,
                                        NOME_CONTATO  = :NOME_CONTATO
                                    ");
            
            // Atribuindo valores fisica
            $objDaoHelper->bindValue(":ID_PESSOA", $objPessoaJuridicaVO->getId());
            $objDaoHelper->bindValue(":ID_MATRIZ", $objPessoaJuridicaVO->getIdMatriz());
            $objDaoHelper->bindValue(":CNPJ", $objPessoaJuridicaVO->getCnpj());
            $objDaoHelper->bindValue(":INSCRICAO_ESTADUAL", $objPessoaJuridicaVO->getInscricaoEstadual());
            $objDaoHelper->bindValue(":NOME_FANTASIA", $objPessoaJuridicaVO->getNomeFantasia());
            $objDaoHelper->bindValue(":NOME_CONTATO", $objPessoaJuridicaVO->getNomeContato());
            
            //echo $objDaoHelper->getSql();exit();
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
     * @param PessoaJuridicaVO $objPessoaJuridicaVO
     * @return boolean
     * @access public
     */
    public function excluir( PessoaJuridicaVO $objPessoaJuridicaVO) {


        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('PORTALBI'));

            // Comando SQL PESSOA
            $objDaoHelper->setSql("UPDATE 
                                        PORTALBI.PESSOA
                                    SET   
                                        MODIFICADO_EM  = :MODIFICADO_EM,
                                        EXCLUIDO       = :EXCLUIDO                                           
                                    WHERE  
                                        ID_PESSOA = :ID_PESSOA");


            // Atribuindo valores
            $objDaoHelper->bindValue(":ID_PESSOA", $objPessoaJuridicaVO->getId());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objPessoaJuridicaVO->getModificadoEm());
            $objDaoHelper->bindValue(":EXCLUIDO", 1); //ATIVO 0 -- INATIVO 1
            // Executando comando
            $objDaoHelper->execute(false);
            
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
     * @param PessoaJuridicaVO $objPessoaJuridicaVO
     * @return boolean
     * @access public
     */
    public function selecionar(PessoaJuridicaVO $objPessoaJuridicaVO) {


        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

            // Comando SQL
            $objDaoHelper->setSql("SELECT 
                                        PESSOA.ID_PESSOA,
                                        PESSOA.TIPO_PESSOA,
                                        PESSOA.NOME,
                                        PESSOA.MODIFICADO_EM,
                                        PESSOA.EXCLUIDO,
                                        PESSOA_JURIDICA.ID_MATRIZ,
                                        PESSOA_JURIDICA.CNPJ,
                                        PESSOA_JURIDICA.INSCRICAO_ESTADUAL,
                                        PESSOA_JURIDICA.NOME_FANTASIA,
                                        PESSOA_JURIDICA.NOME_CONTATO
                                    FROM 
                                        PESSOA.PESSOA
                                    INNER JOIN PESSOA_JURIDICA ON PESSOA.ID_PESSOA = PESSOA_JURIDICA.ID_PESSOA
                                    WHERE
                                        PESSOA.EXCLUIDO = :EXCLUIDO,
                                        PESSOA_JURIDICA.CPF = :CPF
                                        
                                    ");


            // Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0); //ATIVO 0 -- INATIVO 1
            $objDaoHelper->bindValue(":CPF", $objPessoaJuridicaVO->getCpf());

            //echo $objDaoHelper->getSql();exit();
            // Executando comando            
            $objDaoHelper->execute();

            $objPessoaJuridicaVO = false;
            // Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE.
            foreach ($objDaoHelper->fetchAll() as $pessoa) {
                $objPessoaJuridicaVO = new PessoaJuridicaVO();
                $objPessoaJuridicaVO->bind($pessoa);
            }

            $objDaoHelper->setRetornoOperacao($objPessoaJuridicaVO);

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
     * @param PessoaJuridicaVO $objPessoaJuridicaVO
     * @return boolean
     * @access public
     */
    public function existe(PessoaJuridicaVO $objPessoaJuridicaVO){


        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));
            $objDaoHelper->setSql("SELECT 
                                        COUNT(PESSOA_JURIDICA.CNPJ) as TOTAL
                                   FROM 
                                        PESSOA.PESSOA
                                   INNER JOIN PESSOA_JURIDICA ON PESSOA.ID_PESSOA = PESSOA_JURIDICA.ID_PESSOA
                                   WHERE
                                        PESSOA.EXCLUIDO = :EXCLUIDO,
                                        PESSOA_JURIDICA.CNPJ = :CNPJ
                                   ");
            // Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0); //ATIVO 0 -- INATIVO 1
            $objDaoHelper->bindValue(":CPF", str_replace(array('.', '-'), '', $objPessoaJuridicaVO->getCpf()));

            // Executando comando
            $objDaoHelper->execute();
            foreach ($objDaoHelper->fetchAll() as $cnpj) {
                if ($cnpj['TOTAL'] > 0) {
                    $objDaoHelper->setRetornoOperacao(TRUE);
                }
            }

            //Fechando conexão
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            //      LogHelper::registrar(__CLASS__, __FUNCTION__, $ex->getMessage());
            throw new \Exception($ex->getMessage());
        }


        // Retornando resposta
        return $objDaoHelper->getRetornoOperacao();
    }

}
