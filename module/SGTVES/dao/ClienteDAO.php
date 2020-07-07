<?php

namespace module\SGTVES\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use module\SGTVES\vo\ClienteVO;
use core\helper\FormatHelper;

/**
 * Classe de persistência referente à Cliente
 * @acess public
 * @package framework
 * @subpackage dao
 */
class ClienteDAO extends AbstractDAO {

    /**
     * Método que realiza a listagem de Unidades cadastradas
     * @param ClienteVO $objClienteVO
     * @return ArrayIterator
     * @throws Excepcion em caso de erro de banco de dados
     */
    public function listar(ClienteVO $objClienteVO) {
        # Instanciando classe de apoio da camada #
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('TESTE'));


            # Comando SQL #
            $objDaoHelper->setSql("SELECT 
                                          CNPJ,
                                          NOME,
                                          NFANTASIA,
                                          LOGRADOURO,
                                          NRO,
                                          BAIRRO,
                                          MUNICIPIO,
                                          UF,
                                          CEP,
                                          PAIS,
                                          FONE,
                                          IE
                                   FROM TESTE.TBCLIENTEVS 
                                    ");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

//            if (!is_null($objClienteVO)) {
//                if (strlen($objClienteVO->getNome()) > 0) {
//                    $objDaoHelper->getStmt()->bindValue(":NOME", '%' . FormatHelper::removerAcentos($objClienteVO->getNome()) . '%');
//                }
//            }

//            echo $objDaoHelper->getSql();die;
            # Atribuindo valores #
//            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0);
//            $objDaoHelper->getStmt()->bindValue(":NOME", $objClienteVO->getNome());
//            echo $objDaoHelper->getSql(); die;
            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Instanciando classes de apoio, construindo resultado #
            $arrayIterator = new \ArrayIterator();
//            var_dump($objDaoHelper->getStmt()->fetchAll()); die;
            foreach ($objDaoHelper->getStmt()->fetchAll() as $Cliente) {
                $objClienteVO = new ClienteVO();
                $objClienteVO->bind($Cliente);
                $arrayIterator->append($objClienteVO);
            }

            # Setando retorno em caso de sucesso #
            $objDaoHelper->setRetornoOperacao($arrayIterator);

            # Fechando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retornando resultado #
        return $objDaoHelper->getRetorno();
    }

    /**
     * Método que adiciona Clientees
     * @param ClienteVO $objClienteVO
     * @return ArrayIterator
     * @throws Excepcion em caso de erro de banco de dados
     */
    public function inserir(ClienteVO $objClienteVO) {
        $objDaoHelper = new DaoHelper();

        try {
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Setando ID do grupo #
            // $objClienteVO->setId($this->getSequenceNextVal("NOVOFRAMEWORK.SEQ_Cliente", $objDaoHelper->getConexao()));
            # Comando SQL #
            $objDaoHelper->setSql("INSERT INTO NOVOFRAMEWORK.Cliente
                                  (
                                   NOME,
                                   DATA_INCLUSAO,
                                   USUARIO_INCLUSAO,
                                   EXCLUIDO)                                    
                                 VALUES 
                                 ( 
                                   :NOME,                        
                                   :DATA_INCLUSAO,
                                   :USUARIO_INCLUSAO,
                                   :EXCLUIDO)");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores (checar) #
            $objDaoHelper->getStmt()->bindValue(":NOME", $objClienteVO->getNome());
            $objDaoHelper->getStmt()->bindValue(":USUARIO_INCLUSAO", $objClienteVO->getUsuarioInclusao());
            $objDaoHelper->getStmt()->bindValue(":DATA_INCLUSAO", $objClienteVO->getDataInclusao());
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0) /* ATIVO 0 -- INATIVO 1 */;

            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
            $objDaoHelper->setRetornoOperacao(TRUE);

            # Encerrando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retorno da Resposta #
        return $objDaoHelper->getRetorno();
    }

    /**
     * Método que altera os Clientees existentes
     * @param ClienteVO $objClienteVO
     * @return mixed
     * @access public
     */
    public function alterar(ClienteVO $objClienteVO) {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL #
            $objDaoHelper->setSql("UPDATE NOVOFRAMEWORK.Cliente SE
                                    SET    DATA_ALTERACAO    = :DATA_ALTERACAO,                                          
                                           EXCLUIDO          = :EXCLUIDO,                                                                               
                                           USUARIO_ALTERACAO = :USUARIO_ALTERACAO,
                                           NOME              = :NOME
                                    WHERE  ID_Cliente          = :ID_Cliente");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0); //ATIVO 0 -- INATIVO 1
            $objDaoHelper->getStmt()->bindValue(":NOME", $objClienteVO->getNome());
            $objDaoHelper->getStmt()->bindValue(":USUARIO_ALTERACAO", $objClienteVO->getUsuarioAlteracao());
            $objDaoHelper->getStmt()->bindValue(":DATA_ALTERACAO", $objClienteVO->getDataAlteracao());
            $objDaoHelper->getStmt()->bindValue(":ID_Cliente", $objClienteVO->getId());

            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
            $objDaoHelper->setRetornoOperacao(TRUE);

            # Encerrando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retorno da Resposta #
        return $objDaoHelper->getRetorno();
    }

    /**
     * Método que exclui os Clientees existentes
     * @param ClienteVO $objClienteVO
     * @return boolean
     * @access public
     */
    public function excluir(ClienteVO $objClienteVO) {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL #
            $objDaoHelper->setSql("UPDATE NOVOFRAMEWORK.Cliente 
                                   SET    DATA_ALTERACAO    = :DATA_ALTERACAO,
                                          EXCLUIDO          = :EXCLUIDO,
                                          USUARIO_ALTERACAO = :USUARIO_ALTERACAO
                                   WHERE  ID_Cliente          = :ID_Cliente");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":ID_Cliente", $objClienteVO->getId());
            $objDaoHelper->getStmt()->bindValue(":DATA_ALTERACAO", $objClienteVO->getDataAlteracao());
            $objDaoHelper->getStmt()->bindValue(":USUARIO_ALTERACAO", $objClienteVO->getUsuarioAlteracao());
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 1);
//            var_dump($objDaoHelper->getSql()); exit;
            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
            $objDaoHelper->setRetornoOperacao(TRUE);

            # Encerrando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retorno da Resposta #
        return $objDaoHelper->getRetorno();
    }

    /**
     * Método que seleciona as Unidades existentes
     * @param $objClienteVO
     * @return boolean
     * @access public
     */
    public function selecionar($objClienteVO) {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL #
            $objDaoHelper->setSql("SELECT 
                                       ID_Cliente,
                                       NOME,                                       
                                       DATA_INCLUSAO,
                                       DATA_ALTERACAO,
                                       USUARIO_INCLUSAO,
                                       USUARIO_ALTERACAO
                                    FROM NOVOFRAMEWORK.Cliente 
                                    WHERE EXCLUIDO = :EXCLUIDO
                                    AND ID_Cliente   = :ID_Cliente");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores (checar) #
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0); # ATIVO 0 -- INATIVO 1 #
            $objDaoHelper->getStmt()->bindValue(":ID_Cliente", $objClienteVO->getId());

            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
            foreach ($objDaoHelper->getStmt()->fetchAll() as $Cliente) {
                $objClienteVO = new ClienteVO();
                $objClienteVO->bind($Cliente);
            }
            $objDaoHelper->setRetornoOperacao($objClienteVO);

            # Encerrando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retorno da Resposta #
        return $objDaoHelper->getRetorno();
    }

    /**
     * Puxa a tabela de Cliente para a combo box da tela de Funcionário
     * @return String
     */
    public function listarCombo() {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            $objDaoHelper->setSql("SELECT ID_Cliente,
                                          NOME
                                   FROM NOVOFRAMEWORK.Cliente SE
                                   WHERE EXCLUIDO = 0
                                   ORDER BY NOME");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            $objDaoHelper->getStmt()->execute();

            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->getStmt()->fetchAll() as $Cliente) {
                $objClienteVO = new ClienteVO();
                $objClienteVO->bind($Cliente);
                $arrayIterator->append($objClienteVO);
            }

            $objDaoHelper->setRetornoOperacao($arrayIterator);

            # Encerrando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retorno da Resposta #
        return $objDaoHelper->getRetorno();
    }

    /**
     * Verifica a existência de um registro
     * @param ClienteVO $objClienteVO
     * @return boolean
     * @access public
     */
    public function existe(ClienteVO $objClienteVO) {
        $objDaoHelper = new DaoHelper();
        $sqlAuxiliar = '';

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            if ($objClienteVO->getId() != null) {
                $sqlAuxiliar = ' AND ID_Cliente <> :ID_Cliente ';
            }

            $objDaoHelper->setSql("SELECT COUNT(NOME) as TOTAL
                                   FROM NOVOFRAMEWORK.Cliente SE
                                   WHERE EXCLUIDO = :EXCLUIDO
                                   AND TRANSLATE(UPPER(NOME), 'âàãáÁÂÀÃéêÉÊíÍóôõÓÔÕüúÜÚÇç', 'AAAAAAAAEEEEIIOOOOOOUUUUCC') LIKE :NOME
                                   $sqlAuxiliar");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":NOME", strtoupper(FormatHelper::removerAcentos($objClienteVO->getNome())));
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0);

            if ($objClienteVO->getId() != null) {
                $objDaoHelper->getStmt()->bindValue(":ID_Cliente", $objClienteVO->getId());
            }
//            var_dump($objDaoHelper); exit;
            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE #
            foreach ($objDaoHelper->getStmt()->fetchAll() as $Cliente) {
                if ($Cliente['total'] > 0) {
                    $objDaoHelper->setRetornoOperacao(TRUE);
                }
            }

            # Fechando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retornando resposta #
        return $objDaoHelper->getRetornoOperacao();
    }

}
