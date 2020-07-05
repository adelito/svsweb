<?php

namespace core\bo\rasea;

use core\helper\BoHelper;
use core\helper\LogHelper;
use core\dao\rasea\RaseaDAO;
use core\vo\rasea\RaseaVO;
use core\helper\SafeHelper;
use core\helper\PermissaoAcessoHelper;

/**
 * Classe de Regra de Negócio
 * @package core
 * @subpackage bo
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
class RaseaBO {

    /**
     * Realiza a reorganização dos dados coletados
     * @access public
     * @param \ArrayIterator $arrayItetatorRaseaVO  
     * @return Array Permissões de acesso organizadas
     */
    public function reorganizar($arrayPermissoes) {
        
        $arrayPermissoes = PermissaoAcessoHelper::reorganizar($arrayPermissoes);
        return $arrayPermissoes;
        
    }


    /**
     * Realiza a checagem da regra de negódio referente a autenticação do usuario no RASEA
     * @access public
     * @param \ArrayIterator $arrayItetatorRaseaVO 
     * @return Array Perfis de acesso do usuário
     */
    public function getArrayPerfis($arrayItetatorRaseaVO) {
        $arrayPerfis = array();
        foreach ($arrayItetatorRaseaVO as $objRaseaVO) {
            $arrayPerfis[$objRaseaVO->getPerfilNome()] = $objRaseaVO->getPerfilDescricao();
        }
        return $arrayPerfis;
    }

    /**
     * Realiza a checagem da regra de negócio referente a autenticação do usuario no RASEA
     * @access protected
     * @param RaseaVO $objRaseaVO 
     * @return Array Contem informações do retorno (Boolean) e mensagem (String)
     */
    public function autenticar(RaseaVO $objRaseaVO) {

        $objBoHelper = new BoHelper();

        ## RN ##
        if (strlen($objRaseaVO->getUsuarioLogin()) == 0) {
            $objBoHelper->addRetornoMensagem("O login não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objRaseaVO->getUsuarioSenha()) == 0) {
            $objBoHelper->addRetornoMensagem('A senha não pode ser vazia!');
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objRaseaVO->getAplicacaoNome()) == 0) {
            $objBoHelper->addRetornoMensagem("Nome da aplicação não pode ser vazia!");
            $objBoHelper->setChkErro(TRUE);
        }

        ## Executando ##

        if (!$objBoHelper->getChkErro()) {

            $objRaseaDAO = new RaseaDAO();

            try {

                $objBoHelper->setRetorno($objRaseaDAO->autenticar($objRaseaVO));
                $objBoHelper->setRetornoMensagem("Autenticado com sucesso!");
            } catch (\Exception $ex) {
                throw new \Exception($ex->getMessage());
            }
        } else {
//            LogManipulador::registrar(__CLASS__, __FUNCTION__, $objBoHelper->getMsgRetorno());          
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

## Retornando ##

        return $objBoHelper->getRetorno();
    }

    /**
     * Realiza a checagem da regra de negócio referente a recursos e permissões
     * @access protected
     * @param RaseaVO $objRaseaVO 
     * @return Array Contem informações do retorno (Boolean) e mensagem (String)
     */
    public function getRecursosPermissoes(RaseaVO $objRaseaVO) {


        $objBoHelper = new BoHelper();

## RN ##
        if (strlen($objRaseaVO->getUsuarioLogin()) == 0) {
            $objBoHelper->addRetornoMensagem("O login não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objRaseaVO->getAplicacaoNome()) == 0) {
            $objBoHelper->addRetornoMensagem("Nome da aplicação não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

## Executando ##

        if (!$objBoHelper->getChkErro()) {

            $objRaseaDAO = new RaseaDAO();

            try {

                $objBoHelper->setRetorno($objRaseaDAO->getRecursosPermissoes($objRaseaVO));
                $objBoHelper->setRetornoMensagem("Autenticado com sucesso!");
            } catch (\Exception $ex) {
                throw new \Exception($ex->getMessage());
            }
        } else {
//            LogManipulador::registrar(__CLASS__, __FUNCTION__, $objBoHelper->getMsgRetorno());          
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

## Retornando ##

        return $objBoHelper->getRetorno();
    }

    private function verificarCamposObrigatorios(RaseaVO $objRaseaVO) {

        $objBoHelper = new BoHelper();

        if (strlen($objRaseaVO->getUsuarioNome()) == 0) {
            $objBoHelper->addRetornoMensagem("Nome não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objRaseaVO->getUsuarioLogin()) == 0) {
            $objBoHelper->addRetornoMensagem("Login não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objRaseaVO->getUsuarioEmail()) == 0) {
            $objBoHelper->addRetornoMensagem('E-mail não pode ser vazio!');
            $objBoHelper->setChkErro(TRUE);
        }

        if (empty($objRaseaVO->getPerfilNome())) {
            $objBoHelper->addRetornoMensagem("Perfil Nome não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objRaseaVO->getAplicacaoNome()) == 0) {
            $objBoHelper->addRetornoMensagem("Aplicação não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        return $objBoHelper;
    }

    public function inserirUsuarioPerfilAplicacao(RaseaVO $objRaseaVO) {

        $objBoHelper = $this->verificarCamposObrigatorios($objRaseaVO);


        if (strlen($objRaseaVO->getUsuarioSenha()) == 0) {
            $objBoHelper->addRetornoMensagem("Senha não pode ser vazia!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {

            try {
                $objRaseaDAO = new RaseaDAO();
                if (is_array($objRaseaVO->getPerfilNome())) {

                    foreach ($objRaseaVO->getPerfilNome() as $perfilNome) {
                        $objRaseaVO->setPerfilNome($perfilNome);
                        $retorno = $objRaseaDAO->obterIdPerfilIdAplicacao($objRaseaVO);
                        $perfisId[] = $retorno['retornoOperacao']['ROLE_ID'];
                        $aplicacaoId = $retorno['retornoOperacao']['APPLICATION_ID'];
                    }
                } else {
                    $retorno = $objRaseaDAO->obterIdPerfilIdAplicacao($objRaseaVO);
                    $perfisId = $retorno['retornoOperacao']['ROLE_ID'];
                    $aplicacaoId = $retorno['retornoOperacao']['APPLICATION_ID'];
                }

                $objRaseaVO->setPerfilId($perfisId);
                $objRaseaVO->setAplicacaoId($aplicacaoId);
                // Verifica se o usuário já possui cadastro no rasea.
                $retorno = $objRaseaDAO->verificarUsuarioPorLogin($objRaseaVO);

                if (!$retorno['retornoOperacao']) {

                    // Insere Usuário no Rasea.
                    $objRaseaDAO->inserirUsuario($objRaseaVO);
                }
                // Verifica se o usuário está associado ao projeto no rasea.
                $retorno = $objRaseaDAO->verificarAplicacaoUsuario($objRaseaVO);

                if (!$retorno['retornoOperacao']) {
                    // Insere Projeto para o Usuário.
                    $objRaseaDAO->inserirAplicacaoUsuario($objRaseaVO);
                }

                if (is_array($objRaseaVO->getPerfilId())) {
                    foreach ($objRaseaVO->getPerfilId() as $perfilId) {
                        $raseaVOAux = new RaseaVO();
                        $raseaVOAux->setUsuarioLogin($objRaseaVO->getUsuarioLogin());
                        $raseaVOAux->setPerfilId($perfilId);
                        // Verifica se o usuário possui o perfil informado rasea.
                        $retorno = $objRaseaDAO->verificarPerfilUsuario($raseaVOAux);

                        if (!$retorno['retornoOperacao']) {
                            // Insere Perfil para o Usuário.
                            $objRaseaDAO->inserirPerfilUsuario($raseaVOAux);
                        }
                    }
                } else {
                    // Verifica se o usuário possui o perfil informado rasea.
                    $retorno = $objRaseaDAO->verificarPerfilUsuario($objRaseaVO);

                    if (!$retorno['retornoOperacao']) {
                        // Insere Perfil para o Usuário.
                        $objRaseaDAO->inserirPerfilUsuario($objRaseaVO);
                    }
                }



                $retorno = $objRaseaDAO->limparPerfilUsuario($objRaseaVO);

                // TEM QUE TRATAR OS ERROS

                $objBoHelper->setRetornoMensagem("Adicionado com sucesso!");
                $objBoHelper->setRetornoOperacao(true);
            } catch (\Exception $ex) {
                throw new \Exception($ex->getMessage());
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        return $objBoHelper->getRetorno();
    }

    public function alterarUsuarioPerfilAplicacao(RaseaVO $objRaseaVO) {
        $objBoHelper = $this->verificarCamposObrigatorios($objRaseaVO);

        if (!$objBoHelper->getChkErro()) {

            try {
                $objRaseaDAO = new RaseaDAO();

                if (is_array($objRaseaVO->getPerfilNome())) {

                    foreach ($objRaseaVO->getPerfilNome() as $perfilNome) {
                        $objRaseaVO->setPerfilNome($perfilNome);
                        $retorno = $objRaseaDAO->obterIdPerfilIdAplicacao($objRaseaVO);
                        $perfisId[] = $retorno['retornoOperacao']['ROLE_ID'];
                        $aplicacaoId = $retorno['retornoOperacao']['APPLICATION_ID'];
                    }
                } else {
                    $retorno = $objRaseaDAO->obterIdPerfilIdAplicacao($objRaseaVO);
                    $perfisId = $retorno['retornoOperacao']['ROLE_ID'];
                    $aplicacaoId = $retorno['retornoOperacao']['APPLICATION_ID'];
                }

                $objRaseaVO->setPerfilId($perfisId);
                $objRaseaVO->setAplicacaoId($aplicacaoId);

                // Verifica se o usuário já possui cadastro no rasea.
                $retorno = $objRaseaDAO->verificarUsuarioPorLogin($objRaseaVO);
                if (!$retorno['retornoOperacao']) {

                    // Insere Usuário no Rasea.
                    $objRaseaDAO->alterarUsuario($objRaseaVO);
                } else {
                    // Alterar Usuário no Rasea.
                    $objRaseaDAO->alterarUsuario($objRaseaVO);
                }

                // Verifica se o usuário está associado ao projeto no rasea.
                $retorno = $objRaseaDAO->verificarAplicacaoUsuario($objRaseaVO);

                if (!$retorno['retornoOperacao']) {
                    // Insere Projeto para o Usuário.
                    $objRaseaDAO->inserirAplicacaoUsuario($objRaseaVO);
                }

                // Verifica se o usuário possui o perfil informado rasea.
                if (is_array($objRaseaVO->getPerfilId())) {
                    foreach ($objRaseaVO->getPerfilId() as $perfilId) {
                        $raseaVOAux = new RaseaVO();
                        $raseaVOAux->setUsuarioLogin($objRaseaVO->getUsuarioLogin());
                        $raseaVOAux->setPerfilId($perfilId);

                        // Verifica se o usuário possui o perfil informado rasea.
                        $retorno = $objRaseaDAO->verificarPerfilUsuario($raseaVOAux);

                        if (!$retorno['retornoOperacao']) {
                            // Insere Perfil para o Usuário.
                            $objRaseaDAO->inserirPerfilUsuario($raseaVOAux);
                        }
                    }
                } else {

                    $retorno = $objRaseaDAO->verificarPerfilUsuario($objRaseaVO);

                    if (!$retorno['retornoOperacao']) {
                        // Insere Perfil para o Usuário.
                        $objRaseaDAO->inserirPerfilUsuario($objRaseaVO);
                    }
                }
                $retorno = $objRaseaDAO->limparPerfilUsuario($objRaseaVO);

                // TEM QUE TRATAR OS ERROS

                $objBoHelper->setRetornoMensagem("Alterado com sucesso!");
                $objBoHelper->setRetornoOperacao(true);
            } catch (\Exception $ex) {
                throw new \Exception($ex->getMessage());
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        return $objBoHelper->getRetorno();
    }

    public function recuperarSenha(RaseaVO $objRaseaVO) {

        $objBoHelper = new BoHelper();

        if (strlen($objRaseaVO->getUsuarioLogin()) == 0) {
            $objBoHelper->addRetornoMensagem("Login não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {

            try {
                $objRaseaDAO = new RaseaDAO();

                $objBoHelper->setRetorno($objRaseaDAO->alterarSenha($objRaseaVO));


                if ($objBoHelper->getRetornoOperacao()) {
                    $objBoHelper->setRetornoMensagem("Senha recuperada com sucesso!");
                } else {
                    $objBoHelper->setRetornoMensagem("CPF não encontrado!");
                }
            } catch (\Exception $ex) {
                throw new \Exception('Não foi possível recuperar a senha');
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        return $objBoHelper->getRetorno();
    }

    public function alterarSenha(RaseaVO $objRaseaVO) {

        $objBoHelper = new BoHelper();
        $objRaseaDAO = new RaseaDAO();


        // Condição criada para caso seja um recuperar/alterar senha sem autenticação no Sistema.
        if (!$objRaseaVO->getRecuperaSenha()) {

            $objRaseaVO->setUsuarioSenha($objRaseaVO->getUsuarioSenha());
            
            if (!$objRaseaDAO->autenticar($objRaseaVO)['retornoOperacao']) {
                $objBoHelper->addRetornoMensagem("A senha atual é divergente da senha cadastrada!");
                $objBoHelper->setChkErro(TRUE);
            }

            if (strlen($objRaseaVO->getUsuarioSenha()) == 0) {
                $objBoHelper->addRetornoMensagem('A senha não pode ser vazia!');
                $objBoHelper->setChkErro(TRUE);
            }
        }

        if (strlen($objRaseaVO->getUsuarioLogin()) == 0) {
            $objBoHelper->addRetornoMensagem("O login não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objRaseaVO->getNovasenha()) == 0) {
            $objBoHelper->addRetornoMensagem('A nova senha não pode ser vazia!');
            $objBoHelper->setChkErro(TRUE);
        }

        if ($objRaseaVO->getNovaSenha() != $objRaseaVO->getNovaSenhaConfirmacao()) {
            $objBoHelper->addRetornoMensagem('A confirmação da senha é divergente da nova senha informada!');
            $objBoHelper->setChkErro(TRUE);
        } elseif ($verificarSenha = SafeHelper::isInvalidPassword($objRaseaVO->getNovaSenha())) {
            $objBoHelper->addRetornoMensagem($verificarSenha);
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objRaseaDAO = new RaseaDAO();

                $objRaseaDAO->alterarSenha($objRaseaVO);
                $objBoHelper->setRetornoOperacao(true);
                $objBoHelper->setRetornoMensagem('Senha alterada com sucesso!');
            } catch (\Exception $ex) {
                throw new \Exception($ex->getMessage());
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        return $objBoHelper->getRetorno();
    }

    public function obterEmail(RaseaVO $objRaseaVO) {

        $objBoHelper = new BoHelper();

        ## RN ##

        if (strlen($objRaseaVO->getUsuarioLogin()) == 0) {
            $objBoHelper->addRetornoMensagem("CPF não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        ## Executando ##

        if (!$objBoHelper->getChkErro()) {

            $objRaseaDAO = new RaseaDAO();

            try {

                $objBoHelper->setRetorno($objRaseaDAO->obterEmail($objRaseaVO));
                $objBoHelper->setRetornoMensagem("E-mail encontrado com sucesso!");
            } catch (\Exception $ex) {
                throw new \Exception($ex->getMessage());
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        ## Retornando ##

        return $objBoHelper->getRetornoOperacao();
    }
    
    
    
    
    
      public function verificarUsuarioPorLogin(RaseaVO $objRaseaVO) {

        $objBoHelper = new BoHelper();

        ## RN ##

        if (strlen($objRaseaVO->getUsuarioLogin()) == 0) {
            $objBoHelper->addRetornoMensagem("CPF não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        ## Executando ##

        if (!$objBoHelper->getChkErro()) {

            $objRaseaDAO = new RaseaDAO();

            try {

                $objBoHelper->setRetorno($objRaseaDAO->verificarUsuarioPorLogin($objRaseaVO));
            } catch (\Exception $ex) {
                throw new \Exception($ex->getMessage());
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        ## Retornando ##

        return $objBoHelper->getRetornoOperacao();
    }




    public function limparPerfilUsuario(RaseaVO $objRaseaVO)
    {
        $objBoHelper = new BoHelper();

        if (strlen($objRaseaVO->getUsuarioLogin()) == 0) {
            $objBoHelper->addRetornoMensagem("Login não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {

            try {
                $objRaseaDAO = new RaseaDAO();
                $objBoHelper->setRetorno($objRaseaDAO->limparPerfilUsuario($objRaseaVO));
            } catch (\Exception $ex) {
                throw new \Exception('Não foi possível recuperar a senha');
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        return $objBoHelper->getRetorno();
    }

    public function obterIdPerfilIdAplicacao(RaseaVO $objRaseaVO)
    {
        $objBoHelper = new BoHelper();

        if (strlen($objRaseaVO->getPerfilNome()) == 0) {
            $objBoHelper->addRetornoMensagem("Perfil nome não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objRaseaVO->getAplicacaoNome()) == 0) {
            $objBoHelper->addRetornoMensagem("Aplicação não pode ser vazia!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {

            $objRaseaDAO = new RaseaDAO();

            try {

                $objBoHelper->setRetorno($objRaseaDAO->obterIdPerfilIdAplicacao($objRaseaVO));
                $objBoHelper->setRetornoMensagem("E-mail encontrado com sucesso!");
            } catch (\Exception $ex) {
                throw new \Exception($ex->getMessage());
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        ## Retornando ##

        return $objBoHelper->getRetornoOperacao();
    }



    public function inserirPerfilUsuario(RaseaVO $objRaseaVO)
    {
        $objBoHelper = new BoHelper();

        if (strlen($objRaseaVO->getUsuarioLogin()) == 0) {
            $objBoHelper->addRetornoMensagem("Login não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objRaseaVO->getPerfilId()) == 0) {
            $objBoHelper->addRetornoMensagem("Id perfil não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }


        if (!$objBoHelper->getChkErro()) {

            try {
                $objRaseaDAO = new RaseaDAO();
                $objBoHelper->setRetorno($objRaseaDAO->inserirPerfilUsuario($objRaseaVO));
            } catch (\Exception $ex) {
                throw new \Exception('Não foi possível recuperar a senha');
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        return $objBoHelper->getRetorno();
    }


    public function excluirPerfil(RaseaVO $objRaseaVO)
    {
        $objBoHelper = new BoHelper();

        if (strlen($objRaseaVO->getUsuarioLogin()) == 0) {
            $objBoHelper->addRetornoMensagem("Login não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objRaseaVO->getPerfilId()) == 0) {
            $objBoHelper->addRetornoMensagem("Id perfil não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }


        if (!$objBoHelper->getChkErro()) {

            try {
                $objRaseaDAO = new RaseaDAO();
                $objBoHelper->setRetorno($objRaseaDAO->excluirPerfil($objRaseaVO));
            } catch (\Exception $ex) {
                throw new \Exception('Não foi possível recuperar a senha');
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        return $objBoHelper->getRetorno();
    }
}
