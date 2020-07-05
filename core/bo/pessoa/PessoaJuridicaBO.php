<?php

namespace core\bo\pessoa;

use core\vo\pessoa\PessoaJuridicaVO;
use core\dao\pessoa\PessoaJuridicaDAO;
use core\helper\BoHelper;
use core\helper\DataHelper;
use core\helper\CnpjHelper;

/**
 * Classe de negócio referente a (Pessoa)
 */
class PessoaJuridicaBO {

    
    public function listar(PessoaJuridicaVO $objPessoaJuridicaVO) {

        $objBoHelper = new BoHelper();
        
        try {
            $objPessoaJuridicaDAO = new PessoaJuridicaDAO();
            $objBoHelper->setRetorno($objPessoaJuridicaDAO->listar($objPessoaJuridicaVO));
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            throw new \Exception("Não foi Possível realizar a operação");
        }
        return $objBoHelper->getRetorno();
    }

    public function inserir(PessoaJuridicaVO $objPessoaJuridicaVO) {

        $objBoHelper = new BoHelper();
        
        //PessoaJuridicaVO
        if (strlen($objPessoaJuridicaVO->getCnpj()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo CNPJ não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }elseif( $this->existe($objPessoaJuridicaVO)){
            $objBoHelper->addRetornoMensagem('O CNPJ já está cadrastrado!');
            $objBoHelper->setChkErro(TRUE);       
        }elseif (!CnpjHelper::isValid($objPessoaJuridicaVO->getCpf())) {
            $objBoHelper->addRetornoMensagem('o CNPJ informado é inválido!');
            $objBoHelper->setChkErro(TRUE);
        }        
        
        
        //PessoaVO
        if (strlen($objPessoaJuridicaVO->getTipoPessoa()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo tipo pessoa não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        
        if (strlen($objPessoaJuridicaVO->getNome()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo nome não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        //Email pode ser nulo,mas caso n seja nulo tem que ser um email válido
        if (!is_null($objPessoaJuridicaVO->getEmail())) {
            if (!filter_var($objPessoaJuridicaVO->getEmail(), FILTER_VALIDATE_EMAIL)) {
                $objBoHelper->addRetornoMensagem('Email inválido!');
                $objBoHelper->setChkErro(TRUE);      
            }
        }
        
        
        //Data pode ser nulo,mas caso n seja nulo tem que ser um email válido
        if (!is_null($objPessoaJuridicaVO->getModificadoEm())) {               
            if (!DataHelper::isValid($objPessoaJuridicaVO->getModificadoEm())) {
                $objBoHelper->addRetornoMensagem("Data de modificação é inválida!");
                $objBoHelper->setChkErro(TRUE);
            }            
        }
        
        $objBoHelper->validacaoPadraoCadastro($objPessoaJuridicaVO);

        if (!$objBoHelper->getChkErro()) {

            try {

                $objPessoaJuridicaDAO = new PessoaJuridicaDAO();

                $objBoHelper->setRetorno($objPessoaJuridicaDAO->inserir($objPessoaJuridicaVO));
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

   
    public function excluir(PessoaJuridicaVO $objPessoaJuridicaVO) {

        $objBoHelper = new BoHelper();

        if (empty($objPessoaJuridicaVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }


        $objBoHelper->validacaoPadraoAlteracao($objPessoaJuridicaVO);

        if (!$objBoHelper->getChkErro()) {
            try {

                $objPessoaJuridicaDAO = new PessoaJuridicaDAO();

                $objBoHelper->setRetornoOperacao($objPessoaJuridicaDAO->excluir($objPessoaJuridicaVO));
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

    
    public function selecionar(PessoaJuridicaVO $objPessoaJuridicaVO) {

        $objBoHelper = new BoHelper();

        if (empty($objPessoaJuridicaVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }
        
        if (!$objBoHelper->getChkErro()) {
            try {
                
                $objPessoaJuridicaDAO = new PessoaJuridicaDAO();
                $objBoHelper->setRetorno($objPessoaJuridicaDAO->selecionar($objPessoaJuridicaVO));
                
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
    
    public function alterar(PessoaJuridicaVO $objPessoaJuridicaVO) {

        $objBoHelper = new BoHelper();
        
        
        if (strlen($objPessoaJuridicaVO->getTipoPessoa()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo tipo pessoa não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        
        if (strlen($objPessoaJuridicaVO->getNome()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo nome não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        //Email pode ser nulo,mas caso n seja nulo tem que ser um email válido
        if (!is_null($objPessoaJuridicaVO->getEmail())) {
            if (!filter_var($objPessoaJuridicaVO->getEmail(), FILTER_VALIDATE_EMAIL)) {
                $objBoHelper->addRetornoMensagem('Email inválido!');
                $objBoHelper->setChkErro(TRUE);      
            }
        }
        
        
        //Data pode ser nulo,mas caso n seja nulo tem que ser um email válido
        if (!is_null($objPessoaJuridicaVO->getModificadoEm())) {               
            if (!DataHelper::isValid($objPessoaJuridicaVO->getModificadoEm())) {
                $objBoHelper->addRetornoMensagem("Data de modificação é inválida!");
                $objBoHelper->setChkErro(TRUE);
            }            
        }
        
        $objBoHelper->validacaoPadraoCadastro($objPessoaJuridicaVO);
        
        if (!$objBoHelper->getChkErro()) {

            try {

                $objPessoaJuridicaDAO = new PessoaJuridicaDAO();
                $objBoHelper->setRetornoOperacao($objPessoaJuridicaDAO->alterar($objPessoaJuridicaVO));
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

    /**
     * 
     * @param PessoaJuridicaVO $objPessoaJuridicaVO
     * @return type
     * @throws \Exception
     */
    public function existe(PessoaJuridicaVO $objPessoaJuridicaVO) {


        $objBoHelper = new BoHelper();
        
        if (empty($objPessoaJuridicaVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objPessoaJuridicaDAO = new PessoaJuridicaDAO();
                $objBoHelper->setRetornoOperacao($objPessoaJuridicaDAO->existe($objPessoaJuridicaVO));                
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
