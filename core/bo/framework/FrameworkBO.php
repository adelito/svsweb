<?php

namespace core\bo\framework;

use core\helper\BoHelper;
use core\dao\framework\FrameworkDAO;
use core\vo\framework\FrameworkVO;

/**
 * Classe de negócio referente a Framework
 * @access public
 * @package core
 * @subpackage bo
 * 
 */
class FrameworkBO {

    /**
     * Método inicializa a utlização da tabela de configuração do Framework
     * @param FrameworkVO $objFrameworkVO
     * @return ArrayIterator
     * @throws Exception Caso não esteja em conformidade com a RN ou em caso de erro de banco de dados
     */
    public function inicializar(FrameworkVO $objFrameworkVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (empty($objFrameworkVO->getUsuario())) {
            $objBoHelper->addRetornoMensagem("O usuário não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }
        if (empty($objFrameworkVO->getEsquemaTabela())) {
            $objBoHelper->addRetornoMensagem("O esquema da tabela não foi definido");
            $objBoHelper->setChkErro(TRUE);
        }


        if (!$objBoHelper->getChkErro()) {
            /**
             *  Realizando procedimentos
             */
            try {

                $objFrameworkDAO = new FrameworkDAO();
                
                $objBoHelper->setRetornoOperacao(TRUE);

                if (!$this->existeConfiguracaoParaUsuario($objFrameworkVO)) {
                    
                    $objBoHelper->setRetornoOperacao($this->criarConfiguracaoParaUsuario($objFrameworkVO));
                }
                
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

    /**
     * Método que verifica se existe um registro de configuração para um determinado usuário
     * @param FrameworkVO $objFrameworkVO
     * @return ArrayIterator
     * @throws Exception Caso não esteja em conformidade com a RN ou em caso de erro de banco de dados
     */
    private function existeConfiguracaoParaUsuario(FrameworkVO $objFrameworkVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (empty($objFrameworkVO->getUsuario())) {
            $objBoHelper->addRetornoMensagem("O usuário não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }
        if (empty($objFrameworkVO->getEsquemaTabela())) {
            $objBoHelper->addRetornoMensagem("O esquema da tabela não foi definido");
            $objBoHelper->setChkErro(TRUE);
        }


        if (!$objBoHelper->getChkErro()) {
            /**
             *  Realizando procedimentos
             */
            try {

                $objFrameworkDAO = new FrameworkDAO();

                $objBoHelper->setRetorno($objFrameworkDAO->existeConfiguracaoParaUsuario($objFrameworkVO));

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

    /**
     * Método que cria um registro de configuração inicial para um determinado usuário
     * @param FrameworkVO $objFrameworkVO
     * @return ArrayIterator
     * @throws Exception Caso não esteja em conformidade com a RN ou em caso de erro de banco de dados
     */
    private function criarConfiguracaoParaUsuario(FrameworkVO $objFrameworkVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (empty($objFrameworkVO->getUsuario())) {
            $objBoHelper->addRetornoMensagem("O usuário não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }
        if (empty($objFrameworkVO->getEsquemaTabela())) {
            $objBoHelper->addRetornoMensagem("O esquema da tabela não foi definido");
            $objBoHelper->setChkErro(TRUE);
        }


        if (!$objBoHelper->getChkErro()) {
            /**
             *  Realizando procedimentos
             */
            try {

                $objFrameworkDAO = new FrameworkDAO();
                $objBoHelper->setRetorno($objFrameworkDAO->criarConfiguracaoParaUsuario($objFrameworkVO));
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

    /**
     * Método que realiza atualização da foto do perfil de acesso
     * @param FrameworkVO $objFrameworkVO
     * @return ArrayIterator
     * @throws Exception Caso não esteja em conformidade com a RN ou em caso de erro de banco de dados
     */
    public function atualizarFotoPerfil(FrameworkVO $objFrameworkVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (empty($objFrameworkVO->getUsuario())) {
            $objBoHelper->addRetornoMensagem("O usuário não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }
        if (empty($objFrameworkVO->getFotoPerfil())) {
            $objBoHelper->addRetornoMensagem("A foto do perfil não foi definida");
            $objBoHelper->setChkErro(TRUE);
        }
        if (empty($objFrameworkVO->getEsquemaTabela())) {
            $objBoHelper->addRetornoMensagem("O esquema da tabela não foi definido");
            $objBoHelper->setChkErro(TRUE);
        }


        if (!$objBoHelper->getChkErro()) {
            /**
             *  Realizando procedimentos
             */
            try {

                $objFrameworkDAO = new FrameworkDAO();

                $objBoHelper->setRetorno($objFrameworkDAO->atualizarFotoPerfil($objFrameworkVO));
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

    /**
     * Método que realiza atualização da foto do perfil de acesso
     * @param FrameworkVO $objFrameworkVO
     * @return ArrayIterator
     * @throws Exception Caso não esteja em conformidade com a RN ou em caso de erro de banco de dados
     */
    public function getConfiguracaoUsuario(FrameworkVO $objFrameworkVO) {

        /**
         *  Criando instância da classe de apoio da camada
         */
        $objBoHelper = new BoHelper();

        /**
         *  Verificando Regra de negócio
         */
        if (empty($objFrameworkVO->getUsuario())) {
            $objBoHelper->addRetornoMensagem("O usuário não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        if (empty($objFrameworkVO->getEsquemaTabela())) {
            $objBoHelper->addRetornoMensagem("O esquema da tabela não foi definido");
            $objBoHelper->setChkErro(TRUE);
        }


        if (!$objBoHelper->getChkErro()) {
            /**
             *  Realizando procedimentos
             */
            try {

                $objFrameworkDAO = new FrameworkDAO();

                $objBoHelper->setRetorno($objFrameworkDAO->getConfiguracaoUsuario($objFrameworkVO));
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
