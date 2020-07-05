<?php

namespace core\bo\pessoa;

use core\vo\pessoa\TelefoneVO;
use core\dao\pessoa\TelefoneDAO;
use core\helper\BoHelper;

/**
 * Classe de negócio referente a (Telefone)
 */
class TelefoneBO {

    /**
     * Método que realiza a listagem
     * @param TelefoneVO $objTelefoneVO
     * @return ArrayObject
     */
    public function listar($objTelefoneVO = null) {

        $objBoHelper = new BoHelper();

        /**
         *  realizando procedimentos
         */
        try {

            $objTelefoneDAO = new TelefoneDAO();
            $objBoHelper->setRetorno($objTelefoneDAO->listar($objTelefoneVO));
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
     * @param TelefoneVO $objTelefoneVO
     * @return String
     */
    public function inserir(TelefoneVO $objTelefoneVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTelefoneVO->getIdTipoTelefone()->getId()) == 0) {
            $objBoHelper->addRetornoMensagem("Tipo Telefone não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objTelefoneVO->getIdPessoa()->getId()) == 0) {
            $objBoHelper->addRetornoMensagem("Pessoa não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos telefones de valida��o e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {

            try {

                $objTelefoneDAO = new TelefoneDAO();

                $objBoHelper->setRetorno($objTelefoneDAO->inserir($objTelefoneVO));
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
     * @param TelefoneVO $objTelefoneVO
     * @return String
     */
    public function excluir(TelefoneVO $objTelefoneVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTelefoneVO->getId()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos telefones de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {
            try {

                $objTelefoneDAO = new TelefoneDAO();

                $objBoHelper->setRetornoOperacao($objTelefoneDAO->excluir($objTelefoneVO));
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
     * @param TelefoneVO $objTelefoneVO
     * @return TelefoneVO
     */
    public function selecionar($objTelefoneVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (empty($objTelefoneVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos telefones de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {
            try {

                $objTelefoneDAO = new TelefoneDAO();

                $objBoHelper->setRetorno($objTelefoneDAO->selecionar($objTelefoneVO));
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
     * @param TelefoneVO $objTelefoneVO
     * @return String
     */
    public function alterar(TelefoneVO $objTelefoneVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objTelefoneVO->getIdTipoTelefone()->getId()) == 0) {
            $objBoHelper->addRetornoMensagem("Tipo Telefone não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objTelefoneVO->getIdPessoa()->getId()) == 0) {
            $objBoHelper->addRetornoMensagem("Pessoa não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objTelefoneVO->getDdd()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo DDD não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objTelefoneVO->getNumero()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo Número não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        /**
         *  Checando resultados dos telefones de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {

            try {

                $objTelefoneDAO = new TelefoneDAO();

                $objBoHelper->setRetornoOperacao($objTelefoneDAO->alterar($objTelefoneVO));
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
