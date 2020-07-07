<?php

namespace module\SGTVES\bo;

use config\SystemConfig;
use core\helper\BoHelper;
use module\SGTVES\vo\ClienteVO;
use module\SGTVES\dao\ClienteDAO;

# Classe de negócio referente a >Cliente< #

class ClienteBO {

    /**
     * Método que realiza a listagem
     * @param ClienteVO $objClienteVO
     * @return ArrayObject
     */
    public function listar(ClienteVO $objClienteVO) {
        # Instanciando classe de apoio da camada #
        $objBoHelper = new BoHelper();

        # Realizando Procedimentos #
        try {
            $objClienteDAO = new ClienteDAO();
            $objBoHelper->setRetorno($objClienteDAO->listar($objClienteVO));
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            throw new \Exception("Não foi possível realizar a operação.");
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }



    /**
     * Realiza a checagem da regra de negócio referente a autenticação do Cliente no framework
     * @access protected
     * @param ClienteVO $objClienteVO 
     * @return Array Contem informações do retorno (Boolean) e mensagem (String)
     */
    public function autenticar(ClienteVO $objClienteVO) {
                    //    var_dump($objClienteVO); die;

        $objBoHelper = new BoHelper();

        ## RN ##
        if (strlen($objClienteVO->getUsers()) == 0) {
            $objBoHelper->addRetornoMensagem("O Cliente não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objClienteVO->getPassword()) == 0) {
            $objBoHelper->addRetornoMensagem("Senha não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        ## Executando ##

        if (!$objBoHelper->getChkErro()) {
            try {
                $objClienteDAO = new ClienteDAO();
                $objBoHelper->setRetorno($objClienteDAO->autenticar($objClienteVO));
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


    public function selecionarByUsers(ClienteVO $objClienteVO) {
        $objBoHelper = new BoHelper();
        # Verificando a Regra de Negócio #
        if (empty($objClienteVO->getUsers())) {
            $objBoHelper->addRetornoMensagem("Campo Cliente não pode ser vazio.");
            $objBoHelper->setChkErro(TRUE);
        }
        if (empty($objClienteVO->getPassword())) {
            $objBoHelper->addRetornoMensagem("Campo Senha não pode ser vazio.");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objClienteDAO = new ClienteDAO();
                $objBoHelper->setRetorno($objClienteDAO->selecionarByUsers($objClienteVO));
            } catch (\Exception $ex) {
                throw new \Exception($ex->getMessage());
            }
        } else {
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }
    

}