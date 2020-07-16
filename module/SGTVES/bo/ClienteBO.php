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


}