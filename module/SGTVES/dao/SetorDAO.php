<?php

namespace module\framework\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use module\framework\bo\SetorBO;
use module\framework\vo\SetorVO;
use core\helper\FormatHelper;

/**
 * Classe de persistência referente à Setor
 * @acess public
 * @package framework
 * @subpackage dao
 */
class SetorDAO extends AbstractDAO {

    /**
     * Método que realiza a listagem de Unidades cadastradas
     * @param SetorVO $objSetorVO
     * @return ArrayIterator
     * @throws Excepcion em caso de erro de banco de dados
     */
    public function listar(SetorVO $objSetorVO) {
        # Instanciando classe de apoio da camada #
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));


            # Comando SQL #
            $objDaoHelper->setSql("SELECT ID_SETOR,
                                          NOME,
                                          USUARIO_INCLUSAO,
                                          DATA_INCLUSAO
                                   FROM NOVOFRAMEWORK.SETOR SE
                                   WHERE EXCLUIDO = :EXCLUIDO
                                   AND (  UPPER(SE.NOME ) ilike UPPER( :NOME ) OR :NOME IS NULL)
                                    ");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            if (!is_null($objSetorVO)) {
                if (strlen($objSetorVO->getNome()) > 0) {
                    $objDaoHelper->getStmt()->bindValue(":NOME", '%' . FormatHelper::removerAcentos($objSetorVO->getNome()) . '%');
                }
            }
//            echo $objDaoHelper->getSql();die;
            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0);
            $objDaoHelper->getStmt()->bindValue(":NOME", $objSetorVO->getNome());
//            echo $objDaoHelper->getSql(); die;
            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Instanciando classes de apoio, construindo resultado #
            $arrayIterator = new \ArrayIterator();
//            var_dump($objDaoHelper->getStmt()->fetchAll()); die;
            foreach ($objDaoHelper->getStmt()->fetchAll() as $setor) {
                $objSetorVO = new SetorVO();
                $objSetorVO->bind($setor);
                $arrayIterator->append($objSetorVO);
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
     * Método que adiciona Setores
     * @param SetorVO $objSetorVO
     * @return ArrayIterator
     * @throws Excepcion em caso de erro de banco de dados
     */
    public function inserir(SetorVO $objSetorVO) {
        $objDaoHelper = new DaoHelper();

        try {
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Setando ID do grupo #
            // $objSetorVO->setId($this->getSequenceNextVal("NOVOFRAMEWORK.SEQ_SETOR", $objDaoHelper->getConexao()));
            # Comando SQL #
            $objDaoHelper->setSql("INSERT INTO NOVOFRAMEWORK.SETOR
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
            $objDaoHelper->getStmt()->bindValue(":NOME", $objSetorVO->getNome());
            $objDaoHelper->getStmt()->bindValue(":USUARIO_INCLUSAO", $objSetorVO->getUsuarioInclusao());
            $objDaoHelper->getStmt()->bindValue(":DATA_INCLUSAO", $objSetorVO->getDataInclusao());
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
     * Método que altera os Setores existentes
     * @param SetorVO $objSetorVO
     * @return mixed
     * @access public
     */
    public function alterar(SetorVO $objSetorVO) {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL #
            $objDaoHelper->setSql("UPDATE NOVOFRAMEWORK.SETOR SE
                                    SET    DATA_ALTERACAO    = :DATA_ALTERACAO,                                          
                                           EXCLUIDO          = :EXCLUIDO,                                                                               
                                           USUARIO_ALTERACAO = :USUARIO_ALTERACAO,
                                           NOME              = :NOME
                                    WHERE  ID_SETOR          = :ID_SETOR");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0); //ATIVO 0 -- INATIVO 1
            $objDaoHelper->getStmt()->bindValue(":NOME", $objSetorVO->getNome());
            $objDaoHelper->getStmt()->bindValue(":USUARIO_ALTERACAO", $objSetorVO->getUsuarioAlteracao());
            $objDaoHelper->getStmt()->bindValue(":DATA_ALTERACAO", $objSetorVO->getDataAlteracao());
            $objDaoHelper->getStmt()->bindValue(":ID_SETOR", $objSetorVO->getId());

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
     * Método que exclui os setores existentes
     * @param SetorVO $objSetorVO
     * @return boolean
     * @access public
     */
    public function excluir(SetorVO $objSetorVO) {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL #
            $objDaoHelper->setSql("UPDATE NOVOFRAMEWORK.SETOR 
                                   SET    DATA_ALTERACAO    = :DATA_ALTERACAO,
                                          EXCLUIDO          = :EXCLUIDO,
                                          USUARIO_ALTERACAO = :USUARIO_ALTERACAO
                                   WHERE  ID_SETOR          = :ID_SETOR");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":ID_SETOR", $objSetorVO->getId());
            $objDaoHelper->getStmt()->bindValue(":DATA_ALTERACAO", $objSetorVO->getDataAlteracao());
            $objDaoHelper->getStmt()->bindValue(":USUARIO_ALTERACAO", $objSetorVO->getUsuarioAlteracao());
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
     * @param $objSetorVO
     * @return boolean
     * @access public
     */
    public function selecionar($objSetorVO) {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL #
            $objDaoHelper->setSql("SELECT 
                                       ID_SETOR,
                                       NOME,                                       
                                       DATA_INCLUSAO,
                                       DATA_ALTERACAO,
                                       USUARIO_INCLUSAO,
                                       USUARIO_ALTERACAO
                                    FROM NOVOFRAMEWORK.SETOR 
                                    WHERE EXCLUIDO = :EXCLUIDO
                                    AND ID_SETOR   = :ID_SETOR");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores (checar) #
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0); # ATIVO 0 -- INATIVO 1 #
            $objDaoHelper->getStmt()->bindValue(":ID_SETOR", $objSetorVO->getId());

            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
            foreach ($objDaoHelper->getStmt()->fetchAll() as $setor) {
                $objSetorVO = new SetorVO();
                $objSetorVO->bind($setor);
            }
            $objDaoHelper->setRetornoOperacao($objSetorVO);

            # Encerrando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retorno da Resposta #
        return $objDaoHelper->getRetorno();
    }

    /**
     * Puxa a tabela de Setor para a combo box da tela de Funcionário
     * @return String
     */
    public function listarCombo() {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            $objDaoHelper->setSql("SELECT ID_SETOR,
                                          NOME
                                   FROM NOVOFRAMEWORK.SETOR SE
                                   WHERE EXCLUIDO = 0
                                   ORDER BY NOME");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            $objDaoHelper->getStmt()->execute();

            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->getStmt()->fetchAll() as $setor) {
                $objSetorVO = new SetorVO();
                $objSetorVO->bind($setor);
                $arrayIterator->append($objSetorVO);
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
     * @param SetorVO $objSetorVO
     * @return boolean
     * @access public
     */
    public function existe(SetorVO $objSetorVO) {
        $objDaoHelper = new DaoHelper();
        $sqlAuxiliar = '';

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            if ($objSetorVO->getId() != null) {
                $sqlAuxiliar = ' AND ID_SETOR <> :ID_SETOR ';
            }

            $objDaoHelper->setSql("SELECT COUNT(NOME) as TOTAL
                                   FROM NOVOFRAMEWORK.SETOR SE
                                   WHERE EXCLUIDO = :EXCLUIDO
                                   AND TRANSLATE(UPPER(NOME), 'âàãáÁÂÀÃéêÉÊíÍóôõÓÔÕüúÜÚÇç', 'AAAAAAAAEEEEIIOOOOOOUUUUCC') LIKE :NOME
                                   $sqlAuxiliar");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":NOME", strtoupper(FormatHelper::removerAcentos($objSetorVO->getNome())));
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0);

            if ($objSetorVO->getId() != null) {
                $objDaoHelper->getStmt()->bindValue(":ID_SETOR", $objSetorVO->getId());
            }
//            var_dump($objDaoHelper); exit;
            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE #
            foreach ($objDaoHelper->getStmt()->fetchAll() as $setor) {
                if ($setor['total'] > 0) {
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
