<?php

namespace module\sistema\bo\login;

use core\helper\BoHelper;
use core\helper\LogHelper;
use module\sistema\dao\login\LoginDAO;
use module\sistema\vo\login\LoginVO;
use core\bo\AbstractBO;

/**
 * Classe de negócio referente a Login
 * @author Judá Passos Viegas Santos
 */
class LoginBO extends AbstractBO {

    /**
     * Método que realiza a autenticação do usuário
     * @param \module\sistema\vo\LoginVO $objLoginVO
     * @return \layers\helper\BoHelper
     */
    public function autenticar(LoginVO $objLoginVO) {


        $objBoHelper = new BoHelper();

        ## Verificando ##

        if (strlen($objLoginVO->getUsuario()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo USUARIO não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        if (strlen($objLoginVO->getSenha()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo SENHA não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        ## Executando ##

        if (!$objBoHelper->getChkErro()) {

            $objLoginDAO = new LoginDAO();

            try {

                $objBoHelper->setRetorno($objLoginDAO->autenticar($objLoginVO));

                if ($objBoHelper->getRetornoOperacao()) {

                    $objBoHelper->setRetornoMensagem("Alterado com sucesso!");
                } else {
                    $objBoHelper->setRetornoMensagem("Senha ou usuário incorretos!");
                }
            } catch (\Exception $ex) {
                echo "Desculpe! Ocorreu um erro durante a tentativa de autenticar o usuário";
            }
        } else {
//            LogHelper::registrar(__CLASS__, __FUNCTION__, $objBoHelper->getMsgRetorno());
            throw new \Exception($objBoHelper->getRetornoMensagemImplode());
        }

        ## Retornando ##

        return $objBoHelper->getRetorno();
    }

    private function validaAcesso($cpf, $permissoes) {
        $perfisLivres = array('administrador', 'equipecodeb', 'coordenadorcodeb', 'diretornte');
        foreach ($permissoes as $key => $descricao) {
            if (in_array($key, $perfisLivres)) {
                return true;
            }
        }
        $professorBO = new ProfessorBO();
    }

}
