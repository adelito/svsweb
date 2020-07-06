<?php

namespace module\framework\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use module\framework\vo\FuncionarioVO;
use core\helper\FormatHelper;
use core\helper\SafeHelper;

/**
 * Classe de persistência referente à Unidade
 * @acess public
 * @package framework
 * @subpackage dao
 */
class FuncionarioDAO extends AbstractDAO {

    /**
     * Método que realiza a listagem de Funcionários cadastrados
     * @param FuncionarioVO $objFuncionarioVO
     * @return ArrayIterator
     * @throws Excepcion em caso de erro de banco de dados
     */
    public function listar(FuncionarioVO $objFuncionarioVO) {
        # Instanciando classe de apoio da camada #
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));


            # Comando SQL #
            $objDaoHelper->setSql("SELECT FC.ID_FUNCIONARIO_USUARIO,
                                          FC.ID_SETOR,
                                          FC.MATRICULA,
                                          FC.NOME,
                                          FC.PASSOWORD,
                                          FC.CPF,
                                          FC.TELEFONE,
                                          FC.CELULAR,
                                          FC.EMAIL,
                                          FC.TIPO_USUARIO,
                                          SE.NOME AS NOME_SETOR
                                   FROM NOVOFRAMEWORK.FUNCIONARIO_USUARIO FC
                                   INNER JOIN NOVOFRAMEWORK.SETOR SE ON FC.ID_SETOR = SE.ID_SETOR
                                   WHERE FC.EXCLUIDO = 0
                                   AND (FC.CPF = :CPF OR :CPF IS NULL)
                                   AND (FC.MATRICULA = :MATRICULA OR :MATRICULA IS NULL)
                                   AND (  UPPER(FC.NOME ) like UPPER( :NOME ) OR :NOME IS NULL)
                                   ORDER BY FC.NOME ASC");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            
            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":MATRICULA", $objFuncionarioVO->getMatricula());
            $objDaoHelper->getStmt()->bindValue(":NOME", '%'.$objFuncionarioVO->getNome().'%');
            $objDaoHelper->getStmt()->bindValue(":CPF", $objFuncionarioVO->getCpf());

                    //    echo $objDaoHelper->getSql(); exit;
            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Instanciando classes de apoio, construindo resultado #
            $arrayIterator = new \ArrayIterator();
            foreach ($objDaoHelper->getStmt()->fetchAll() as $funcionario) {
                $objFuncionarioVO = new FuncionarioVO();
                $objFuncionarioVO->bind($funcionario);
                $objFuncionarioVO->getIdSetor()->setNome($funcionario['nome_setor']);
                $arrayIterator->append($objFuncionarioVO);
            }

            # Setando retorno em caso de sucesso #
            $objDaoHelper->setRetornoOperacao($arrayIterator);

            # Fechando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retornando resposta #
        return $objDaoHelper->getRetorno();
    }

    /**
     * Método que adiciona Unidades
     * @param FuncionarioVO $objFuncionarioVO
     * @return ArrayIterator
     * @throws Excepcion em caso de erro de banco de dados
     */
    public function inserir(FuncionarioVO $objFuncionarioVO) {

        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Setando ID do grupo #
            // $objFuncionarioVO->setId($this->getSequenceNextVal("NOVOFRAMEWORK.SEQ_FUNCIONARIO_USUARIO", $objDaoHelper->getConexao()));
            # Comando SQL #
            $objDaoHelper->setSql("INSERT INTO NOVOFRAMEWORK.FUNCIONARIO_USUARIO
                               (
                                ID_SETOR,
                                MATRICULA,
                                NOME,
                                PASSOWORD,
                                CPF,
                                TELEFONE,
                                CELULAR,
                                EMAIL,
                                TIPO_USUARIO,
                                DATA_INCLUSAO,
                                USUARIO_INCLUSAO,
                                EXCLUIDO)
                             VALUES
                             (
                                :ID_SETOR,
                                :MATRICULA,
                                :NOME,
                                :PASSOWORD,
                                :CPF,
                                :TELEFONE,
                                :CELULAR,
                                :EMAIL,
                                :TIPO_USUARIO,
                                :DATA_INCLUSAO,
                                :USUARIO_INCLUSAO,
                                :EXCLUIDO)");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":ID_SETOR", $objFuncionarioVO->getIdSetor()->getId());
            $objDaoHelper->getStmt()->bindValue(":MATRICULA", $objFuncionarioVO->getMatricula());
            $objDaoHelper->getStmt()->bindValue(":NOME", $objFuncionarioVO->getNome());
            $objDaoHelper->getStmt()->bindValue(":CPF", FormatHelper::removeMask($objFuncionarioVO->getCpf()));
            $objDaoHelper->getStmt()->bindValue(":PASSOWORD", SafeHelper::generateRaseahash($objFuncionarioVO->getSenha()));
            $objDaoHelper->getStmt()->bindValue(":TELEFONE", FormatHelper::removeMask($objFuncionarioVO->getTelefone()));
            $objDaoHelper->getStmt()->bindValue(":CELULAR", FormatHelper::removeMask($objFuncionarioVO->getCelular()));
            $objDaoHelper->getStmt()->bindValue(":TIPO_USUARIO", $objFuncionarioVO->getTipoUsuario());
            $objDaoHelper->getStmt()->bindValue(":EMAIL", $objFuncionarioVO->getEmail());

            $objDaoHelper->getStmt()->bindValue(":DATA_INCLUSAO", $objFuncionarioVO->getDataInclusao());
            $objDaoHelper->getStmt()->bindValue(":USUARIO_INCLUSAO", $objFuncionarioVO->getUsuarioInclusao());
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0);
            //            echo $objDaoHelper->getSql(); die;
            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
            $objDaoHelper->setRetornoOperacao(TRUE);

            # Fechando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retornando resposta #
        return $objDaoHelper->getRetorno();
    }

    /**
     * Método que altera as Unidades existentes
     * @param FuncionarioVO $objFuncionarioVO
     * @return mixed
     * @access public
     */
    public function alterar(FuncionarioVO $objFuncionarioVO) {
       $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL (checar) #
            $objDaoHelper->setSql("UPDATE NOVOFRAMEWORK.FUNCIONARIO_USUARIO
                                    SET     NOME                   = :NOME,
                                            ID_SETOR               = :ID_SETOR,
                                            CPF                    = :CPF,
                                            TELEFONE               = :TELEFONE,
                                            CELULAR                = :CELULAR,
                                            EMAIL                  = :EMAIL,
                                            TIPO_USUARIO           = :TIPO_USUARIO,
                                            DATA_ALTERACAO         = :DATA_ALTERACAO,
                                            USUARIO_ALTERACAO      = :USUARIO_ALTERACAO
                                    WHERE   
                                            ID_FUNCIONARIO_USUARIO = :ID_FUNCIONARIO_USUARIO ");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));
            
            # Atribuindo valores (checar) #
            $objDaoHelper->getStmt()->bindValue(":ID_FUNCIONARIO_USUARIO", $objFuncionarioVO->getId());
            $objDaoHelper->getStmt()->bindValue(":ID_SETOR", $objFuncionarioVO->getIdSetor()->getId());
            $objDaoHelper->getStmt()->bindValue(":NOME", $objFuncionarioVO->getNome());
            $objDaoHelper->getStmt()->bindValue(":CPF", FormatHelper::removeMask($objFuncionarioVO->getCpf()));
            $objDaoHelper->getStmt()->bindValue(":TELEFONE", FormatHelper::removeMask($objFuncionarioVO->getTelefone()));
            $objDaoHelper->getStmt()->bindValue(":CELULAR", FormatHelper::removeMask($objFuncionarioVO->getCelular()));
            $objDaoHelper->getStmt()->bindValue(":EMAIL", $objFuncionarioVO->getEmail());
            $objDaoHelper->getStmt()->bindValue(":TIPO_USUARIO", $objFuncionarioVO->getTipoUsuario());
            $objDaoHelper->getStmt()->bindValue(":DATA_ALTERACAO", $objFuncionarioVO->getDataAlteracao());
            $objDaoHelper->getStmt()->bindValue(":USUARIO_ALTERACAO", $objFuncionarioVO->getUsuarioAlteracao());
            // var_dump($objFuncionarioVO->getId());die;

            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
            $objDaoHelper->setRetornoOperacao(true);

            # Encerrando conexão #
            // $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retorno da Resposta #
        return $objDaoHelper->getRetorno();
    }

    /**
     * Método que exclui os Funcionários existentes
     * @param FuncionarioVO $objFuncionarioVO
     * @return boolean
     * @access public
     */
    public function excluir(FuncionarioVO $objFuncionarioVO) {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL #
            $objDaoHelper->setSql("UPDATE NOVOFRAMEWORK.FUNCIONARIO_USUARIO 
                                    SET   DATA_ALTERACAO      = :DATA_ALTERACAO,
                                        USUARIO_ALTERACAO   = :USUARIO_ALTERACAO,
                                          EXCLUIDO            = :EXCLUIDO
                                    WHERE ID_FUNCIONARIO_USUARIO = :ID_FUNCIONARIO_USUARIO");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuiindo valores #
            $objDaoHelper->getStmt()->bindValue(":DATA_ALTERACAO", $objFuncionarioVO->getDataAlteracao());
            $objDaoHelper->getStmt()->bindValue(":USUARIO_ALTERACAO", $objFuncionarioVO->getUsuarioAlteracao());
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 1);
            $objDaoHelper->getStmt()->bindValue(":ID_FUNCIONARIO_USUARIO", $objFuncionarioVO->getId());

            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
            $objDaoHelper->setRetornoOperacao(TRUE);

            # Fechando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retornando resposta #
        return $objDaoHelper->getRetorno();
    }

    /**
     * Método que seleciona os Funcionários existentes
     * @param $objFuncionarioVO
     * @return boolean
     * @access public
     */
    public function selecionar($objFuncionarioVO) {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL #
            $objDaoHelper->setSql("SELECT
                                    FC.ID_FUNCIONARIO_USUARIO,
                                    FC.ID_SETOR,
                                    FC.MATRICULA,
                                    FC.NOME,
                                    FC.CPF,
                                    FC.TELEFONE,
                                    FC.CELULAR,
                                    FC.PASSOWORD,
                                    FC.EMAIL,
                                    FC.TIPO_USUARIO,
                                    FC.DATA_INCLUSAO,
                                    FC.DATA_ALTERACAO,
                                    FC.USUARIO_INCLUSAO,
                                    FC.USUARIO_ALTERACAO
                                  FROM NOVOFRAMEWORK.FUNCIONARIO_USUARIO FC
                                  WHERE FC.EXCLUIDO             = :EXCLUIDO
                                  AND FC.ID_FUNCIONARIO_USUARIO = :ID_FUNCIONARIO_USUARIO");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0);
            $objDaoHelper->getStmt()->bindValue(":ID_FUNCIONARIO_USUARIO", $objFuncionarioVO->getId());
            //            echo $objDaoHelper->getSql(); exit;
            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
            foreach ($objDaoHelper->getStmt()->fetchAll() as $funcionario) {
                $objFuncionarioVO = new FuncionarioVO();
                $objFuncionarioVO->bind($funcionario);
            }
            $objDaoHelper->setRetornoOperacao($objFuncionarioVO);

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
     * @param FuncionarioVO $objFuncionarioVO, $exceto = FALSE
     * @return boolean
     * @access public
     */
    public function existeMatricula(FuncionarioVO $objFuncionarioVO, $exceto = FALSE) {

        $objDaoHelper = new DaoHelper();
        $sqlAuxiliar = '';

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            if ($exceto || $objFuncionarioVO->getId() != null) {
                $sqlAuxiliar = ' AND ID_FUNCIONARIO_USUARIO <> :ID_FUNCIONARIO_USUARIO ';
            }

            # Comando SQL #
            $objDaoHelper->setSql("SELECT COUNT(MATRICULA) as TOTAL
                                    FROM NOVOFRAMEWORK.FUNCIONARIO_USUARIO 
                                    WHERE EXCLUIDO = :EXCLUIDO
                                    AND MATRICULA = :MATRICULA
                                    $sqlAuxiliar");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":MATRICULA", $objFuncionarioVO->getMatricula());
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0);

            if ($exceto) {
                $objDaoHelper->getStmt()->bindValue(":ID_FUNCIONARIO_USUARIO", $objFuncionarioVO->getId());
            }

            # Executando comando #
            //            echo $objDaoHelper->getSql(); die;
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE #
            foreach ($objDaoHelper->getStmt()->fetchAll() as $funcionario) {
                if ($funcionario['total'] > 0) {
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

    /**
     * Puxa a tabela de Setor para a combo box da tela de Funcionario
     * @return String
     */
    public function listarCombo() {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo Conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL #
            $objDaoHelper->setSql("SELECT FC.ID_SETOR,
                                          FC.NOME
                                   FROM NOVOFRAMEWORK.FUNCIONARIO_USUARIO FC
                                   WHERE FC.EXCLUIDO = 0
                                   ORDER BY NOME");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->getStmt()->fetchAll() as $funcionario) {
                $objFuncionarioVO = new FuncionarioVO();
                var_dump($funcionario);
                $objFuncionarioVO->bind($funcionario);
                $arrayIterator->append($objFuncionarioVO);
            }

            $objDaoHelper->setRetornoOperacao($arrayIterator);

            # Fechando Conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retornando resposta #
        return $objDaoHelper->getRetorno();
    }

    public function autenticar(FuncionarioVO $objFuncionarioVO) {
        $objDaoHelper = new DaoHelper();

        try {

            // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            // Comando SQL
            $objDaoHelper->setSql("SELECT COUNT(FU.CPF) AS TOTAL
                                        FROM NOVOFRAMEWORK.FUNCIONARIO_USUARIO FU
                                    WHERE 
                                        FU.CPF = :CPF
                                        AND FU.EXCLUIDO = :EXCLUIDO
                                        AND FU.PASSOWORD = :PASSOWORD");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));
            // Atribuindo valores
            $objDaoHelper->getStmt()->bindValue(":CPF", FormatHelper::removeMask($objFuncionarioVO->getCpf(), '###.###.###-##'));
            $objDaoHelper->getStmt()->bindValue(":PASSOWORD", SafeHelper::generateRaseahash($objFuncionarioVO->getSenha()));
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0);

            // Executando comando
            // echo $objDaoHelper->getSql();die;
            $objDaoHelper->getStmt()->execute();
            // Obtendo resposta
            foreach ($objDaoHelper->getStmt()->fetchAll() as $autenticar) {
                if ($autenticar['total'] > 0) {
                    $objDaoHelper->setRetornoOperacao(TRUE);
                }
            }

            //Fechando conexão
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            //      LogManipulador::registrar(__CLASS__, __FUNCTION__, $ex->getMessage());
            throw new \Exception($ex->getMessage());
        }

        // Retornando resposta
        return $objDaoHelper->getRetorno();
    }

    /**
     * Método que seleciona os Funcionários existentes
     * @param $objFuncionarioVO
     * @return boolean
     * @access public
     */
    public function selecionarByCpf($objFuncionarioVO) {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            # Comando SQL #
            $objDaoHelper->setSql("SELECT
                                    FC.ID_FUNCIONARIO_USUARIO,
                                    FC.ID_SETOR,
                                    FC.MATRICULA,
                                    FC.NOME,
                                    FC.CPF,
                                    FC.TELEFONE,
                                    FC.CELULAR,
                                    FC.EMAIL,
                                    FC.TIPO_USUARIO,
                                    FC.DATA_INCLUSAO,
                                    FC.DATA_ALTERACAO,
                                    FC.USUARIO_INCLUSAO,
                                    FC.USUARIO_ALTERACAO
                                  FROM NOVOFRAMEWORK.FUNCIONARIO_USUARIO FC
                                  WHERE 
                                  FC.EXCLUIDO = :EXCLUIDO
                                  AND FC.CPF = :CPF");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0);
            $objDaoHelper->getStmt()->bindValue(":CPF", $objFuncionarioVO->getCpf());
            //            echo $objDaoHelper->getSql(); exit;
            # Executando comando #
            $objDaoHelper->getStmt()->execute();
            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
            foreach ($objDaoHelper->getStmt()->fetchAll() as $funcionario) {
                $objFuncionarioVO = new FuncionarioVO();
                $objFuncionarioVO->bind($funcionario);
            }
            $objDaoHelper->setRetornoOperacao($objFuncionarioVO);

            # Encerrando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retorno da Resposta #
        return $objDaoHelper->getRetorno();
    }

    public function alterarSenha(FuncionarioVO $objFuncionarioVO) {

        $objDaoHelper = new DaoHelper();

        try {
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            $objDaoHelper->setSql("UPDATE NOVOFRAMEWORK.FUNCIONARIO_USUARIO
                                    SET 
                                        PASSOWORD = :PASSWORD 
                                    WHERE 
                                        ( CPF = :CPF OR CPF = :CPFCOMMASCARA) ");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            $objDaoHelper->getStmt()->bindValue(":PASSWORD", SafeHelper::generateRaseahash($objFuncionarioVO->getNovaSenha()));
            $objDaoHelper->getStmt()->bindValue(":CPFCOMMASCARA", FormatHelper::Cpf($objFuncionarioVO->getCpf()));
            $objDaoHelper->getStmt()->bindValue(":CPF", $objFuncionarioVO->getCpf());

//            var_dump($objFuncionarioVO->getCpf());die;

            $objDaoHelper->getStmt()->execute();

            $objDaoHelper->setRetornoOperacao(TRUE);

            $objDaoHelper->setConexao(NULL);
        } catch (\Exception $ex) {

            throw new \Exception($ex->getMessage());
        }

        return $objDaoHelper->getRetorno();
    }

    public function obterEmail(FuncionarioVO $objFuncionarioVO) {

        $objDaoHelper = new DaoHelper();

        try {

            // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            // Comando SQL

            $objDaoHelper->setSql("SELECT FU.EMAIL 
                                    FROM NOVOFRAMEWORK.FUNCIONARIO_USUARIO FU
                                    WHERE FU.CPF = :CPF");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            // Atribuindo valores
            $objDaoHelper->getStmt()->bindValue(":CPF", $objFuncionarioVO->getCpf());

            // Executando comando
            $objDaoHelper->getStmt()->execute();

            // Obtendo resposta
            $objFuncionarioVO = new FuncionarioVO();
            foreach ($objDaoHelper->getStmt()->fetchAll() as $funcionario) {
                $objFuncionarioVO->bind($funcionario);
            }
            $objDaoHelper->setRetornoOperacao($objFuncionarioVO->getEmail());

            //Fechando conexão
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        // Retornando resposta
        return $objDaoHelper->getRetorno();
    }

    /**
     * Verifica a existência de um registro
     * @param FuncionarioVO $objFuncionarioVO, $exceto = FALSE
     * @return boolean
     * @access public
     */
    public function existeCpf(FuncionarioVO $objFuncionarioVO, $exceto = FALSE) {

        $objDaoHelper = new DaoHelper();
        $sqlAuxiliar = '';

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));

            if ($exceto || $objFuncionarioVO->getId() != null) {
                $sqlAuxiliar = ' AND ID_FUNCIONARIO_USUARIO <> :ID_FUNCIONARIO_USUARIO ';
            }

            # Comando SQL #
            $objDaoHelper->setSql("SELECT COUNT(CPF) as TOTAL
                                    FROM NOVOFRAMEWORK.FUNCIONARIO_USUARIO 
                                    WHERE EXCLUIDO = :EXCLUIDO
                                    AND CPF = :CPF
                                    $sqlAuxiliar");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":CPF", $objFuncionarioVO->getCpf());
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0);

            if ($exceto) {
                $objDaoHelper->getStmt()->bindValue(":ID_FUNCIONARIO_USUARIO", $objFuncionarioVO->getId());
            }

            # Executando comando #
                    //    echo $objDaoHelper->getSql(); die;
            $objDaoHelper->getStmt()->execute();

            # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE #
            foreach ($objDaoHelper->getStmt()->fetchAll() as $funcionario) {
                if ($funcionario['total'] > 0) {
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