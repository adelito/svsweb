<?php

namespace module\pessoa\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use core\helper\LogHelper;
use core\helper\formatHelper;
use core\vo\pessoa\PessoaFisicaVO;
use core\helper\FormatHelper as FH;
use PDO;

/**
 * Classe de persistencia PessoaFisica
 */
class PessoaFisicaDAO extends AbstractDAO {

    /**
     * @param void
     * @return ArrayIterator
     * @access public
     */
    public function listar(PessoaFisicaVO $objPessoaFisicaVO) {

        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));
            $auxSQL = "";

            if (!is_null($objPessoaFisicaVO)) {
               
                //Pessoa FISICA         //PESSOAFISICA
                
                if (strlen($objPessoaFisicaVO->getNomeSocial()) > 0) {
                    $auxSQL .= " AND TRANSLATE(UPPER(UPPER(    PESSOA_FISICA.NOME_SOCIAL   )), 'Ã¢Ã Ã£Ã¡Ã�Ã‚Ã€ÃƒÃ©ÃªÃ‰ÃŠÃ­Ã�Ã³Ã´ÃµÃ“Ã”Ã•Ã¼ÃºÃœÃšÃ‡Ã§', 'AAAAAAAAEEEEIIOOOOOOUUUUCC') LIKE :NOME_SOCIAL";
                }
                
                if (strlen($objPessoaFisicaVO->getCpf()) > 0) {
                    $auxSQL .= " AND PESSOA_FISICA.CPF = :CPF ";
                }
                if (strlen($objPessoaFisicaVO->getRg()) > 0) {
                    $auxSQL .= " AND PESSOA_FISICA.RG = :RG ";
                }
                if (strlen($objPessoaFisicaVO->getDataNascimento()) > 0) {
                    $auxSQL .= " AND PESSOA_FISICA.DATA_NASCIMENTO = :DATA_NASCIMENTO";
                }
                if (strlen($objPessoaFisicaVO->getGenero()) > 0) {
                    $auxSQL .= " AND PESSOA_FISICA.GENERO = :GENERO ";
                }               
                
                //Pessoa 
                if (strlen($objPessoaFisicaVO->getTipoPessoa()) > 0) {
                    $auxSQL .= " AND PESSOA.TIPO_PESSOA = :TIPO_PESSOA";
                }
                if (strlen($objPessoaFisicaVO->getNome()) > 0) {
                    $auxSQL .= " AND TRANSLATE(UPPER(UPPER(    PESSOA.NOME   )), 'Ã¢Ã Ã£Ã¡Ã�Ã‚Ã€ÃƒÃ©ÃªÃ‰ÃŠÃ­Ã�Ã³Ã´ÃµÃ“Ã”Ã•Ã¼ÃºÃœÃšÃ‡Ã§', 'AAAAAAAAEEEEIIOOOOOOUUUUCC') LIKE :NOME";
                }                
                
            }
            // Comando SQL
            $objDaoHelper->setSql("SELECT
                                        PESSOA.ID_PESSOA,
                                        PESSOA.NOME,
                                        PESSOA_FISICA.NOME_SOCIAL,
                                        PESSOA_FISICA.CPF,
                                        PESSOA_FISICA.RG,
                                        PESSOA_FISICA.ORGAO_EXPEDIDOR,
                                        PESSOA_FISICA.DATA_NASCIMENTO,
                                        PESSOA_FISICA.GENERO
                                   FROM PESSOA.PESSOA_FISICA
                                   INNER JOIN PESSOA.PESSOA ON PESSOA.ID_PESSOA = PESSOA_FISICA.ID_PESSOA
                                   WHERE PESSOA.EXCLUIDO = :EXCLUIDO
                                   $auxSQL");

            if (!is_null($objPessoaFisicaVO)) {               
                
                //Pessoa FISICA         //PESSOAFISICA                
                if (strlen($objPessoaFisicaVO->getNome()) > 0) {
                    $objDaoHelper->bindValue(":NOME", '%' . FH::removerAcentos( $objPessoaFisicaVO->getNome() ) . '%');
                }
                
                if (strlen($objPessoaFisicaVO->getNomeSocial()) > 0) {
                    $objDaoHelper->bindValue(":NOME_SOCIAL", '%' . FH::removerAcentos( $objPessoaFisicaVO->getNomeSocial() ) . '%');
                }
                
                if (strlen($objPessoaFisicaVO->getCpf()) > 0) {
                    $objDaoHelper->bindValue(":CPF", FH::removeMask( $objPessoaFisicaVO->getCpf() ) );
                }
                if (strlen($objPessoaFisicaVO->getRg()) > 0) {
                    $objDaoHelper->bindValue(":RG",   $objPessoaFisicaVO->getRg() );
                }
                if (strlen($objPessoaFisicaVO->getDataNascimento()) > 0) {
                    $objDaoHelper->bindValue(":DATA_NASCIMENTO",   $objPessoaFisicaVO->getDataNascimento() );
                }
                if (strlen($objPessoaFisicaVO->getGenero()) > 0) {
                    $objDaoHelper->bindValue(":GENERO",   $objPessoaFisicaVO->getGenero() );
                }
                //Pessoa 
                if (strlen($objPessoaFisicaVO->getTipoPessoa()) > 0) {
                    $objDaoHelper->bindValue(":TIPO_PESSOA",   $objPessoaFisicaVO->getTipoPessoa() );
                }
                if (strlen($objPessoaFisicaVO->getNome()) > 0) {
                    $objDaoHelper->bindValue(":PESSOA.NOME",   $objPessoaFisicaVO->getNome() );
                }                      
                
            }

            // Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0); //ATIVO 0 -- INATIVO 1
            
            //echo $objDaoHelper->getSql();exit();
            $objDaoHelper->execute();
            
            // Instanciando classes de apoio
            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->fetchAll() as $PessoaFisica) {
                $objPessoaFisicaVO = new PessoaFisicaVO();

                $objPessoaFisicaVO->bind($PessoaFisica);
                $arrayIterator->append($objPessoaFisicaVO);
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
     * @param PessoaFisicaVO $objPessoaFisicaVO
     * @return boolean
     * @access public
     */
    public function inserir($objPessoaFisicaVO) {

        $objDaoHelper = new DaoHelper();


        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));

            //Setando Id do grupo
            $objPessoaFisicaVO->setId($this->getSequenceNextVal("pessoa.SEQ_PESSOA", $objDaoHelper->getConexao()));
            
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
            $objDaoHelper->bindValue(":ID_PESSOA", $objPessoaFisicaVO->getId());
            $objDaoHelper->bindValue(":TIPO_PESSOA", $objPessoaFisicaVO->getTipoPessoa());
            $objDaoHelper->bindValue(":NOME", $objPessoaFisicaVO->getNome());            
            $objDaoHelper->bindValue(":EXCLUIDO", 0);            
            $objDaoHelper->execute(false);
            


            $objDaoHelper->setSql("INSERT INTO PESSOA.PESSOA_FISICA
                                  (
                                    ID_PESSOA,
                                    NOME_SOCIAL,
                                    CPF,
                                    RG,
                                    ORGAO_EXPEDIDOR,
                                    DATA_NASCIMENTO,
                                    GENERO
                                  )                                    
                                 VALUES 
                                 (
                                    ID_PESSOA,
                                    :NOME_SOCIAL,
                                    :CPF,
                                    :RG,
                                    :ORGAO_EXPEDIDOR,
                                    :DATA_NASCIMENTO,
                                    :GENERO
                                  )
                                  ");

            // Atribuindo valores
            $objDaoHelper->bindValue(":ID_PESSOA", $objPessoaFisicaVO->getId());
            $objDaoHelper->bindValue(":NOME_SOCIAL", $objPessoaFisicaVO->getNomeSocial());
            $objDaoHelper->bindValue(":CPF", $objPessoaFisicaVO->getCpf());
            $objDaoHelper->bindValue(":RG", $objPessoaFisicaVO->getRg());
            $objDaoHelper->bindValue(":ORGAO_EXPEDIDOR", $objPessoaFisicaVO->getOrgaoExpedidor());
            $objDaoHelper->bindValue(":DATA_NASCIMENTO", $objPessoaFisicaVO->getDataNascimento());
            $objDaoHelper->bindValue(":GENERO", $objPessoaFisicaVO->getGenero());
            
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
     * @param PessoaFisicaVO $objPessoaFisicaVO
     * @return mixed
     * @access public
     */
    public function alterar(PessoaFisicaVO $objPessoaFisicaVO) {

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
            $objDaoHelper->bindValue(":ID_PESSOA", $objPessoaFisicaVO->getId());
            $objDaoHelper->bindValue(":TIPO_PESSOA", $objPessoaFisicaVO->getTipoPessoa());
            $objDaoHelper->bindValue(":NOME", $objPessoaFisicaVO->getNome());            
            $objDaoHelper->bindValue(":NOME", $objPessoaFisicaVO->getModificadoEm());            
            $objDaoHelper->bindValue(":EXCLUIDO", $objPessoaFisicaVO->getExcluido());   
            
            $objDaoHelper->execute(false);
            
            
            //SQL PESSOAFISICA
            $objDaoHelper->setSql("UPDATE 
                                        PESSOA.PESSOA_FISICA
                                   SET
                                        ID_PESSOA = :ID_PESSOA,
                                        NOME_SOCIAL = :NOME_SOCIAL,
                                        CPF = :CPF,
                                        RG  =  :RG,
                                        ORGAO_EXPEDIDOR = :ORGAO_EXPEDIDOR,
                                        DATA_NASCIMENTO = :DATA_NASCIMENTO,
                                        GENERO = :GENERO
                                    ");
            
            // Atribuindo valores fisica
            $objDaoHelper->bindValue(":ID_PESSOA", $objPessoaFisicaVO->getId());
            $objDaoHelper->bindValue(":NOME_SOCIAL", $objPessoaFisicaVO->getNomeSocial());
            $objDaoHelper->bindValue(":CPF", $objPessoaFisicaVO->getCpf());
            $objDaoHelper->bindValue(":RG", $objPessoaFisicaVO->getRg());
            $objDaoHelper->bindValue(":ORGAO_EXPEDIDOR", $objPessoaFisicaVO->getOrgaoExpedidor());
            $objDaoHelper->bindValue(":DATA_NASCIMENTO", $objPessoaFisicaVO->getDataNascimento());
            $objDaoHelper->bindValue(":GENERO", $objPessoaFisicaVO->getGenero());
            
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
     * @param PessoaFisicaVO $objPessoaFisicaVO
     * @return boolean
     * @access public
     */
    public function excluir( PessoaFisicaVO $objPessoaFisicaVO) {


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
            $objDaoHelper->bindValue(":ID_PESSOA", $objPessoaFisicaVO->getId());
            $objDaoHelper->bindValue(":MODIFICADO_EM", $objPessoaFisicaVO->getModificadoEm());
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
     * @param PessoaFisicaVO $objPessoaFisicaVO
     * @return boolean
     * @access public
     */
    public function selecionar(PessoaFisicaVO $objPessoaFisicaVO) {


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
                                        PESSOA_FISICA.NOME_SOCIAL,
                                        PESSOA_FISICA.CPF,
                                        PESSOA_FISICA.RG,
                                        PESSOA_FISICA.ORGAO_EXPEDIDOR,
                                        PESSOA_FISICA.DATA_NASCIMENTO,
                                        PESSOA_FISICA.GENERO
                                    FROM 
                                        PESSOA.PESSOA
                                    INNER JOIN PESSOA_FISICA ON PESSOA.ID_PESSOA = PESSOA_FISICA.ID_PESSOA
                                    WHERE
                                        PESSOA.EXCLUIDO = :EXCLUIDO,
                                        PESSOA_FISICA.CPF = :CPF
                                        
                                    ");


            // Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0); //ATIVO 0 -- INATIVO 1
            $objDaoHelper->bindValue(":CPF", $objPessoaFisicaVO->getCpf());

            //echo $objDaoHelper->getSql();exit();
            // Executando comando            
            $objDaoHelper->execute();

            $objPessoaFisicaVO = false;
            // Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE.
            foreach ($objDaoHelper->fetchAll() as $pessoa) {
                $objPessoaFisicaVO = new PessoaFisicaVO();
                $objPessoaFisicaVO->bind($pessoa);
            }

            $objDaoHelper->setRetornoOperacao($objPessoaFisicaVO);

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
     * @param PessoaFisicaVO $objPessoaFisicaVO
     * @return boolean
     * @access public
     */
    public function existe(PessoaFisicaVO $objPessoaFisicaVO){


        $objDaoHelper = new DaoHelper();

        try { // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('pessoa'));
            $objDaoHelper->setSql("SELECT 
                                        COUNT(PESSOA_FISICA.CPF) as TOTAL
                                   FROM 
                                        PESSOA.PESSOA
                                   INNER JOIN PESSOA_FISICA ON PESSOA.ID_PESSOA = PESSOA_FISICA.ID_PESSOA
                                   WHERE
                                        PESSOA.EXCLUIDO = :EXCLUIDO,
                                        PESSOA_FISICA.CPF = :CPF
                                   ");
            // Atribuindo valores
            $objDaoHelper->bindValue(":EXCLUIDO", 0); //ATIVO 0 -- INATIVO 1
            $objDaoHelper->bindValue(":CPF", str_replace(array('.', '-'), '', $objPessoaFisicaVO->getCpf()));

            // Executando comando
            $objDaoHelper->execute();
            foreach ($objDaoHelper->fetchAll() as $cpf) {
                if ($cpf['TOTAL'] > 0) {
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
