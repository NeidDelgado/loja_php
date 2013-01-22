<?php

    class ConexaoDAO extends PDO {
        
        //public static $link;
        public function __construct() {
            $dbh = parent::__construct('mysql:host=192.168.1.110; dbname=loja2', 'root', 'root');
            //self::$link = $dbh;
            
            return $dbh;
        }
    }
?>
