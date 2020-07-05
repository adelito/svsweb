<?php

namespace core\helper;

use config\SystemConfig;

/**
 * Classe utilitária para Sessão
 * @package core
 * @subpackage helper
 * @author Judá Passos <juda.santos@educacao.ba.gov.br>
 */
class LogHelper {

    /**
     * registra Log de Erro do siste
     * @static
     * @access public
     * @param string $classe Nome da classe onde ocorreu o erro
     * @param string $metodo Nome do método onde ocorreu o erro
     * @param string $msgerro Mensagem de erro
     * @return void
     */
    public static function registrar($classe, $metodo, $msgerro) {

        // ambiente
        $ip = $_SERVER['REMOTE_ADDR'];
        $navegador = $_SERVER['HTTP_USER_AGENT'];
        $url = $_SERVER['REQUEST_URI'];
        $codificacao = $_SERVER['HTTP_ACCEPT_CHARSET'];
        $data = date("d-m-y");
        $hora = date("H:i:s");

        // capturados por sessao

        $usuario = $_SESSION['viusulogin'];
        $usuarioID = $_SESSION['vipes'];

        //Nome do arquivo:
        $arquivo = SystemConfig::SYSTEM_ROOT . "/log_" . $data . ".txt";

        //Texto a ser impresso no log:
        $texto = "[$hora]|[$ip]|[$usuario($usuarioID)]|[$navegador]|[$codificacao]|[$url]> $msgerro \n";

        $ponteiro = fopen("$arquivo", "a+b");
        fwrite($ponteiro, $texto);
        fclose($ponteiro);
    }

}

?>
