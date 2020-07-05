<?php

namespace core\bo\pessoa;

use core\vo\pessoa\TipoEmailVO;
use core\dao\pessoa\TipoEmailDAO;
use core\helper\BoHelper;

/**
 * Classe de negócio referente a (TipoEmail)
 */
class TipoEmailBO {

    /**
     * Método que realiza a listagem
     * @param TipoEmailVO $objTipoEmailVO
     * @return ArrayObject
     */
    public function listar($objTipoEmailVO = null) {

        $objBoHelper = new BoHelper();

        /**
         *  realizando procedimentos
         */
        try {

            $objTipoEmailDAO = new TipoEmailDAO();
            $objBoHelper->setRetorno($objTipoEmailDAO->listar($objTipoEmailVO));
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            throw new \Exception("Não foi Possível realizar a operação");
        }

        /**
         *  Retornando Resultado da operação
         */
        return $objBoHelper->getRetorno();
    }

    /**
     * Método que realiza inclusão
     * @param TipoEmailVO $objTipoEmailVO
     * @return String
     */
    public function inserir(TipoEmailVO $objTipoEmailVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTipoEmailVO->getDescricao()) == 0) {
            $objBoHelper->addRetornoMensagem("O Campo Descrição não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoEmails de valida��o e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {

            try {

                $objTipoEmailDAO = new TipoEmailDAO();

                $objBoHelper->setRetorno($objTipoEmailDAO->inserir($objTipoEmailVO));
            } catch (\Exception $ex) {
                throw new \Exception("Não foi Possível realizar a operação");
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        /**
         *  Retornando Resultado da operação
         */
        return $objBoHelper->getRetornoMensagemImplode();
    }

    /**
     * Método que realiza exclusão
     * @param TipoEmailVO $objTipoEmailVO
     * @return String
     */
    public function excluir(TipoEmailVO $objTipoEmailVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTipoEmailVO->getDescricao()) == 0) {
            $objBoHelper->addRetornoMensagem("O Campo Descrição não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoEmails de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {
            try {

                $objTipoEmailDAO = new TipoEmailDAO();

                $objBoHelper->setRetornoOperacao($objTipoEmailDAO->excluir($objTipoEmailVO));
            } catch (\Exception $ex) {

                throw new \Exception("Não foi Possível realizar a operação");
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        /**
         *  Retornando Resultado da operação
         */
        return $objBoHelper->getRetornoMensagemImplode();
    }

    /**
     * Método que realiza a seleção de um registro
     * @param TipoEmailVO $objTipoEmailVO
     * @return TipoEmailVO
     */
    public function selecionar($objTipoEmailVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (empty($objTipoEmailVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoEmails de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {
            try {

                $objTipoEmailDAO = new TipoEmailDAO();

                $objBoHelper->setRetorno($objTipoEmailDAO->selecionar($objTipoEmailVO));
            } catch (\Exception $ex) {

                throw new \Exception("Não foi Possível realizar a operação");
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        /**
         *  Retornando Resultado da operação
         */
        return $objBoHelper->getRetorno();
    }

    /**
     * Método que realiza inclusão
     * @param TipoEmailVO $objTipoEmailVO
     * @return String
     */
    public function alterar(TipoEmailVO $objTipoEmailVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTipoEmailVO->getDescricao()) == 0) {
            $objBoHelper->addRetornoMensagem("O Campo Descrição não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoEmails de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {

            try {

                $objTipoEmailDAO = new TipoEmailDAO();

                $objBoHelper->setRetornoOperacao($objTipoEmailDAO->alterar($objTipoEmailVO));
            } catch (\Exception $ex) {

                throw new \Exception("Não foi Possível realizar a operação");
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        /**
         *  Retornando Resultado da operação
         */
        return $objBoHelper->getRetornoMensagemImplode();
    }

}
