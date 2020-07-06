<?php

namespace module\SGTVES\dao;

use core\dao\AbstractDAO;
use core\helper\DaoHelper;
use module\SGTVES\bo\UsuarioBO;
use module\SGTVES\vo\UsuarioVO;
use core\helper\FormatHelper;
use core\helper\SafeHelper;

/**
 * Classe de persistência referente à Usuario
 * @acess public
 * @package SGTVES
 * @subpackage dao
 */
class UsuarioDAO extends AbstractDAO {

    /**
     * Método que realiza a listagem de Unidades cadastradas
     * @param UsuarioVO $objUsuarioVO
     * @return ArrayIterator
     * @throws Excepcion em caso de erro de banco de dados
     */
    public function listar(UsuarioVO $objUsuarioVO) {
        # Instanciando classe de apoio da camada #
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('NOVOFRAMEWORK'));


            # Comando SQL #
            $objDaoHelper->setSql("SELECT ID_Usuario,
                                          NOME,
                                          USUARIO_INCLUSAO,
                                          DATA_INCLUSAO
                                   FROM NOVOFRAMEWORK.Usuario SE
                                   WHERE EXCLUIDO = :EXCLUIDO
                                   AND (  UPPER(SE.NOME ) ilike UPPER( :NOME ) OR :NOME IS NULL)
                                    ");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            if (!is_null($objUsuarioVO)) {
                if (strlen($objUsuarioVO->getNome()) > 0) {
                    $objDaoHelper->getStmt()->bindValue(":NOME", '%' . FormatHelper::removerAcentos($objUsuarioVO->getNome()) . '%');
                }
            }
//            echo $objDaoHelper->getSql();die;
            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":EXCLUIDO", 0);
            $objDaoHelper->getStmt()->bindValue(":NOME", $objUsuarioVO->getNome());
//            echo $objDaoHelper->getSql(); die;
            # Executando comando #
            $objDaoHelper->getStmt()->execute();

            # Instanciando classes de apoio, construindo resultado #
            $arrayIterator = new \ArrayIterator();
//            var_dump($objDaoHelper->getStmt()->fetchAll()); die;
            foreach ($objDaoHelper->getStmt()->fetchAll() as $Usuario) {
                $objUsuarioVO = new UsuarioVO();
                $objUsuarioVO->bind($Usuario);
                $arrayIterator->append($objUsuarioVO);
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


    public function autenticar(UsuarioVO $objUsuarioVO) {
        $objDaoHelper = new DaoHelper();
        
        try {
            
            // Obtendo conexao
            // echo "aqui" ;die;
            $objDaoHelper->setConexao(parent::getInstance('TESTE'));
            
            // Comando SQL
            $objDaoHelper->setSql("SELECT COUNT(U.USERS) AS TOTAL
                                        FROM TESTE.TBUSERS U
                                    WHERE 
                                        U.USERS = :USERS
                                        AND U.PASSWORD = :PASSWORD");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));
            // Atribuindo valores
            $objDaoHelper->getStmt()->bindValue(":USERS", $objUsuarioVO->getUsers());
            $objDaoHelper->getStmt()->bindValue(":PASSWORD", $objUsuarioVO->getPassword());

            // Executando comando
            // echo $objDaoHelper->getSql();die;
            $objDaoHelper->getStmt()->execute();
            // Obtendo resposta
            foreach ($objDaoHelper->getStmt()->fetchAll() as $autenticar) {
                if ($autenticar['TOTAL'] > 0) {
                    $objDaoHelper->setRetornoOperacao(TRUE);
                }
            }

            //Fechando conexão
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        // Retornando resposta
        return $objDaoHelper->getRetorno();
    }


    /**
     * Método que seleciona os Funcionários existentes
     * @param $objUsuarioVO
     * @return boolean
     * @access public
     */
    public function selecionarByUsers($objUsuarioVO) {
        $objDaoHelper = new DaoHelper();

        try {
            # Obtendo conexão #
            $objDaoHelper->setConexao(parent::getInstance('TESTE'));

            # Comando SQL #
            $objDaoHelper->setSql("SELECT
                                    U.IDUSERS,
                                    U.USERS,
                                    U.PASSWORD,
                                    U.NAMEUSERS,
                                    U.STATUSUSERS
                                  FROM TESTE.TBUSERS U
                                  WHERE 
                                     U.USERS = :USERS");

            $objDaoHelper->setStmt($objDaoHelper->getConexao()->prepare($objDaoHelper->getSql()));

            # Atribuindo valores #
            $objDaoHelper->getStmt()->bindValue(":USERS", $objUsuarioVO->getUsers());
                    //    echo $objDaoHelper->getSql(); exit;
                       
                       # Executando comando #
                       $objDaoHelper->getStmt()->execute();
                       # Setando retorno em caso de sucesso. Por padrão setRetornoOperacao é FALSE. #
                       foreach ($objDaoHelper->getStmt()->fetchAll() as $Usuario) {
                           $objUsuarioVO = new UsuarioVO();
                           $objUsuarioVO->bind($Usuario);
                        //    var_dump($objUsuarioVO->getUsers());die;
            }
            $objDaoHelper->setRetornoOperacao($objUsuarioVO);

            # Encerrando conexão #
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        # Retorno da Resposta #
        return $objDaoHelper->getRetorno();
    }

}