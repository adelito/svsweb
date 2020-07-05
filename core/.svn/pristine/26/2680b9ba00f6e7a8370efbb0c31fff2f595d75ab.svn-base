<?php

namespace core\bo\pessoa;

use core\vo\pessoa\TipoEnderecoVO;
use core\dao\pessoa\TipoEnderecoDAO;
use core\helper\BoHelper;

/**
 * Classe de negócio referente a (TipoEndereco)
 */
class TipoEnderecoBO {

    /**
     * Método que realiza a listagem
     * @param TipoEnderecoVO $objTipoEnderecoVO
     * @return ArrayObject
     */
    public function listar($objTipoEnderecoVO = null) {

        $objBoHelper = new BoHelper();

        /**
         *  realizando procedimentos
         */
        try {

            $objTipoEnderecoDAO = new TipoEnderecoDAO();
            $objBoHelper->setRetorno($objTipoEnderecoDAO->listar($objTipoEnderecoVO));
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
     * @param TipoEnderecoVO $objTipoEnderecoVO
     * @return String
     */
    public function inserir(TipoEnderecoVO $objTipoEnderecoVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTipoEnderecoVO->getDescricao()) == 0) {
            $objBoHelper->addRetornoMensagem("O Campo Descrição não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoEnderecos de valida��o e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {

            try {

                $objTipoEnderecoDAO = new TipoEnderecoDAO();

                $objBoHelper->setRetorno($objTipoEnderecoDAO->inserir($objTipoEnderecoVO));
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
     * @param TipoEnderecoVO $objTipoEnderecoVO
     * @return String
     */
    public function excluir(TipoEnderecoVO $objTipoEnderecoVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTipoEnderecoVO->getDescricao()) == 0) {
            $objBoHelper->addRetornoMensagem("O Campo Descrição não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoEnderecos de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {
            try {

                $objTipoEnderecoDAO = new TipoEnderecoDAO();

                $objBoHelper->setRetornoOperacao($objTipoEnderecoDAO->excluir($objTipoEnderecoVO));
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
     * @param TipoEnderecoVO $objTipoEnderecoVO
     * @return TipoEnderecoVO
     */
    public function selecionar($objTipoEnderecoVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (empty($objTipoEnderecoVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoEnderecos de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {
            try {

                $objTipoEnderecoDAO = new TipoEnderecoDAO();

                $objBoHelper->setRetorno($objTipoEnderecoDAO->selecionar($objTipoEnderecoVO));
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
     * @param TipoEnderecoVO $objTipoEnderecoVO
     * @return String
     */
    public function alterar(TipoEnderecoVO $objTipoEnderecoVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTipoEnderecoVO->getDescricao()) == 0) {
            $objBoHelper->addRetornoMensagem("O Campo Descrição não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos TipoEnderecos de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {

            try {

                $objTipoEnderecoDAO = new TipoEnderecoDAO();

                $objBoHelper->setRetornoOperacao($objTipoEnderecoDAO->alterar($objTipoEnderecoVO));
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
