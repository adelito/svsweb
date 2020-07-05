<?php

namespace core\bo\pessoa;

use core\vo\pessoa\PessoaFisicaVO;
use core\dao\pessoa\PessoaFisicaDAO;
use core\helper\BoHelper;
use core\helper\DataHelper;
use core\helper\CpfHelper;

/**
 * Classe de negócio referente a (Pessoa)
 */
class PessoaBO {

    
    public function listar(PessoaFisicaVO $objPessoaFisicaVO) {

        $objBoHelper = new BoHelper();
        
        try {
            $objPessoaFisicaDAO = new PessoaFisicaDAO();
            $objBoHelper->setRetorno($objPessoaFisicaDAO->listar($objPessoaFisicaVO));
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            throw new \Exception("Não foi Possível realizar a operação");
        }
        return $objBoHelper->getRetorno();
    }

    public function inserir(PessoaFisicaVO $objPessoaFisicaVO) {

        $objBoHelper = new BoHelper();
        
        //PessoaFisicaVO
        if (strlen($objPessoaFisicaVO->getCpf()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo CPF não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }elseif( $this->existe($objPessoaFisicaVO)){
            $objBoHelper->addRetornoMensagem('O cpf já está cadrastrado!');
            $objBoHelper->setChkErro(TRUE);       
        }elseif (!CpfHelper::isValid($objPessoaFisicaVO->getCpf())) {
            $objBoHelper->addRetornoMensagem('o CPF informado é inválido!');
            $objBoHelper->setChkErro(TRUE);
        }        
        
        
        //PessoaVO
        if (strlen($objPessoaFisicaVO->getTipoPessoa()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo tipo pessoa não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        
        if (strlen($objPessoaFisicaVO->getNome()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo nome não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        //Email pode ser nulo,mas caso n seja nulo tem que ser um email válido
        if (!is_null($objPessoaFisicaVO->getEmail())) {
            if (!filter_var($objPessoaFisicaVO->getEmail(), FILTER_VALIDATE_EMAIL)) {
                $objBoHelper->addRetornoMensagem('Email inválido!');
                $objBoHelper->setChkErro(TRUE);      
            }
        }
        
        
        //Data pode ser nulo,mas caso n seja nulo tem que ser um email válido
        if (!is_null($objPessoaFisicaVO->getModificadoEm())) {               
            if (!DataHelper::isValid($objPessoaFisicaVO->getModificadoEm())) {
                $objBoHelper->addRetornoMensagem("Data de modificação é inválida!");
                $objBoHelper->setChkErro(TRUE);
            }            
        }
        
        $objBoHelper->validacaoPadraoCadastro($objPessoaFisicaVO);

        if (!$objBoHelper->getChkErro()) {

            try {

                $objPessoaFisicaDAO = new PessoaFisicaDAO();

                $objBoHelper->setRetorno($objPessoaFisicaDAO->inserir($objPessoaFisicaVO));
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

   
    public function excluir(PessoaFisicaVO $objPessoaFisicaVO) {

        $objBoHelper = new BoHelper();

        if (empty($objPessoaFisicaVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }


        $objBoHelper->validacaoPadraoAlteracao($objPessoaFisicaVO);

        if (!$objBoHelper->getChkErro()) {
            try {

                $objPessoaFisicaDAO = new PessoaFisicaDAO();

                $objBoHelper->setRetornoOperacao($objPessoaFisicaDAO->excluir($objPessoaFisicaVO));
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

    
    public function selecionar(PessoaFisicaVO $objPessoaFisicaVO) {

        $objBoHelper = new BoHelper();

        if (empty($objPessoaFisicaVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }
        
        if (!$objBoHelper->getChkErro()) {
            try {
                
                $objPessoaFisicaDAO = new PessoaFisicaDAO();
                $objBoHelper->setRetorno($objPessoaFisicaDAO->selecionar($objPessoaFisicaVO));
                
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
    
    public function alterar(PessoaFisicaVO $objPessoaFisicaVO) {

        $objBoHelper = new BoHelper();
        
        
        if (strlen($objPessoaFisicaVO->getTipoPessoa()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo tipo pessoa não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }
        
        if (strlen($objPessoaFisicaVO->getNome()) == 0) {
            $objBoHelper->addRetornoMensagem("Campo nome não pode ser vazio!");
            $objBoHelper->setChkErro(TRUE);
        }

        //Email pode ser nulo,mas caso n seja nulo tem que ser um email válido
        if (!is_null($objPessoaFisicaVO->getEmail())) {
            if (!filter_var($objPessoaFisicaVO->getEmail(), FILTER_VALIDATE_EMAIL)) {
                $objBoHelper->addRetornoMensagem('Email inválido!');
                $objBoHelper->setChkErro(TRUE);      
            }
        }
        
        
        //Data pode ser nulo,mas caso n seja nulo tem que ser um email válido
        if (!is_null($objPessoaFisicaVO->getModificadoEm())) {               
            if (!DataHelper::isValid($objPessoaFisicaVO->getModificadoEm())) {
                $objBoHelper->addRetornoMensagem("Data de modificação é inválida!");
                $objBoHelper->setChkErro(TRUE);
            }            
        }
        
        $objBoHelper->validacaoPadraoCadastro($objPessoaFisicaVO);
        
        if (!$objBoHelper->getChkErro()) {

            try {

                $objPessoaFisicaDAO = new PessoaFisicaDAO();
                $objBoHelper->setRetornoOperacao($objPessoaFisicaDAO->alterar($objPessoaFisicaVO));
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
     * @param PessoaFisicaVO $objPessoaFisicaVO
     * @return type
     * @throws \Exception
     */
    public function existe(PessoaFisicaVO $objPessoaFisicaVO) {


        $objBoHelper = new BoHelper();
        
        if (empty($objPessoaFisicaVO->getId())) {
            $objBoHelper->addRetornoMensagem("Campo id não pode ser vazio");
            $objBoHelper->setChkErro(TRUE);
        }

        if (!$objBoHelper->getChkErro()) {
            try {
                $objPessoaFisicaDAO = new PessoaFisicaDAO();
                $objBoHelper->setRetornoOperacao($objPessoaFisicaDAO->existe($objPessoaFisicaVO));                
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
