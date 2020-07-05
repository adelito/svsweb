<?php

namespace module\sistema\implementation;

use core\interfaces\ConnectionInterface;
use PDO;

class DbFrameworkDesenvolvimentoImplementation implements ConnectionInterface {
    
    private static $dbType = "pgsql";
    private static $host = "localhost";
    private static $user = "openpg";
    private static $senha = "openpgpwd";
    private static $db = "svsweb";
    private static $persistent = false;
    private static $port = 5432;
    function __construct() {

        die("Classe \"" . __CLASS__ . "\" não pode ser instanciada!");
    }

    public static function connect() {


      
        try {
            // realiza a conex�o
            $con = new PDO(self::$dbType . ":host=" . self::$host . " port=" . self::$port . " dbname=" . self::$db . " user=" . self::$user . " password=" . self::$senha);

            // EXIBIR MENSAGENS DE ERRO
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            return $con;

            // caso ocorra um erro, retorna o erro;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage(); 
            echo $ex->getTraceAsString();
        }
    }

}
?>

