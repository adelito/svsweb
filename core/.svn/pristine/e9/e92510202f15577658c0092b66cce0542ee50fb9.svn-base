<?php

namespace core\bo\pessoa;

use core\vo\pessoa\TipoLogradouroVO;
use core\dao\pessoa\TipoLogradouroDAO;
use core\helper\BoHelper;

/**
 * Classe de negócio referente a (TipoLogradouro)
 */
class TipoLogradouroBO {

    /**
     * Método que realiza a listagem
     * @param TipoLogradouroVO $objTipoLogradouroVO
     * @return ArrayObject
     */
    public function listar($objTipoLogradouroVO = null) {

        $objBoHelper = new BoHelper();

        /**
         *  realizando procedimentos
         */
        try {

            $objTipoLogradouroDAO = new TipoLogradouroDAO();
            $objBoHelper->setRetorno($objTipoLogradouroDAO->listar($objTipoLogradouroVO));
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
     * @param TipoLogradouroVO $objTipoLogradouroVO
     * @return String
     */
    public function inserir(TipoLogradouroVO $objTipoLogradouroVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTipoLogradouroVO->getDescricao()) == 0) {
            $objBoHelper->addRetornoMensagem("O Campo Descrição não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoLogradouros de valida��o e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {

            try {

                $objTipoLogradouroDAO = new TipoLogradouroDAO();

                $objBoHelper->setRetorno($objTipoLogradouroDAO->inserir($objTipoLogradouroVO));
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
     * @param TipoLogradouroVO $objTipoLogradouroVO
     * @return String
     */
    public function excluir(TipoLogradouroVO $objTipoLogradouroVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTipoLogradouroVO->getDescricao()) == 0) {
            $objBoHelper->addRetornoMensagem("O Campo Descrição não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoLogradouros de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {
            try {

                $objTipoLogradouroDAO = new TipoLogradouroDAO();

                $objBoHelper->setRetornoOperacao($objTipoLogradouroDAO->excluir($objTipoLogradouroVO));
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
     * @param TipoLogradouroVO $objTipoLogradouroVO
     * @return TipoLogradouroVO
     */
    public function selecionar($objTipoLogradouroVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (empty($objTipoLogradouroVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoLogradouros de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {
            try {

                $objTipoLogradouroDAO = new TipoLogradouroDAO();

                $objBoHelper->setRetorno($objTipoLogradouroDAO->selecionar($objTipoLogradouroVO));
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
     * @param TipoLogradouroVO $objTipoLogradouroVO
     * @return String
     */
    public function alterar(TipoLogradouroVO $objTipoLogradouroVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTipoLogradouroVO->getDescricao()) == 0) {
            $objBoHelper->addRetornoMensagem("O Campo Descrição não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoLogradouros de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {

            try {

                $objTipoLogradouroDAO = new TipoLogradouroDAO();

                $objBoHelper->setRetornoOperacao($objTipoLogradouroDAO->alterar($objTipoLogradouroVO));
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
