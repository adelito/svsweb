<?php

namespace config;

use core\config\SystemCoreConfig;

/**
 * Classe de Configuração do sistema
 */
class SystemConfig extends SystemCoreConfig
{

    const SYSTEM_MSG = array(
        'MSG1' => 'Preencha este campo!',
        'MSG2' => 'Adicionado com sucesso!',
        'MSG3' => 'Alterado com sucesso!',
        'MSG4' => 'Excluído com sucesso!',
        'MSG5' => 'Login ou Senha invalida!',
        'MSG6' => 'Logado com Sucesso!',
        'MSG7' => 'Login ou Senha invalida!',
        'MSG8' => 'CPF inválido',
        'MSG9' => 'Inativado com sucesso!',
        'MSG10' => 'Ativado com sucesso!',
        'MSG11' => 'Usuário Inexistente ou senha inválida!',
        'MSG12' => 'Login realizado com sucesso!',
    );
   
    const SYSTEM_ROOT = "";
    const SYSTEM_NAME = "VIVALDO & SOUZA";
    const SYSTEM_NAME_FORMATED = 'V<i style="color:red ">& </i>S';
    const SYSTEM_DESCRICAO = 'Transporte e Logistica';
    const FRAMEWORK_USE_CONFIG = TRUE;

    # AUTENTICAÇÃO
    const AUTH_RASEA_APPLICATION_NAME = "framework"; # NOME DA APLICAÇÃO (IGUAL AO RASEA)
    # AMBIENTE DE TRABALHO
    const ENVIRONMENT = "DESENVOLVIMENTO"; # [DESENVOLVIMENTO - HOMOLOGACAO - PRODUCAO]
    # CUSTOM
    const RECAPTCHA_SECRET_KEY = "6Ldg2rEUAAAAAF3tYuzvNBZ6GBR1IioTKWs6fc1O";
    const RECAPTCHA_PUBLIC_KEY = "6Ldg2rEUAAAAAI2s5lPpGCyLphEtDmrHm2vrtrV4";
    const EMAIL_REMETENTE = "nao-responda@educacao.ba.gov.br";
    const NOME_REMETENTE = "Controle de Segurança";
    const CHAVE_APLICACAO = "#DEV@SEC-SGOB";
    const LOGO_APP_IMG = '';

    # LEFT SIDEBAR
    const LS_CLOSED = TRUE;

    # COLOR THEME
    const FRAMEWORK_COLOR_THEME = 'theme-defaultframework';

    #************************************************************************
    #->  CONFIGURAÇÃO DE AMBIENTE - N3
    #************************************************************************
    # O CAMINHO DE UPLOAD PRECISA SER RELATIVO E É USADO PELA VIEW /public/siapp/ etc;
    //    const UPLOAD_DIR = '/public/siapp/arquivos/';
    # O CAMINHO DE UPLOAD_DIRSERVER È ABSOLUTO e é usado pela aplicação /home/siapp/public_html;
    //    const UPLOAD_DIR_SEVER = __DIR__ . '/../public/siapp/arquivos/';

    // public static function UPLOAD_DIR()
    // {
    //     $uploadDir = '';

    //     switch (getenv('APP_ENV')) {
    //         case 'development':
    //             $uploadDir = '/public/agil/arquivos/';
    //             break;
    //         case 'staging':
    //             $uploadDir = '/dados/upload/agil/';
    //             break;
    //         case 'production':
    //             $uploadDir = '/dados/upload/agil/';
    //             break;
    //     }

    //     return $uploadDir;
    // }

    // public static function UPLOAD_DIR_SERVER()
    // {
    //     $uploadDir = '';

    //     switch (getenv('APP_ENV')) {
    //         case 'development':
    //             $uploadDir = __DIR__ . '/../public/agil/arquivos/';
    //             break;
    //         case 'staging':
    //             $uploadDir = '/dados/upload/agil/';
    //             break;
    //         case 'production':
    //             $uploadDir = '/dados/upload/agil/';
    //             break;
    //     }
    //     return $uploadDir;
    // }
}
