<?php

namespace core\bo\pessoa;

use config\SystemConfig;
use core\helper\BoHelper;

use core\vo\pessoa\EnderecoVO;
use core\dao\pessoa\EnderecoDAO;

/**
 * Classe de negócio referente a (Disciplina)
 */
class EnderecoBO {

    /**
     * Método que realiza a listagem
     * @param EnderecoVO $objEnderecoVO
     * @return ArrayObject
     */
    public function listar(EnderecoVO $objEnderecoVO) {

        $objBoHelper = new BoHelper();

        /**
         *  realizando procedimentos
         */
        try {

            $objEnderecoDAO = new EnderecoDAO();
            $objBoHelper->setRetorno($objEnderecoDAO->listar($objEnderecoVO));
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
     * Método que realiza a listagem
     * @param EnderecoVO $objEnderecoVO
     * @return ArrayObject
     */
    public function selecionar($objEnderecoVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (empty($objEnderecoVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {

                $objEnderecoDAO = new EnderecoDAO();

                $objBoHelper->setRetorno($objEnderecoDAO->selecionar($objEnderecoVO));
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
     * @param EnderecoVO $objEnderecoVO
     * @return String
     */
    public function inserir(EnderecoVO $objEnderecoVO) {

        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objEnderecoVO->getEndereco()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha este campo!");
            $objBoHelper->setChkErro(TRUE);
        }

        
        //    $objBoHelper->validacaoPadraoCadastro($objEnderecoVO);

        /**
         *  Checando resultados dos portalpowerbis de validação e realizando procedimentos de persistencia
         */
        if (!$objBoHelper->getChkErro()) {

            try {

                $objEnderecoDAO = new EnderecoDAO();

                $objBoHelper->setRetorno($objEnderecoDAO->inserir($objEnderecoVO));

                $objBoHelper->addRetornoMensagem("Adicionado com sucesso!");
            } catch (\Exception $ex) {

                echo $ex->getMessage();
                die;
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

    public function alterar(EnderecoVO $objEnderecoVO) {

        $objBoHelper = new BoHelper();


        if (strlen($objEnderecoVO->getEndereco()) == "") {
            $objBoHelper->addRetornoMensagem("Preencha este campo!");
            $objBoHelper->setChkErro(TRUE);
        }
    
//        $objBoHelper->validacaoPadraoAlteracao($objEnderecoVO);

        if (!$objBoHelper->getChkErro()) {

            try {

                $objEnderecoDAO = new EnderecoDAO();

                $objBoHelper->setRetornoOperacao($objEnderecoDAO->alterar($objEnderecoVO));

                $objBoHelper->addRetornoMensagem("Alterado com sucesso!");
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
     * @param EnderecoVO $objEnderecoVO
     * @return String
     */
    public function excluir(EnderecoVO $objEnderecoVO) {

        $objBoHelper = new BoHelper();
        /**
         *  Verificando Regra de negócio
         */
        if (empty($objEnderecoVO->getEndereco())) {
             $objBoHelper->addRetornoMensagem(SystemConfig::SYSTEM_MSG['MSG01']);
            $objBoHelper->setChkErro(TRUE);
        }
    
        //$objBoHelper->validacaoPadraoAlteracao($objMaquinaVO);

        if (!$objBoHelper->getChkErro()) {
            try {

                $objEnderecoDAO = new EnderecoDAO();
                $objBoHelper->setRetornoOperacao($objEnderecoDAO->excluir($objEnderecoVO));
                $objBoHelper->addRetornoMensagem("Excluido com sucesso!");
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
     * @param EnderecoVO $objEnderecoVO
     * @return String
     */

     /**
     * Verifica a existencia de um registro
     * 
     * @param EnderecoVO $objEnderecoVO
     * @return EnderecoVO
     */
    public function existeDependencia($objEnderecoVO, $exceto = FALSE) {
        $objBoHelper = new BoHelper();

        if (!$objBoHelper->getChkErro()) {
            try {
                $objEnderecoDAO = new EnderecoDAO();
                $objBoHelper->setRetorno($objEnderecoDAO->existeDependencia($objEnderecoVO, $exceto));
            } catch (\Exception $ex) {

                throw new \Exception("Não foi Possível realizar a operação");
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }
        /**
         *  Retornando Resultado da operação
         */
        return $objBoHelper->getRetornoOperacao();
    }
    
    
}
