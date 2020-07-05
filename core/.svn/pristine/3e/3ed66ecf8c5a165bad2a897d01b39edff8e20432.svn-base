<?php

namespace core\bo\pessoa;

use core\helper\BoHelper;
use core\vo\pessoa\pessoa\EmailVO;
use core\dao\pessoa\EmailDAO;
use core\vo\pessoa\EmailVO;

/**
 * Classe de negócio referente a E-mail
 * @access public
 * @package core
 * @subpackage bo
 */
class EmailBO {

    /**
     * Método que realiza a checagem das regras referente a listagem de e-mails
     * @param EmailVO $objEmailVO
     * @return ArrayIterator
     * @throws Exception Caso não esteja em conformidade com a RN ou em caso de erro de banco de dados
     */
    public function listar(EmailVO $objEmailVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objBoHelper = new BoHelper();

        /**
         *  Realizando procedimentos
         */
        try {

            $objEmailDAO = new EmailDAO();
            $objBoHelper->setRetorno($objEmailDAO->listar($objEmailVO));
        } catch (\Exception $ex) {
            throw new \Exception("Não foi Possível realizar a operação");
        }

        /**
         *  Retornando Resultado da operação
         */
        return $objBoHelper->getRetorno();
    }

    /**
     * Método que realiza a checagem das regras referente a seleção de um determinado e-mail
     * @param EmailVO $objEmailVO
     * @return EmailVO
     * @throws Exception Caso não esteja em conformidade com a RN ou em caso de erro de banco de dados
     */
    public function selecionar(EmailVO $objEmailVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (empty($objEmailVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {

            /**
             *  Realizando procedimentos
             */
            try {

                $objEmailDAO = new EmailDAO();

                $objBoHelper->setRetorno($objEmailDAO->selecionar($objEmailVO));
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
     * Método que realiza a checagem das regras referente a inclusão de um e-mail
     * @param EmailVO $objEmailVO
     * @return boolean
     * @throws Exception Caso não esteja em conformidade com a RN ou em caso de erro de banco de dados
     */
    public function inserir(EmailVO $objEmailVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objEmailVO->getEndereco()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha este campo!");
            $objBoHelper->setChkErro(TRUE);
        }

        if ($this->existe($objEmailVO, TRUE)) {
            $objBoHelper->addRetornoMensagem("E-mail já existe!");
            $objBoHelper->setChkErro(TRUE);
        }


        if (!$objBoHelper->getChkErro()) {

            /**
             *  Realizando procedimentos
             */
            try {

                $objEmailDAO = new EmailDAO();

                $objBoHelper->setRetorno($objEmailDAO->inserir($objEmailVO));

                $objBoHelper->addRetornoMensagem("Adicionado com sucesso!");
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
     * Método que realiza a checagem das regras referente a alteração de um e-mail
     * @param EmailVO $objEmailVO
     * @return boolean
     * @throws Exception Caso não esteja em conformidade com a RN ou em caso de erro de banco de dados
     */
    public function alterar(EmailVO $objEmailVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (strlen($objEmailVO->getEndereco()) == "") {
            $objBoHelper->addRetornoMensagem("Preencha este campo!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {

            /**
             *  Realizando procedimentos
             */
            try {

                $objEmailDAO = new EmailDAO();

                $objBoHelper->setRetornoOperacao($objEmailDAO->alterar($objEmailVO));

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
     * Método que realiza a checagem das regras referente a exclusão de um e-mail
     * @param EmailVO $objEmailVO
     * @return boolean
     * @throws Exception Caso não esteja em conformidade com a RN ou em caso de erro de banco de dados
     */
    public function excluir(EmailVO $objEmailVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (empty($objEmailVO->getEndereco())) {
            $objBoHelper->addRetornoMensagem("Campo endereço não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {

            /**
             *  Realizando procedimentos
             */
            try {

                $objEmailDAO = new EmailDAO();
                $objBoHelper->setRetornoOperacao($objEmailDAO->excluir($objEmailVO));
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
     * Verifica a dependência de um registro de e-mail
     * @param EmailVO $objEmailVO
     * @return EmailVO
     * @throws Exception Caso não esteja em conformidade com a RN ou em caso de erro de banco de dados
     */
    public function existeDependencia($objEmailVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objBoHelper = new BoHelper();

        if (!$objBoHelper->getChkErro()) {

            /**
             *  Realizando procedimentos
             */
            try {
                $objEmailDAO = new EmailDAO();
                $objBoHelper->setRetorno($objEmailDAO->existeDependencia($objEmailVO));
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
