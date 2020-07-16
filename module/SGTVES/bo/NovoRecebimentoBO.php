<?php

namespace module\SGTVES\bo;

use config\SystemConfig;
use core\helper\BoHelper;
use module\SGTVES\dao\NovoRecebimentoDAO;
use module\SGTVES\vo\NovoRecebimentoVO;

# Classe de negócio referente a >NovoRecebimento< #

class NovoRecebimentoBO {

    /**
     * Método que realiza a listagem
     * @param NovoRecebimentoVO $objNovoRecebimentoVO
     * @return ArrayObject
     */
    public function listar(NovoRecebimentoVO $objNovoRecebimentoVO) {
        # Instanciando classe de apoio da camada #
        $objBoHelper = new BoHelper();

        # Realizando Procedimentos #
        try {
            $objNovoRecebimentoDAO = new NovoRecebimentoDAO();
            $objBoHelper->setRetorno($objNovoRecebimentoDAO->listar($objNovoRecebimentoVO));
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            throw new \Exception("Não foi possível realizar a operação.");
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }



    /**
     * Realiza a checagem da regra de negócio referente a autenticação do NovoRecebimento no framework
     * @access protected
     * @param NovoRecebimentoVO $objNovoRecebimentoVO
     * @return Array Contem informações do retorno (Boolean) e mensagem (String)
     */
    public function autenticar(NovoRecebimentoVO $objNovoRecebimentoVO) {
                    //    var_dump($objNovoRecebimentoVO); die;

        $objBoHelper = new BoHelper();

        ## RN ##
        if (strlen($objNovoRecebimentoVO->getUsers()) == 0) {
            $objBoHelper->addRetornoMensagem("O NovoRecebimento não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objNovoRecebimentoVO->getPassword()) == 0) {
            $objBoHelper->addRetornoMensagem("Senha não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        ## Executando ##

        if (!$objBoHelper->getChkErro()) {
            try {
                $objNovoRecebimentoDAO = new NovoRecebimentoDAO();
                $objBoHelper->setRetorno($objNovoRecebimentoDAO->autenticar($objNovoRecebimentoVO));
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


    public function selecionarByUsers(NovoRecebimentoVO $objNovoRecebimentoVO) {
        $objBoHelper = new BoHelper();
        # Verificando a Regra de Negócio #
        if (empty($objNovoRecebimentoVO->getUsers())) {
            $objBoHelper->addRetornoMensagem("Campo NovoRecebimento não pode ser vazio.");
            $objBoHelper->setChkErro(TRUE);
        }
        if (empty($objNovoRecebimentoVO->getPassword())) {
            $objBoHelper->addRetornoMensagem("Campo Senha não pode ser vazio.");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objNovoRecebimentoDAO = new NovoRecebimentoDAO();
                $objBoHelper->setRetorno($objNovoRecebimentoDAO->selecionarByUsers($objNovoRecebimentoVO));
            } catch (\Exception $ex) {
                throw new \Exception($ex->getMessage());
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }


    public function inserir(NovoRecebimentoVO $objNovoRecebimentoVO) {
        $objBoHelper = new BoHelper();

        # Verificando a Regra de Negócio #
        if (strlen($objNovoRecebimentoVO->getCnpjCliente()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha o campo – Cliente!");
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objNovoRecebimentoVO->getPlaca()) == 0) {
            $objBoHelper->addRetornoMensagem("Preencha o campo – Veículo!");
            $objBoHelper->setChkErro(TRUE);
        }


        if (!$objBoHelper->getChkErro()) {
            try {
                $objNovoRecebimentoDAO = new NovoRecebimentoDAO();
                $objBoHelper->setRetorno($objNovoRecebimentoDAO->inserir($objNovoRecebimentoVO));
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

}