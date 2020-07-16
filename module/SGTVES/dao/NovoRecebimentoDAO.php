<?php

namespace module\SGTVES\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use module\SGTVES\vo\NovoRecebimentoVO;
use core\helper\FormatHelper;

/**
 * Classe de persistência referente à NovoRecebimento
 * @acess public
 * @package framework
 * @subpackage dao
 */
class NovoRecebimentoDAO extends AbstractDAO {

    /**
     * Método que realiza a listagem de Unidades cadastradas
     * @param NovoRecebimentoVO $objNovoRecebimentoVO
     * @return ArrayIterator
     * @throws Excepcion em caso de erro de banco de dados
     */
    public function listar(NovoRecebimentoVO $objNovoRecebimentoVO) {
        # Instanciando classe de apoio da camada #
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('TESTE'));


            # Comando SQL #
            $objDaoHelper->setSql("				SELECT
					rc.cnpjCliente,
					rc.placa,
					rc.dtSaida,
					rc.descricao,
					rc.observacao,
					rc.codRecebimento,			
					r.codrebecimento, 
					Format(sum(dt.pesoL),2,'de_DE') as peso_liquido, 
                    Format(SUM(dt.pesoB),2,'de_DE') as peso_Bruto,
					Format(SUM(d.vNF),2,'de_DE') as valor_total_nfes,
                    SUM(dt.qVol) as qtd_caixas,
					COUNT(r.codnfe) as Total_de_Notas
                    
                from 
					teste.tbrecebimento_nfe r, teste.nfe_det_transp dt , 
					teste.nfe_det_total d , teste.tbrecebimento rc
                where r.codnfe = dt.cNF and dt.cNF=d.cNF and r.dtrecebimento
                                    ");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

//            if (!is_null($objNovoRecebimentoVO)) {
//                if (strlen($objNovoRecebimentoVO->getNome()) > 0) {
//                    $objDaoHelper->getStmt()->bindValue(":NOME", '%' . FormatHelper::removerAcentos($objNovoRecebimentoVO->getNome()) . '%');
//                }
//            }

//            echo $objDaoHelper->getSql();die;
            # Atribuindo valores #
//            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0);
//            $objDaoHelper->getStmt()->bindValue(":NOME", $objNovoRecebimentoVO->getNome());
//            echo $objDaoHelper->getSql(); die;
            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Instanciando classes de apoio, construindo resultado #
            $arrayIterator = new \ArrayIterator();
//            var_dump($objDaoHelper->getStmt()->fetchAll()); die;
            foreach ($objDaoHelper->getStmt()->fetchAll() as $NovoRecebimento) {
                $objNovoRecebimentoVO = new NovoRecebimentoVO();
                $objNovoRecebimentoVO->setPesoBruto($NovoRecebimento['peso_Bruto']);
                $objNovoRecebimentoVO->setPesoLiquido($NovoRecebimento['peso_liquido']);
                $objNovoRecebimentoVO->setTotalNfe($NovoRecebimento['valor_total_nfes']);
                $objNovoRecebimentoVO->bind($NovoRecebimento);
                $arrayIterator->append($objNovoRecebimentoVO);
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
     * Método que adiciona NovoRecebimentoes
     * @param NovoRecebimentoVO $objNovoRecebimentoVO
     * @return ArrayIterator
     * @throws Excepcion em caso de erro de banco de dados
     */
    public function inserir(NovoRecebimentoVO $objNovoRecebimentoVO) {
        $objDaoHelper = new DaoHelper();

        try {
            $objDaoHelper->setConexao(parent::getInstance('TESTE'));

            # Setando ID do grupo #
            // $objNovoRecebimentoVO->setId($this->getSequenceNextVal("NOVOFRAMEWORK.SEQ_NovoRecebimento", $objDaoHelper->getConexao()));
            # Comando SQL #
            $objDaoHelper->setSql("INSERT INTO TESTE.TBRECEBIMENTO
                                  (
                                   cnpjCliente,
                                   placa,
                                   dtSaida,
                                   descricao,
                                   observacao)                                    
                                 VALUES 
                                 ( 
                                   :cnpjCliente,
                                   :placa,
                                   :dtSaida,
                                   :descricao,
                                   :observacao)");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores (checar) #
            $objDaoHelper->getStmt()->bindValue(":cnpjCliente", $objNovoRecebimentoVO->getCnpjCliente());
            $objDaoHelper->getStmt()->bindValue(":placa", $objNovoRecebimentoVO->getPlaca());
            $objDaoHelper->getStmt()->bindValue(":dtSaida", $objNovoRecebimentoVO->getDataSaida());
            $objDaoHelper->getStmt()->bindValue(":descricao", $objNovoRecebimentoVO->getDescricao());
            $objDaoHelper->getStmt()->bindValue(":observacao", $objNovoRecebimentoVO->getObservacao());

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
     * Método que altera os NovoRecebimentoes existentes
     * @param NovoRecebimentoVO $objNovoRecebimentoVO
     * @return mixed
     * @access public
     */
    public function alterar(NovoRecebimentoVO $objNovoRecebimentoVO) {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL #
            $objDaoHelper->setSql("UPDATE NOVOFRAMEWORK.NovoRecebimento SE
                                    SET    DATA_ALTERACAO    = :DATA_ALTERACAO,                                          
                                           EXCLUIDO          = :EXCLUIDO,                                                                               
                                           USUARIO_ALTERACAO = :USUARIO_ALTERACAO,
                                           NOME              = :NOME
                                    WHERE  ID_NovoRecebimento          = :ID_NovoRecebimento");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0); //ATIVO 0 -- INATIVO 1
            $objDaoHelper->getStmt()->bindValue(":NOME", $objNovoRecebimentoVO->getNome());
            $objDaoHelper->getStmt()->bindValue(":USUARIO_ALTERACAO", $objNovoRecebimentoVO->getUsuarioAlteracao());
            $objDaoHelper->getStmt()->bindValue(":DATA_ALTERACAO", $objNovoRecebimentoVO->getDataAlteracao());
            $objDaoHelper->getStmt()->bindValue(":ID_NovoRecebimento", $objNovoRecebimentoVO->getId());

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
     * Método que exclui os NovoRecebimentoes existentes
     * @param NovoRecebimentoVO $objNovoRecebimentoVO
     * @return boolean
     * @access public
     */
    public function excluir(NovoRecebimentoVO $objNovoRecebimentoVO) {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL #
            $objDaoHelper->setSql("UPDATE NOVOFRAMEWORK.NovoRecebimento 
                                   SET    DATA_ALTERACAO    = :DATA_ALTERACAO,
                                          EXCLUIDO          = :EXCLUIDO,
                                          USUARIO_ALTERACAO = :USUARIO_ALTERACAO
                                   WHERE  ID_NovoRecebimento          = :ID_NovoRecebimento");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":ID_NovoRecebimento", $objNovoRecebimentoVO->getId());
            $objDaoHelper->getStmt()->bindValue(":DATA_ALTERACAO", $objNovoRecebimentoVO->getDataAlteracao());
            $objDaoHelper->getStmt()->bindValue(":USUARIO_ALTERACAO", $objNovoRecebimentoVO->getUsuarioAlteracao());
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
     * @param $objNovoRecebimentoVO
     * @return boolean
     * @access public
     */
    public function selecionar($objNovoRecebimentoVO) {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL #
            $objDaoHelper->setSql("SELECT 
                                       ID_NovoRecebimento,
                                       NOME,                                       
                                       DATA_INCLUSAO,
                                       DATA_ALTERACAO,
                                       USUARIO_INCLUSAO,
                                       USUARIO_ALTERACAO
                                    FROM NOVOFRAMEWORK.NovoRecebimento 
                                    WHERE EXCLUIDO = :EXCLUIDO
                                    AND ID_NovoRecebimento   = :ID_NovoRecebimento");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores (checar) #
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0); # ATIVO 0 -- INATIVO 1 #
            $objDaoHelper->getStmt()->bindValue(":ID_NovoRecebimento", $objNovoRecebimentoVO->getId());

            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
            foreach ($objDaoHelper->getStmt()->fetchAll() as $NovoRecebimento) {
                $objNovoRecebimentoVO = new NovoRecebimentoVO();
                $objNovoRecebimentoVO->bind($NovoRecebimento);
            }
            $objDaoHelper->setRetornoOperacao($objNovoRecebimentoVO);

            # Encerrando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retorno da Resposta #
        return $objDaoHelper->getRetorno();
    }

    /**
     * Puxa a tabela de NovoRecebimento para a combo box da tela de Funcionário
     * @return String
     */
    public function listarCombo() {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            $objDaoHelper->setSql("SELECT ID_NovoRecebimento,
                                          NOME
                                   FROM NOVOFRAMEWORK.NovoRecebimento SE
                                   WHERE EXCLUIDO = 0
                                   ORDER BY NOME");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            $objDaoHelper->getStmt()->execute();

            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->getStmt()->fetchAll() as $NovoRecebimento) {
                $objNovoRecebimentoVO = new NovoRecebimentoVO();
                $objNovoRecebimentoVO->bind($NovoRecebimento);
                $arrayIterator->append($objNovoRecebimentoVO);
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
     * @param NovoRecebimentoVO $objNovoRecebimentoVO
     * @return boolean
     * @access public
     */
    public function existe(NovoRecebimentoVO $objNovoRecebimentoVO) {
        $objDaoHelper = new DaoHelper();
        $sqlAuxiliar = '';

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            if ($objNovoRecebimentoVO->getId() != null) {
                $sqlAuxiliar = ' AND ID_NovoRecebimento <> :ID_NovoRecebimento ';
            }

            $objDaoHelper->setSql("SELECT COUNT(NOME) as TOTAL
                                   FROM NOVOFRAMEWORK.NovoRecebimento SE
                                   WHERE EXCLUIDO = :EXCLUIDO
                                   AND TRANSLATE(UPPER(NOME), 'âàãáÁÂÀÃéêÉÊíÍóôõÓÔÕüúÜÚÇç', 'AAAAAAAAEEEEIIOOOOOOUUUUCC') LIKE :NOME
                                   $sqlAuxiliar");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":NOME", strtoupper(FormatHelper::removerAcentos($objNovoRecebimentoVO->getNome())));
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0);

            if ($objNovoRecebimentoVO->getId() != null) {
                $objDaoHelper->getStmt()->bindValue(":ID_NovoRecebimento", $objNovoRecebimentoVO->getId());
            }
//            var_dump($objDaoHelper); exit;
            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE #
            foreach ($objDaoHelper->getStmt()->fetchAll() as $NovoRecebimento) {
                if ($NovoRecebimento['total'] > 0) {
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
