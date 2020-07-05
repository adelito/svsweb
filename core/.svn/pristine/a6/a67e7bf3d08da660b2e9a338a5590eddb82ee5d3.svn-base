<?php

namespace core\implementation;

use core\interfaces\ConnectionInterface;

class DbRaseaHomologacaoImplementation implements ConnectionInterface {

    private static $dbType = "oci";
    private static $host = "10.100.0.168";
    private static $user = "USER_SEG";
    private static $password = "its_time_0100";
    private static $sid = "PEI";
    private static $port = "1525";
    private static $instance = null;
    private static $charset = 'AL32UTF8';
    

//    private static $persistent = false;

    final private function __construct() {
        
    }

    final private function __clone() {
        
    }

    final private function __wakeup() {
        
    }

    public static function connect() {

        try {
            $MYDB = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=" . self::$host . ")(PORT=" . self::$port . "))(CONNECT_DATA=(SID=" . self::$sid . ")))";
            $conn = oci_connect(self::$user, self::$password, $MYDB,self::$charset);

            $stmt = oci_parse($conn, "ALTER SESSION SET NLS_LANGUAGE='BRAZILIAN PORTUGUESE'");
            oci_execute($stmt);
            $stmt = oci_parse($conn,"ALTER SESSION SET NLS_TERRITORY = 'BRAZIL'");
            oci_execute($stmt);
            $stmt = oci_parse($conn,"ALTER SESSION SET NLS_NUMERIC_CHARACTERS=',.'");
            oci_execute($stmt);
            $stmt = oci_parse($conn,"ALTER SESSION SET NLS_DATE_FORMAT = 'DD/MM/YYYY'");
            oci_execute($stmt);
            $stmt = oci_parse($conn,"ALTER SESSION SET NLS_TIMESTAMP_FORMAT = 'DD/MM/YYYY HH24:MI:SS'");
            oci_execute($stmt);

            return $conn;
            
            // caso ocorra um erro, retorna o erro;
        } catch (\Exception $ex) {
            echo "Erro: " . $ex->getMessage();
            die;
            echo $ex->getTraceAsString();
        }
    }

}
?>



