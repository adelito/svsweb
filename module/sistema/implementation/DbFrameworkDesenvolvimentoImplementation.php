<?php

namespace module\sistema\implementation;

use core\interfaces\ConnectionInterface;
use PDO;

class DbFrameworkDesenvolvimentoImplementation implements ConnectionInterface {
    
    // private static $dbType = "mysql";
    // private static $host = "localhost";
    // private static $user = "root";
    // private static $senha = "root";
    // private static $db = "teste";
    // private static $persistent = false;
    // private static $port = 3306;
    private static $username = 'root';
    private static $senha = 'root';
    function __construct() {

        die("Classe \"" . __CLASS__ . "\" não pode ser instanciada!");
    }

    public static function connect() {


      
        try {
            // realiza a conexão
            // $pdo = new PDO('mysql:host=localhost:3306;dbname=teste', $username, $senha);
            $con = new PDO('mysql:host=localhost:3306;dbname=teste', self::$username,  self::$senha);

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

