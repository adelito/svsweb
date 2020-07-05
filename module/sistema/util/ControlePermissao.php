<?php

namespace module\sistema\util;

use module\siapp\consts\PerfilConsts;

class ControlePermissao {

    public function validarPermissao($controle, $perfil) {

//        switch ($controle) {
//            case 'inicio':
//                return(true);
//            case 'perfil':
//                return(true);
//            case 'usuario':
//                if ($perfil == PerfilConsts::ADMINISTRATIVO || $perfil == PerfilConsts::APOIO_ADMINISTRATIVO
//                        || $perfil == PerfilConsts::COORDENADOR_POLO || $perfil == PerfilConsts::COORDENADOR_UNIVERSIDADE
//                        || $perfil == PerfilConsts::COORDENADOR_CURSO || $perfil == PerfilConsts::EQUIPE_UNIVERSIDADE) {
//                    return(true);
//                }
//                break;
//            case 'universidade':
//                if ($perfil == PerfilConsts::ADMINISTRATIVO || $perfil == PerfilConsts::APOIO_ADMINISTRATIVO
//                        || $perfil == PerfilConsts::COORDENADOR_POLO) {
//                    return(true);
//                }
//                break;
//            case 'curso':
//                if ($perfil == PerfilConsts::ADMINISTRATIVO || $perfil == PerfilConsts::APOIO_ADMINISTRATIVO
//                        || $perfil == PerfilConsts::COORDENADOR_POLO || $perfil == PerfilConsts::COORDENADOR_UNIVERSIDADE
//                        || $perfil == PerfilConsts::EQUIPE_UNIVERSIDADE) {
//                    return(true);
//                }
//                break;
//            case 'territorioidentidade':
//                if ($perfil == PerfilConsts::ADMINISTRATIVO || $perfil == PerfilConsts::APOIO_ADMINISTRATIVO) {
//                    return(true);
//                }
//                break;
//            case 'polo':
//                if ($perfil == PerfilConsts::ADMINISTRATIVO || $perfil == PerfilConsts::APOIO_ADMINISTRATIVO
//                        || $perfil == PerfilConsts::COORDENADOR_POLO) {
//                    return(true);
//                }
//                break;
//            case 'edital':
//                if ($perfil == PerfilConsts::ADMINISTRATIVO || $perfil == PerfilConsts::APOIO_ADMINISTRATIVO
//                        || $perfil == PerfilConsts::COORDENADOR_POLO) {
//                    return(true);
//                }
//                break;
//            case 'editaluniversidade':
//                if ($perfil == PerfilConsts::ADMINISTRATIVO || $perfil == PerfilConsts::APOIO_ADMINISTRATIVO
//                        || $perfil == PerfilConsts::COORDENADOR_POLO) {
//                    return(true);
//                }
//                break;
//            case 'cursouniversidade':
//                if ($perfil == PerfilConsts::ADMINISTRATIVO || $perfil == PerfilConsts::APOIO_ADMINISTRATIVO
//                        || $perfil == PerfilConsts::COORDENADOR_POLO || $perfil == PerfilConsts::COORDENADOR_UNIVERSIDADE
//                        || $perfil == PerfilConsts::EQUIPE_UNIVERSIDADE) {
//                    return(true);
//                }
//                break;
//        }

        return true;
    }

    public function validarPermissaoAcao($controle, $acao, $perfil) {
        return true;
    }

}
