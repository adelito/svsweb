<?php

namespace module\framework\bo;

use config\SystemConfig;
use core\helper\BoHelper;
use module\framework\vo\SetorVO;
use module\framework\dao\SetorDAO;

# Classe de negócio referente a >Setor< #

class SetorBO {

    /**
     * Método que realiza a listagem
     * @param SetorVO $objSetorVO
     * @return ArrayObject
     */
    public function listar(SetorVO $objSetorVO) {
        # Instanciando classe de apoio da camada #
        $objBoHelper = new BoHelper();

        # Realizando Procedimentos #
        try {
            $objSetorDAO = new SetorDAO();
            $objBoHelper->setRetorno($objSetorDAO->listar($objSetorVO));
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            throw new \Exception("Não foi possível realizar a operação.");
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }

    /**
     * Método que realiza a listagem
     * @param SetorVO $objSetorVO
     * @return ArrayObject
     */
    public function selecionar(SetorVO $objSetorVO) {
        # instanciando classe de apoio da camada #
        $objBoHelper = new BoHelper();

        # Verificando a regra de negócio #
        if (empty($objSetorVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo ID não pode ficar vazio.");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objSetorDAO = new SetorDAO();
                $objBoHelper->setRetorno($objSetorDAO->selecionar($objSetorVO));
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
     * @param SetorVO $objSetorVO
     * @return String
     */
    public function inserir($objSetorVO) {
        $objBoHelper = new BoHelper();

        # Verificando a Regra de Negócio
        if (strlen($objSetorVO->getNome()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha esse campo.(Nome)");
            $objBoHelper->setChkErro(TRUE);
        }

        if ($this->existe($objSetorVO)) {
            $objBoHelper->addRetornoMensagem(SystemConfig::SYSTEM_MSG['MSG07']);
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objSetorDAO = new SetorDAO();
                $objBoHelper->setRetorno($objSetorDAO->inserir($objSetorVO));
                $objBoHelper->addRetornoMensagem("Adicionado com sucesso!");
            } catch (\Exception $ex) {
                echo $ex->getMessage();
                exit;
                throw new \Exception("Não foi possível realizar a operação.");
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        #Retornando resultado da operação
        return $objBoHelper->getRetornoMensagemImplode();
    }

    /**
     * Método que realiza a alteração do setor
     * @param SetorVO $objSetorVO
     * @return String
     */
    public function alterar(SetorVO $objSetorVO) {
        $objBoHelper = new BoHelper();

        # Verificando a Regra de Negócio #
        if (strlen($objSetorVO->getNome() == "")) {
            $objBoHelper->addRetornoMensagem("Preencha esse campo.");
            $objBoHelper->setChkErro(TRUE);
        }

        if ($this->existe($objSetorVO, TRUE)) {
            $objBoHelper->addRetornoMensagem(SystemConfig::SYSTEM_MSG['MSG07']);
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objSetorDAO = new SetorDAO();
                $objBoHelper->setRetorno($objSetorDAO->alterar($objSetorVO));
                $objBoHelper->addRetornoMensagem(SystemConfig::SYSTEM_MSG['MSG3']);
            } catch (\Exception $ex) {
                if($ex->getMessage()== 'erro de SQL'){
                throw new \Exception("Não foi possível realizar a operação.");
                } else{
                    throw new \Exception($ex->getMessage());
                }
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode()); //isso tá null
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }

    /**
     * Método que realiza a exclusão do setor
     * @param SetorVO $objSetorVO
     * @return String
     */
    public function excluir(SetorVO $objSetorVO) {
        $objBoHelper = new BoHelper();

        # Verificando a Regra de Negócio #
        if (empty($objSetorVO->getId())) {
            $objBoHelper->addRetornoMensagem(SystemConfig::SYSTEM_MSG['MSG1']);
            $objBoHelper->setChkErro(1);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objSetorDAO = new SetorDAO();
                $objBoHelper->setRetornoOperacao($objSetorDAO->excluir($objSetorVO));
                $objBoHelper->addRetornoMensagem("Excluído com sucesso.");
            } catch (\Exception $ex) {
                throw new \Exception("Não foi possível realizar a operação.");
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetornoMensagemImplode();
    }

    /**
     * Verifica a existência de um registro
     * @param SetorVO $objSetorVO, $exceto = FALSE
     * @return SetorVO
     */
    public function existe(SetorVO $objSetorVO, $exceto = FALSE) {
        $objSetorDAO = new SetorDAO();
        $objBoHelper = new BoHelper();

        if (!$objBoHelper->getChkErro()) {
            try {
                $objBoHelper->setRetornoOperacao($objSetorDAO->existe($objSetorVO, $exceto));
            } catch (\Exception $ex) {
                throw new \Exception("Não foi possível realizar a operação."); //aqui
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetornoOperacao();
    }

    /**
     * Puxa a tabela de Setor para a combo box da tela de Funcionario
     * @param SetorVO $objSetorVO
     * @return String
     */
    public function listarCombo(SetorVO $objSetorVO) {
        $objBoHelper = new BoHelper();

        try {
            $objSetorDAO = new SetorDAO();
            $objBoHelper->setRetorno($objSetorDAO->listarCombo($objSetorVO));
            return $objBoHelper->getRetornoOperacao();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            throw new \Exception("Não foi Possível realizar a operação");
        }
    }

}
