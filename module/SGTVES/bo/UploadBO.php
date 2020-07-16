<?php

namespace module\SGTVES\bo;

use config\SystemConfig;
use core\helper\BoHelper;
use module\SGTVES\vo\UploadVO;
use module\SGTVES\dao\UploadDAO;

# Classe de negócio referente a >Upload< #

class UploadBO {

    /**
     * Método que realiza a listagem
     * @param UploadVO $objUploadVO
     * @return ArrayObject
     */
    public function Upload(Upload $objUploadVO) {
        # Instanciando classe de apoio da camada #
        $objBoHelper = new BoHelper();

        # Realizando Procedimentos #
        try {
            $objUploadDAO = new UploadDAO();
            $objBoHelper->setRetorno($objUploadDAO->Upload($objUploadVO));
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            throw new \Exception("Não foi possível realizar a operação.");
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }


}