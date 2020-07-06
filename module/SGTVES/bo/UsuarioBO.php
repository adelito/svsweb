<?php

namespace module\SGTVES\bo;

use config\SystemConfig;
use core\helper\BoHelper;
use module\SGTVES\vo\UsuarioVO;
use module\SGTVES\dao\UsuarioDAO;

# Classe de negócio referente a >Usuario< #

class UsuarioBO {

    /**
     * Método que realiza a listagem
     * @param UsuarioVO $objUsuarioVO
     * @return ArrayObject
     */
    public function listar(UsuarioVO $objUsuarioVO) {
        # Instanciando classe de apoio da camada #
        $objBoHelper = new BoHelper();

        # Realizando Procedimentos #
        try {
            $objUsuarioDAO = new UsuarioDAO();
            $objBoHelper->setRetorno($objUsuarioDAO->listar($objUsuarioVO));
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            throw new \Exception("Não foi possível realizar a operação.");
        }

        # Retornando resultado da operação #
        return $objBoHelper->getRetorno();
    }



    /**
     * Realiza a checagem da regra de negócio referente a autenticação do usuario no framework
     * @access protected
     * @param UsuarioVO $objUsuarioVO 
     * @return Array Contem informações do retorno (Boolean) e mensagem (String)
     */
    public function autenticar(UsuarioVO $objUsuarioVO) {
                    //    var_dump($objUsuarioVO); die;

        $objBoHelper = new BoHelper();

        ## RN ##
        if (strlen($objUsuarioVO->getUsers()) == 0) {
            $objBoHelper->addRetornoMensagem("O Usuario não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        if (strlen($objUsuarioVO->getPassword()) == 0) {
            $objBoHelper->addRetornoMensagem("Senha não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        ## Executando ##

        if (!$objBoHelper->getChkErro()) {
            try {
                $objUsuarioDAO = new UsuarioDAO();
                $objBoHelper->setRetorno($objUsuarioDAO->autenticar($objUsuarioVO));
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


    public function selecionarByUsers(UsuarioVO $objUsuarioVO) {
        $objBoHelper = new BoHelper();
        # Verificando a Regra de Negócio #
        if (empty($objUsuarioVO->getUsers())) {
            $objBoHelper->addRetornoMensagem("Campo usuario não pode ser vazio.");
            $objBoHelper->setChkErro(TRUE);
        }
        if (empty($objUsuarioVO->getPassword())) {
            $objBoHelper->addRetornoMensagem("Campo Senha não pode ser vazio.");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objUsuarioDAO = new UsuarioDAO();
                $objBoHelper->setRetorno($objUsuarioDAO->selecionarByUsers($objUsuarioVO));
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