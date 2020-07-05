<?php

namespace core\helper;

class PermissaoAcessoHelper {

    /**
     * Valida as permissões de acesso de acordo com o
     * array de permissões passado
     * @access public
     * @param  array $arrayPermissoes
     * @param  string $controle Nome do controlador
     * @param  string $acao Acao
     * @return bool
     */
    public function validarPermissao($arrayPermissoes, $controle, $acao = null) {

        if (is_null($acao)) {
            return isset($arrayPermissoes[$controle]);
        }
        return isset($arrayPermissoes[$controle][strtolower($acao)]);
    }

    /**
     * Realiza a reorganização dos dados coletados
     * @access public
     * @param \ArrayIterator $arrayItetatorRaseaVO  
     * @return Array Permissões de acesso organizadas
     */
    static public function reorganizar($arrayItetatorRaseaVO) {

        $arrayPermissoes = array();
        foreach ($arrayItetatorRaseaVO as $objRaseaVO) {
            $arrayPermissoes[$objRaseaVO->getRecursoNome()][strtolower($objRaseaVO->getAcaoNome())] = 1;
        }

        return $arrayPermissoes;
    }

}
