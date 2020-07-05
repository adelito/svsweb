<?php

namespace core\bo\pessoa;

use core\vo\pessoa\TipoTelefoneVO;
use core\dao\pessoa\TipoTelefoneDAO;
use core\helper\BoHelper;

/**
 * Classe de negócio referente a (TipoTelefone)
 */
class TipoTelefoneBO {

    /**
     * Método que realiza a listagem
     * @param TipoTelefoneVO $objTipoTelefoneVO
     * @return ArrayObject
     */
    public function listar($objTipoTelefoneVO = null) {

        $objBoHelper = new BoHelper();

        /**
         *  realizando procedimentos
         */
        try {

            $objTipoTelefoneDAO = new TipoTelefoneDAO();
            $objBoHelper->setRetorno($objTipoTelefoneDAO->listar($objTipoTelefoneVO));
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
     * @param TipoTelefoneVO $objTipoTelefoneVO
     * @return String
     */
    public function inserir(TipoTelefoneVO $objTipoTelefoneVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTipoTelefoneVO->getDescricao()) == 0) {
            $objBoHelper->addRetornoMensagem("O Campo Descrição não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoTelefones de valida��o e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {

            try {

                $objTipoTelefoneDAO = new TipoTelefoneDAO();

                $objBoHelper->setRetorno($objTipoTelefoneDAO->inserir($objTipoTelefoneVO));
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
     * @param TipoTelefoneVO $objTipoTelefoneVO
     * @return String
     */
    public function excluir(TipoTelefoneVO $objTipoTelefoneVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTipoTelefoneVO->getDescricao()) == 0) {
            $objBoHelper->addRetornoMensagem("O Campo Descrição não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoTelefones de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {
            try {

                $objTipoTelefoneDAO = new TipoTelefoneDAO();

                $objBoHelper->setRetornoOperacao($objTipoTelefoneDAO->excluir($objTipoTelefoneVO));
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
     * @param TipoTelefoneVO $objTipoTelefoneVO
     * @return TipoTelefoneVO
     */
    public function selecionar($objTipoTelefoneVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (empty($objTipoTelefoneVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoTelefones de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {
            try {

                $objTipoTelefoneDAO = new TipoTelefoneDAO();

                $objBoHelper->setRetorno($objTipoTelefoneDAO->selecionar($objTipoTelefoneVO));
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
     * @param TipoTelefoneVO $objTipoTelefoneVO
     * @return String
     */
    public function alterar(TipoTelefoneVO $objTipoTelefoneVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTipoTelefoneVO->getDescricao()) == 0) {
            $objBoHelper->addRetornoMensagem("O Campo Descrição não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoTelefones de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {

            try {

                $objTipoTelefoneDAO = new TipoTelefoneDAO();

                $objBoHelper->setRetornoOperacao($objTipoTelefoneDAO->alterar($objTipoTelefoneVO));
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
