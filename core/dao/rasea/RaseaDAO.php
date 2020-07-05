<?php

namespace core\dao\rasea;

use core\factory\CoreConnectionFactory;
use core\helper\DaoHelper;
use core\helper\LogHelper;
use PDO;
use core\vo\rasea\RaseaVO;
use core\helper\SafeHelper;
use core\helper\FormatHelper;

/**
 * Classe de persistência Rasea
 * @package core
 * @subpackage dao
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
class RaseaDAO extends CoreConnectionFactory {

    public function autenticar(RaseaVO $objRaseaVO) {

        $objDaoHelper = new DaoHelper();

        try {

            // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            // Comando SQL

            $objDaoHelper->setSql("SELECT COUNT(RU.USERNAME) AS TOTAL FROM SEG.R_APPLICATION RA
                                                INNER JOIN SEG.R_ROLE RR ON RA.ID = RR.APPLICATION_ID
                                                INNER JOIN SEG.R_USER_ASSIGNMENT RUA ON RR.ID = RUA.ROLE_ID
                                                INNER JOIN SEG.R_USER RU ON RUA.USERNAME = RU.USERNAME
                                                WHERE (RU.USERNAME = :USERNAME OR RU.USERNAME = :USNMASK)
                                                AND RA.NAME = :APPLICATION
                                                AND RU.PASSWORD = :PASSWORD");

            // Atribuindo valores
            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());
            $objDaoHelper->bindValue(":USNMASK", FormatHelper::mask($objRaseaVO->getUsuarioLogin(), '###.###.###-##'));
            $objDaoHelper->bindValue(":PASSWORD", SafeHelper::generateRaseahash($objRaseaVO->getUsuarioSenha()));
            $objDaoHelper->bindValue(":APPLICATION", $objRaseaVO->getAplicacaoNome());

            // Executando comando
            $objDaoHelper->execute();

            // Obtendo resposta
            foreach ($objDaoHelper->fetchAll() as $ret) {
                if ($ret['TOTAL'] > 0) {
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

    public function getRecursosPermissoes(RaseaVO $objRaseaVO) {


        $objDaoHelper = new DaoHelper();

        try {

            // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));


            $objDaoHelper->setSql("SELECT                                          
                                    RU.EMAIL as USUARIO_EMAIL, 
                                        RU.USERNAME as USUARIO_LOGIN, 
                                        RU.DISPLAYNAME as USUARIO_NOME, 
                                        RA.DESCRIPTION as APLICACAO_NOME,
                                        RA.ID as APLICACAO_ID,
                                        RE.NAME as RECURSO_NOME,
                                        RE.ID as RECURSO_ID,
                                        RO.NAME as ACAO_NOME,
                                        RO.ID as ACAO_ID,
                                        PA.ALLOWED as PERMITIDO,
                                        RR.DESCRIPTION as PERFIL_DESCRICAO,
                                        RR.NAME as PERFIL_NOME,
                                        RR.ID as PERFIL_ID
                                            FROM 
                                                     SEG.R_PERMISSION_ASSIGNMENT PA
                                                     INNER JOIN SEG.R_OPERATION RO ON RO.ID  = PA.OPERATION_ID
                                                     INNER JOIN SEG.R_ROLE RR ON  RR.ID = PA.ROLE_ID                                                     
                                                     INNER JOIN SEG.R_APPLICATION RA ON RA.ID = RR.APPLICATION_ID
                                                     INNER JOIN SEG.R_RESOURCE RE ON RE.ID = PA.RESOURCE_ID  
                                                      INNER JOIN SEG.R_USER_ASSIGNMENT RUA ON RUA.ROLE_ID = RR.ID
                                            INNER JOIN SEG.R_USER RU ON  RU.USERNAME = RUA.USERNAME 
                                            WHERE (RU.USERNAME = :USERNAME OR RU.USERNAME = :USNMASK)
                                            AND RA.NAME = :APPLICATION
                                            AND PA.ALLOWED = :ALLOWED

                                         ");


            // Atribuindo valores

            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());
            $objDaoHelper->bindValue(":USNMASK", FormatHelper::mask($objRaseaVO->getUsuarioLogin(), '###.###.###-##'));
            $objDaoHelper->bindValue(":APPLICATION", $objRaseaVO->getAplicacaoNome());
            $objDaoHelper->bindValue(":ALLOWED", 1);

            // Executando comando
            $objDaoHelper->execute();

            // Instanciando classes de apoio
            $arrayIterator = new \ArrayIterator();

            foreach ($objDaoHelper->fetchAll() as $permissoes) {

                $objRaseaVO = new RaseaVO();

                $objRaseaVO->bind($permissoes);

                $arrayIterator->append($objRaseaVO);
            }

            $objDaoHelper->setRetornoOperacao($arrayIterator);

            //Fechando conexão
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            //      LogManipulador::registrar(__CLASS__, __FUNCTION__, $ex->getMessage());
            throw new \Exception($ex->getMessage());
        }


        // Retornando resposta
        return $objDaoHelper->getRetorno();
    }

    public function inserir(RaseaVO $objRaseaVO) {


        $objDaoHelper = new DaoHelper();

        try {

            // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            // Comando SQL

            $objDaoHelper->setSql("INSERT INTO SEG.R_USER (
                                    DISPLAYNAME, 
                                    EMAIL, ENABLED, PASSWORD, 
                                    USERNAME) 
                                 VALUES (
                                    :DISPLAYNAME,
                                    :EMAIL,
                                    :ENABLED,
                                    :PASSWORD,
                                    :USERNAME)");

            // Atribuindo valores

            $objDaoHelper->bindValue(":DISPLAYNAME", $objRaseaVO->getUsuarioNome());
            $objDaoHelper->bindValue(":EMAIL", $objRaseaVO->getUsuarioEmail());
            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());
            $objDaoHelper->bindValue(":ENABLED", 1);
            $objDaoHelper->bindValue(":PASSWORD", SafeHelper::generateRaseahash($objRaseaVO->getUsuarioSenha()));


            // Executando comando
            $objDaoHelper->execute(FALSE);

            $objDaoHelper->setSql("INSERT INTO SEG.R_USER_ASSIGNMENT (USERNAME, ROLE_ID) VALUES (:USERNAME, :ROLE_ID)");

            // Atribuindo valores
            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());
            $objDaoHelper->bindValue(":ROLE_ID", $objRaseaVO->getPerfilId());

            // Executando comando
            $objDaoHelper->execute();

            // Obtendo resposta
            $objDaoHelper->setRetornoOperacao(TRUE);

            //Fechando conexão
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            //      LogManipulador::registrar(__CLASS__, __FUNCTION__, $ex->getMessage());
            throw new \Exception($ex->getMessage());
        }


        // Retornando resposta
        return $objDaoHelper->getRetorno();
    }

    public function obterIdPerfilIdAplicacao(RaseaVO $objRaseaVO) {

        $objDaoHelper = new DaoHelper();

        try {

            // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            // Comando SQL
            $objDaoHelper->setSql("SELECT 
                                    RO.ID as ROLE_ID, RO.APPLICATION_ID
                                    FROM SEG.R_ROLE RO
                                    JOIN SEG.R_APPLICATION RA On RA.ID = RO.APPLICATION_ID
                                    WHERE RO.NAME = :PERFIL
                                    AND RA.NAME = :APPLICATION");

            // Atribuindo valores

            $objDaoHelper->bindValue(":PERFIL", $objRaseaVO->getPerfilNome());
            $objDaoHelper->bindValue(":APPLICATION", $objRaseaVO->getAplicacaoNome());

            // Executando comando
            $objDaoHelper->execute();

            // Obtendo resposta
            foreach ($objDaoHelper->fetchAll() as $ret) {
                $objDaoHelper->setRetornoOperacao($ret);
            }

            //Fechando conexão
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        // Retornando resposta
        return $objDaoHelper->getRetorno();
    }

    public function inserirAplicacaoUsuario(RaseaVO $objRaseaVO) {

        $objDaoHelper = new DaoHelper();

        try {
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            $objDaoHelper->setSql("INSERT INTO SEG.R_APPLICATION_ASSIGNMENT (USERNAME, APPLICATION_ID) VALUES (:USERNAME, :APLICACAO_ID)");

            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());
            $objDaoHelper->bindValue(":APLICACAO_ID", $objRaseaVO->getAplicacaoId());

            $objDaoHelper->execute();
            $objDaoHelper->setRetornoOperacao(TRUE);

            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        return $objDaoHelper->getRetorno();
    }

    public function inserirUsuario(RaseaVO $objRaseaVO) {

        $objDaoHelper = new DaoHelper();

        try {
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            $objDaoHelper->setSql("INSERT INTO SEG.R_USER (
                                    DISPLAYNAME, 
                                    EMAIL, ENABLED, PASSWORD, 
                                    USERNAME) 
                                 VALUES (
                                    :DISPLAYNAME,
                                    :EMAIL,
                                    :ENABLED,
                                    :PASSWORD,
                                    :USERNAME)");

            $objDaoHelper->bindValue(":DISPLAYNAME", $objRaseaVO->getUsuarioNome());
            $objDaoHelper->bindValue(":EMAIL", $objRaseaVO->getUsuarioEmail());
            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());
            $objDaoHelper->bindValue(":ENABLED", 1);
            $objDaoHelper->bindValue(":PASSWORD", SafeHelper::generateRaseahash($objRaseaVO->getUsuarioSenha()));

            $objDaoHelper->execute();

            $objDaoHelper->setRetornoOperacao(TRUE);

            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        return $objDaoHelper->getRetorno();
    }

    public function alterarUsuario(RaseaVO $objRaseaVO) {

        $objDaoHelper = new DaoHelper();

        try {
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            $objDaoHelper->setSql("UPDATE SEG.R_USER SET DISPLAYNAME = :DISPLAYNAME, EMAIL = :EMAIL WHERE USERNAME = :USERNAME");

            $objDaoHelper->bindValue(":DISPLAYNAME", $objRaseaVO->getUsuarioNome());
            $objDaoHelper->bindValue(":EMAIL", $objRaseaVO->getUsuarioEmail());
            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());

            $objDaoHelper->execute();

            $objDaoHelper->setRetornoOperacao(TRUE);

            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        return $objDaoHelper->getRetorno();
    }

    public function inserirPerfilUsuario(RaseaVO $objRaseaVO) {
        $objDaoHelper = new DaoHelper();

        try {
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            $objDaoHelper->setSql("INSERT INTO SEG.R_USER_ASSIGNMENT (USERNAME, ROLE_ID) VALUES (:USERNAME, :ROLE_ID)");
            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());
            $objDaoHelper->bindValue(":ROLE_ID", $objRaseaVO->getPerfilId());

            $objDaoHelper->execute();

            $objDaoHelper->setRetornoOperacao(TRUE);

            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        return $objDaoHelper->getRetorno();
    }

    public function limparPerfilUsuario(RaseaVO $objRaseaVO) {


        $objDaoHelper = new DaoHelper();

        try {
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            $objDaoHelper->setSql("DELETE FROM SEG.R_USER_ASSIGNMENT ua
                                    WHERE UA.USERNAME = :USERNAME
                                    AND UA.ROLE_ID IN (
                                    SELECT r.ID FROM SEG.R_ROLE R WHERE R.APPLICATION_ID = :APPLICATION_ID AND r.ID NOT IN (:ROLE_ID))");


            $objDaoHelper->bindValue(":APPLICATION_ID", $objRaseaVO->getAplicacaoId());
            if (is_array($objRaseaVO->getPerfilId())) {
                $objDaoHelper->bindValue(":ROLE_ID", implode(',', $objRaseaVO->getPerfilId()), false);
            } else {
                $objDaoHelper->bindValue(":ROLE_ID", $objRaseaVO->getPerfilId());
            }
            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());

            $objDaoHelper->execute();

            $objDaoHelper->setRetornoOperacao(TRUE);

            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        return $objDaoHelper->getRetorno();
    }

    public function verificarPerfilUsuario(RaseaVO $objRaseaVO) {
        $objDaoHelper = new DaoHelper();

        try {
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            $objDaoHelper->setSql("SELECT COUNT(*) AS TOTAL FROM SEG.R_USER_ASSIGNMENT UA WHERE UA.USERNAME = :USERNAME AND  UA.ROLE_ID = :RULE_ID ");

            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());
            $objDaoHelper->bindValue(":RULE_ID", $objRaseaVO->getPerfilId());

            $objDaoHelper->execute();

            $retorno = false;

            foreach ($objDaoHelper->fetchAll() as $ret) {
                if ($ret['TOTAL'] > 0) {
                    $retorno = true;
                }
            }

            $objDaoHelper->setRetornoOperacao($retorno);

            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        return $objDaoHelper->getRetorno();
    }

    public function verificarAplicacaoUsuario(RaseaVO $objRaseaVO) {

        $objDaoHelper = new DaoHelper();

        try {
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            $objDaoHelper->setSql("SELECT COUNT(AA.USERNAME) AS TOTAL
                                    FROM  SEG.R_APPLICATION_ASSIGNMENT AA
                                    INNER JOIN SEG.R_APPLICATION A ON A.ID = AA.APPLICATION_ID
                                    WHERE AA.USERNAME = :USERNAME
                                    AND A.NAME = :APPLICATION");

            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());
            $objDaoHelper->bindValue(":APPLICATION", $objRaseaVO->getAplicacaoNome());

            $objDaoHelper->execute();

            $retorno = false;
            foreach ($objDaoHelper->fetchAll() as $ret) {
                if ($ret['TOTAL'] > 0) {
                    $retorno = true;
                }
            }

            $objDaoHelper->setRetornoOperacao($retorno);

            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        return $objDaoHelper->getRetorno();
    }

    public function verificarUsuarioPorLogin(RaseaVO $objRaseaVO) {

        $objDaoHelper = new DaoHelper();

        try {

            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            $objDaoHelper->setSql("SELECT COUNT(R.USERNAME) AS TOTAL
                                    FROM SEG.R_USER R
                                    WHERE R.USERNAME = :USERNAME");
            // CADE O STATUS ENABLED no VO ???

            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());

            $objDaoHelper->execute();

            $retorno = false;
            foreach ($objDaoHelper->fetchAll() as $ret) {
                if ($ret['TOTAL'] > 0) {
                    $retorno = true;
                }
            }

            $objDaoHelper->setRetornoOperacao($retorno);
            $objDaoHelper->setConexao(NULL);
        } catch (Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

        // Retornando resposta
        return $objDaoHelper->getRetorno();
    }

    public function alterarSenha(RaseaVO $objRaseaVO) {

        $objDaoHelper = new DaoHelper();

        try {
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            $objDaoHelper->setSql("UPDATE SEG.R_USER SET PASSWORD = :PASSWORD WHERE ( USERNAME = :USERNAME OR USERNAME = :USERNAMECOMMASCARA) ");

            $objDaoHelper->bindValue(":PASSWORD", SafeHelper::generateRaseahash($objRaseaVO->getNovaSenha()));
            $objDaoHelper->bindValue(":USERNAMECOMMASCARA", FormatHelper::Cpf($objRaseaVO->getUsuarioLogin()));
            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());

            $objDaoHelper->execute();

            $objDaoHelper->setRetornoOperacao(TRUE);

            $objDaoHelper->setConexao(NULL);
        } catch (\Exception $ex) {

            throw new \Exception($ex->getMessage());
        }

        return $objDaoHelper->getRetorno();
    }

    public function obterEmail(RaseaVO $objRaseaVO) {

        $objDaoHelper = new DaoHelper();

        try {

            // Obtendo conexao
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            // Comando SQL

            $objDaoHelper->setSql("SELECT RU.EMAIL 
                                    FROM SEG.R_USER RU
                                    WHERE RU.USERNAME = :USERNAME");

            // Atribuindo valores
            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());

            // Executando comando
            $objDaoHelper->execute();

            // Obtendo resposta
            foreach ($objDaoHelper->fetchAll() as $ret) {
                $objDaoHelper->setRetornoOperacao($ret['EMAIL']);
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


    public function excluirPerfil(RaseaVO $objRaseaVO) {

        $objDaoHelper = new DaoHelper();

        try {
            $objDaoHelper->setConexao(parent::getInstance('RASEA'));

            $objDaoHelper->setSql("DELETE FROM SEG.R_USER_ASSIGNMENT ua WHERE UA.USERNAME = :USERNAME AND UA.ROLE_ID = :ROLE_ID");

            $objDaoHelper->bindValue(":ROLE_ID", $objRaseaVO->getPerfilId());
            $objDaoHelper->bindValue(":USERNAME", $objRaseaVO->getUsuarioLogin());

            $objDaoHelper->execute();

            $objDaoHelper->setRetornoOperacao(TRUE);

            $objDaoHelper->setConexao(NULL);
        } catch (\Exception $ex) {

            throw new \Exception($ex->getMessage());
        }

        return $objDaoHelper->getRetorno();
    }

}
