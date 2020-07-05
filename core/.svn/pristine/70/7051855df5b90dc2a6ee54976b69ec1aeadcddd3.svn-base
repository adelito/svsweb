<?php

namespace core\bo;

use core\helper\BoHelper;

/**
 * Classe de abstração Business Object
 * @package core
 * @subpackage bo
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
abstract class AbstractBO {

    /**
     * Instância de banco de dados
     * @var mixed $defaultInstance
     * @access private
     */
    private $defaultInstance;

    /**
     * Método retorna uma nova instância do BoHelper
     * @access protected
     * @param void
     * @return BoHelper Objeto da classe BoHelper
     */
    final protected function getNewInstanceBoHelper() {
        return new BoHelper();
    }

    /**
     * Método retorna uma nova instância de banco de dados
     * @access public
     * @param void
     * @return mixed instância de banco de dados
     */
    final public function getDefaultInstance() {
        return $this->defaultInstance;
    }

    /**
     * Método seta uma nova instância de banco de dados
     * @access public
     * @param  mixed $defaultInstance
     * @return void
     */
    final public function setDefaultInstance($defaultInstance) {
        $this->defaultInstance = $defaultInstance;
    }

    /**
     * Valida campos obrigatórios da aplicação
     * @access protected
     * @param array $campos Campos a serem validados
     * @throws Exception
     * @return void
     */
    final protected function validarCamposObrigatorios($campos) {
        $camposInvalidos = [];
        foreach ($campos as $key => $campo) {
            if ((is_array($campo) && count($campo) == 0) || $campo == null || $campo === '') {
                $camposInvalidos[] = $key;
            }
        }
        $totalCamposInvalidos = count($camposInvalidos);
        if ($totalCamposInvalidos > 1) {
            $descricaoCamposInvalidos = $camposInvalidos[0];
            for ($x = 1; $x < $totalCamposInvalidos - 1; $x++) {
                $descricaoCamposInvalidos .= ", " . $camposInvalidos[$x];
            }
            $descricaoCamposInvalidos .= " e " . $camposInvalidos[$totalCamposInvalidos - 1];
            throw new Exception("Os campos $descricaoCamposInvalidos são obrigatórios!");
        } elseif ($totalCamposInvalidos == 1) {
            throw new Exception("O campo $camposInvalidos[0] é obrigatório!");
        }
    }

    /**
     * Valida tamanho das Strings de um conjunto de campos
     * @access protected
     * @param array $arrayValidacaoLength Lista de instâncias ValidacaoTelaVO para validação
     * @throws Exception
     * @return void
     */
    final protected function validarLength($arrayValidacaoLength) {
        $camposInvalidos = [];
        foreach ($arrayValidacaoLength as $objeto) {
            if (($objeto != null && strlen($objeto->getValue()) > $objeto->getLength())) {
                $camposInvalidos[] = [$objeto->getNomeField(), $objeto->getLength()];
            }
        }
        $totalCamposInvalidos = count($camposInvalidos);
        if ($totalCamposInvalidos >= 1) {
            foreach ($camposInvalidos as $campo) {
                $mensagem .= "$campo[0] não pode possuir mais que $campo[1] caracteres. \n";
            }
            throw new Exception($mensagem);
        }
    }

    /**
     * Verifica se o conjunto de valores passados é numérico
     * @access protected
     * @param array $arrayValidacao
     * @throws Exception
     * @return void
     */
    final protected function isNumber($arrayValidacao) {
        $camposInvalidos = [];
        foreach ($arrayValidacao as $objeto) {
            if (($objeto != null && !is_numeric($objeto->getValue()))) {
                $camposInvalidos[] = [$objeto->getNomeField()];
            }
        }
        $totalCamposInvalidos = count($camposInvalidos);
        if ($totalCamposInvalidos >= 1) {
            foreach ($camposInvalidos as $campo) {
                $mensagem .= "$campo[0] deve ser um número! \n";
            }
            throw new Exception($mensagem);
        }
    }

    /**
     * Método responsável por buscar os dados de submodalidade por modalidade
     * @access protected
     * @param ValidacaoTelaVO $arrayValidacao
     * @throws Exception
     * @return void
     */
    final protected function isZero($arrayValidacao) {
        $camposInvalidos = [];
        foreach ($arrayValidacao as $objeto) {
            if (($objeto != null && $objeto->getValue() == 0)) {
                $camposInvalidos[] = [$objeto->getNomeField()];
            }
        }
        $totalCamposInvalidos = count($camposInvalidos);
        if ($totalCamposInvalidos >= 1) {
            foreach ($camposInvalidos as $campo) {
                $mensagem .= "$campo[0] não deve ser igual a 0! \n";
            }
            throw new Exception($mensagem);
        }
    }

}
