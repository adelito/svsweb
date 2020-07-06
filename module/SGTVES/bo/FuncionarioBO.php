<?php

namespace module\framework\bo;

use config\SystemConfig;
use core\helper\BoHelper;
use module\framework\vo\FuncionarioVO;
use module\framework\dao\FuncionarioDAO;
use core\helper\SafeHelper;
use core\exception\AppException;

# Classe de negócio referente a >Funcionário< #

class FuncionarioBO {

    /**
     * Método que realiza a listagem
     * @param FuncionarioVO $objFuncionarioVO
     * @return ArrayObject
     */
    public function listar(FuncionarioVO $objFuncionarioVO) {
        # instanciando classe de apoio da camada #
        $objBoHelper = new BoHelper();

        # Realizando Procedimentos #
        try {
            $objFuncionarioDAO = new FuncionarioDAO();
            $objBoHelper->setRetorno($objFuncionarioDAO->listar($objFuncionarioVO));
        } catch (\Exception $ex) {
            if ($ex->getMessage() == "erro de SQL") {
                throw new \Exception("Não foi possível realizar a operação.");
            } else {
                throw new \Exception($ex->getMessage());
                echo $ex->getMessage();die;
            }
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }

    /**
     * Método que realiza a listagem
     * @param FuncionarioVO $objFuncionarioVO
     * @return ArrayObject
     */
    public function selecionar(FuncionarioVO $objFuncionarioVO) {
        $objBoHelper = new BoHelper();

        # Verificando a Regra de Negócio #
        if (empty($objFuncionarioVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo ID não pode ficar vazio.");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objFuncionarioDAO = new FuncionarioDAO();
                $objBoHelper->setRetorno($objFuncionarioDAO->selecionar($objFuncionarioVO));
            } catch (\Exception $ex) {
                throw new \Exception("Não foi possível realizar a operação.");
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }

    /**
     * Método que realiza a inclusão
     * @param FuncionarioVO $objFuncionarioVO
     * @return String
     */
    public function inserir(FuncionarioVO $objFuncionarioVO) {
        $objBoHelper = new BoHelper();

        # Verificando a Regra de Negócio #
        if (strlen($objFuncionarioVO->getMatricula()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha o campo – Matrícula!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objFuncionarioVO->getSenha()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha o campo – Senha!");
            $objBoHelper->setChkErro(TRUE);
        } 

        if (strlen($objFuncionarioVO->getNome()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha o campo – Nome!");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objFuncionarioVO->getCpf()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha o campo – CPF!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objFuncionarioVO->getCelular()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha o campo – Celular!");
            $objBoHelper->setChkErro(TRUE);
        }
        if ($this->existeCpf($objFuncionarioVO, TRUE)) {
            $objBoHelper->addRetornoMensagem("CPF ja cadastrado!");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objFuncionarioVO->getEmail()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha o campo – Email!");
            $objBoHelper->setChkErro(TRUE);
        }



        if (!$objBoHelper->getChkErro()) {
            try {
                $objFuncionarioDAO = new FuncionarioDAO();
                $objBoHelper->setRetorno($objFuncionarioDAO->inserir($objFuncionarioVO));
                $objBoHelper->addRetornoMensagem("Adicionado com sucesso!");
            } catch (\Exception $ex) {
                if ($ex->getMessage() == "erro de SQL") {
                    throw new \Exception("Não foi possível realizar a operação.");
                } else {
                    throw new \Exception($ex->getMessage());
                }
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }

    /**
     * Método que realiza a alteração dos dados do funcionário
     * @param FuncionarioVO $objFuncionarioVO
     * @return String
     */
    public function alterar(FuncionarioVO $objFuncionarioVO) {
        $objBoHelper = new BoHelper();

        # Verificando a Regra de Negócio #

        if (strlen($objFuncionarioVO->getNome()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha o campo – Nome!");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objFuncionarioVO->getCpf()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha o campo – CPF!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objFuncionarioVO->getCelular()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha o campo – Celular!");
            $objBoHelper->setChkErro(TRUE);
        }
        if ($this->existeCpf($objFuncionarioVO, TRUE)) {
            $objBoHelper->addRetornoMensagem("CPF ja cadastrado!");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objFuncionarioVO->getEmail()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha o campo – Email!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objFuncionarioDAO = new FuncionarioDAO();
                $objBoHelper->setRetorno($objFuncionarioDAO->alterar($objFuncionarioVO));
                $objBoHelper->addRetornoMensagem("Alterado com sucesso!");
            } catch (\Exception $ex) {
                if ($ex->getMessage() == "erro de SQL") {
                    throw new \Exception("Não foi possível realizar a operação.");
                } else {
                    throw new \Exception($ex->getMessage());
                }
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }

    /**
     * Método que realiza a alteração dos dados do funcionário
     * @param FuncionarioVO $objFuncionarioVO
     * @return String
     */
    public function excluir(FuncionarioVO $objFuncionarioVO) {
        $objBoHelper = new BoHelper();

        # Verificando a Regra de Negócio #
        if (empty($objFuncionarioVO->getId())) {
            $objBoHelper->addRetornoMensagem(SystemConfig::SYSTEM_MSG['MSG1']);
            $objBoHelper->setChkErro(1);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objFuncionarioDAO = new FuncionarioDAO();
                $objBoHelper->setRetornoOperacao($objFuncionarioDAO->excluir($objFuncionarioVO));
                $objBoHelper->addRetornoMensagem("Excluído com sucesso.");
            } catch (\Exception $ex) {
                throw new \Exception("Não foi possível realizar a operação.");
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }


    /**
     * Puxa a tabela de Setor para a combo box da tela de Funcionario
     * @param FuncionarioVO $objFuncionarioVO
     * @return String
     */
    public function listarCombo(FuncionarioVO $objFuncionarioVO) {
        $objBoHelper = new BoHelper();

        try {
            $objFuncionarioDAO = new FuncionarioDAO();
            $objBoHelper->setRetorno($objFuncionarioDAO->listarCombo($objFuncionarioVO));
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            throw new \Exception("Não foi Possível realizar a operação");
        }
        # Retornando Resultado da operação #
        return $objBoHelper->getRetorno();
    }

    /**
     * Realiza a checagem da regra de negócio referente a autenticação do usuario no framework
     * @access protected
     * @param FuncionarioVO $objFuncionarioVO 
     * @return Array Contem informações do retorno (Boolean) e mensagem (String)
     */
    public function autenticar(FuncionarioVO $objFuncionarioVO) {
                    //    var_dump($objFuncionarioVO); die;

        $objBoHelper = new BoHelper();

        ## RN ##
        if (strlen($objFuncionarioVO->getCpf()) == 0) {
            $objBoHelper->addRetornoMensagem("O CPF não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objFuncionarioVO->getSenha()) == 0) {
            $objBoHelper->addRetornoMensagem("Senha não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        ## Executando ##

        if (!$objBoHelper->getChkErro()) {
            try {
                $objFuncionarioDAO = new FuncionarioDAO();
                $objBoHelper->setRetorno($objFuncionarioDAO->autenticar($objFuncionarioVO));
            } catch (\Exception $ex) {
                echo $ex->getMessage();die;
                throw new \Exception("Não foi possível realizar a operação.");
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        ## Retornando ##

        return $objBoHelper->getRetorno();
    }

    public function selecionarByCpf(FuncionarioVO $objFuncionarioVO) {
        $objBoHelper = new BoHelper();
        # Verificando a Regra de Negócio #
        if (empty($objFuncionarioVO->getCpf())) {
            $objBoHelper->addRetornoMensagem("Campo CPF não pode ser vazio.");
            $objBoHelper->setChkErro(TRUE);
        }
        if (empty($objFuncionarioVO->getSenha())) {
            $objBoHelper->addRetornoMensagem("Campo Senha não pode ser vazio.");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objFuncionarioDAO = new FuncionarioDAO();
                $objBoHelper->setRetorno($objFuncionarioDAO->selecionarByCpf($objFuncionarioVO));
            } catch (\Exception $ex) {
                throw new \Exception($ex->getMessage());
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }

    public function alterarSenha(FuncionarioVO $objFuncionarioVO) {

        $objBoHelper = new BoHelper();
        $objFuncionarioDAO = new FuncionarioDAO();


        // Condição criada para caso seja um recuperar/alterar senha sem autenticação no Sistema.
        if (!$objFuncionarioVO->getRecuperaSenha()) {

            $objFuncionarioVO->setSenha($objFuncionarioVO->getSenha());
            if (!$objFuncionarioDAO->autenticar($objFuncionarioVO)['retornoOperacao']) {
                $objBoHelper->addRetornoMensagem("A senha atual é divergente da senha cadastrada!");
                $objBoHelper->setChkErro(TRUE);
            }

            if (strlen($objFuncionarioVO->getSenha()) == 0) {
                $objBoHelper->addRetornoMensagem('A senha não pode ser vazia!');
                $objBoHelper->setChkErro(TRUE);
            }
        }

        if (strlen($objFuncionarioVO->getCpf()) == 0) {
            $objBoHelper->addRetornoMensagem("O login não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objFuncionarioVO->getNovasenha()) == 0) {
            $objBoHelper->addRetornoMensagem('A nova senha não pode ser vazia!');
            $objBoHelper->setChkErro(TRUE);
        }

        if ($objFuncionarioVO->getNovaSenha() != $objFuncionarioVO->getNovaSenhaConfirmacao()) {
            $objBoHelper->addRetornoMensagem('A confirmação da senha é divergente da nova senha informada!');
            $objBoHelper->setChkErro(TRUE);
        } elseif ($verificarSenha = SafeHelper::isInvalidPassword($objFuncionarioVO->getNovaSenha())) {
            $objBoHelper->addRetornoMensagem($verificarSenha);
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objFuncionarioDAO = new FuncionarioDAO();

                $objFuncionarioDAO->alterarSenha($objFuncionarioVO);
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
    
    public function recuperarSenha(FuncionarioVO $objFuncionarioVO) {

        $objBoHelper = new BoHelper();

        if (strlen($objFuncionarioVO->getCpf()) == 0) {
            $objBoHelper->addRetornoMensagem("CPF não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {

            try {
                $objFuncionarioDAO = new FuncionarioDAO();

                $objBoHelper->setRetorno($objFuncionarioDAO->alterarSenha($objFuncionarioVO));


                if ($objBoHelper->getRetornoOperacao()) {
                    $objBoHelper->setRetornoMensagem("Senha recuperada com sucesso!");
                } else {
                    $objBoHelper->setRetornoMensagem("CPF não encontrado!");
                }
            } catch (\Exception $ex) {
               echo $ex->getMessage();
                throw new \Exception('Não foi possível recuperar a senha');
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        return $objBoHelper->getRetorno();
    }
    
    public function obterEmail(FuncionarioVO $objFuncionarioVO) {

        $objBoHelper = new BoHelper();

        ## RN ##

        if (strlen($objFuncionarioVO->getCpf()) == 0) {
            $objBoHelper->addRetornoMensagem("CPF não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        ## Executando ##

        if (!$objBoHelper->getChkErro()) {

            $objFuncionarioDAO = new FuncionarioDAO();

            try {

                $objBoHelper->setRetorno($objFuncionarioDAO->obterEmail($objFuncionarioVO));
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

    /**
     * Verifica a existência de um registro
     * @param FuncionarioVO $objFuncionarioVO, $exceto = FALSE
     * @return FuncionarioVO
     */
    public function existeCpf(FuncionarioVO $objFuncionarioVO, $exceto = FALSE) {
        $objBoHelper = new BoHelper();

        if (empty($objFuncionarioVO->getCpf())) {
            $objBoHelper->addRetornoMensagem("Matricula não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objFuncionarioDAO = new FuncionarioDAO();
                $objBoHelper->setRetornoOperacao($objFuncionarioDAO->existeCpf($objFuncionarioVO, $exceto));
            } catch (\Exception $ex) {
                if ($ex->getMessage() == "erro de SQL") {
                    throw new \Exception("Não foi possível realizar a operação.");
                } else {
                    throw new \Exception($ex->getMessage());
                }
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetornoOperacao();
    }

}