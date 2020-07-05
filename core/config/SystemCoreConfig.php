<?php

namespace core\config;

class SystemCoreConfig {
    # EMAIL

    const EMAIL_SERVIDOR = "ENVIO.BA.GOV.BR";
    const EMAIL_PORTA = 25;
    const EMAIL_SMTP_AUTENTICACAO = false;
    const EMAIL_SMTP_DEBUG = 0;
    const SYSTEM_ROOT = ''; 

    # MENSAGENS PADRÃO DO SISTEMA
    const MSG_INSERT_SUCESS = "Registro incluído com sucesso!";
    const MSG_INSERT_ERROR = "Não foi possível realizar o cadastro!";
    const MSG_UPDATE_SUCCESS = "Registro alterado com sucesso!";
    const MSG_UPDATE_ERROR = "Não foi possível realizar a alteração do item solicitado!";
    const MSG_DELETE_SUCCESS = "Registro excluído com sucesso!";
    const MSG_DELETE_ERROR = "Não foi possível realizar a exclusão do item solicitado!";

    # URL CORE
    const URL_CORE_STYLEGUIDE = self::SYSTEM_ROOT . "/core/styleguide";
    const URL_CORE_JS = self::URL_CORE_STYLEGUIDE . "/js";
    const URL_CORE_CSS = self::URL_CORE_STYLEGUIDE . "/css";
    const URL_CORE_PLUGIN = self::URL_CORE_STYLEGUIDE . "/plugins";

    # URL PUBLIC
    const URL_PUBLIC = self::SYSTEM_ROOT . "/public";

    # LOGO
    const LOGO_GOV_IMG = self::URL_CORE_STYLEGUIDE . "/images/logo/brasao_do_estado_da_bahia.png";
    const LOGO_REP_BR_IMG = self::URL_CORE_STYLEGUIDE . "/images/logo/republica_federativa_do_brasil_pb.png";
    const LOGO_APP_IMG = "";
    
    # ICONE
    const ICONE = self::URL_CORE_STYLEGUIDE . "/favicon/favicon.ico";

    # UTILIZACAO DA TABELA NOVA DE CONFIGURAÇÃO
    const FRAMEWORK_USE_CONFIG = FALSE;

    # UTILIZACAO DO GOOGLE ANALYTICS
    const GOOGLE_ANALYTICS_ID = FALSE;

    # LEFT SIDEBAR
    const LS_CLOSED = FALSE;

    # COLOR THEME
    const FRAMEWORK_COLOR_THEME = 'theme-defaultframework';

}
