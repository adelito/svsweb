<?php

namespace core\bo\pessoa;

use core\vo\pessoa\PessoaResponsavelVO;
use core\dao\pessoa\PessoaResponsavelDAO;
use core\helper\BoHelper;


/**
 * Classe de negócio referente a (Pessoa)
 */
class PessoaResponsavelBO{

    
    public function listar(PessoaResponsavelVO $objPessoaResponsavelVO) {

        $objBoHelper = new BoHelper();
        
        try {
            $objPessoaResponsavelDAO = new PessoaResponsavelDAO();
            $objBoHelper->setRetorno($objPessoaResponsavelDAO->listar($objPessoaResponsavelVO));
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            throw new \Exception("Não foi Possível realizar a operação");
        }
        return $objBoHelper->getRetorno();
    }

    public function inserir(PessoaResponsavelVO $objPessoaResponsavelVO) {

        $objBoHelper = new BoHelper();
        
        
        
        
        if (strlen($objPessoaResponsavelVO->getIdPessoa()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo id pessoa não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        
        if (strlen($objPessoaResponsavelVO->getIdResponsavel()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo id responsável não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        

        if (!$objBoHelper->getChkErro()) {

            try {

                $objPessoaResponsavelDAO = new PessoaResponsavelDAO();

                $objBoHelper->setRetorno($objPessoaResponsavelDAO->inserir($objPessoaResponsavelVO));
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
        return $objBoHelper->getRetorno();
    }
    
    public function alterar(PessoaResponsavelVO $objPessoaResponsavelVO) {

        $objBoHelper = new BoHelper();
        
      
        
        if (strlen($objPessoaResponsavelVO->getIdPessoa()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo id pessoa não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        
        if (strlen($objPessoaResponsavelVO->getIdResponsavel()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo id responsável não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        
        
        if (!$objBoHelper->getChkErro()) {

            try {

                $objPessoaResponsavelDAO = new PessoaResponsavelDAO();
                $objBoHelper->setRetornoOperacao($objPessoaResponsavelDAO->alterar($objPessoaResponsavelVO));
                $objBoHelper->addRetornoMensagem('Alterado com sucesso!');
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

    
}
