<?php

    class ConexaoDAO extends PDO {
        
    private $dsn = 'mysql:host=localhost; dbname=loja2;charset=utf8';
    private $user = 'root';
    private $password = 'dadiva';
        //public static $link;
        public function __construct() {
            $dbh = parent::__construct($this->dsn, $this->user, $this->password);
            //self::$link = $dbh;
            
            return $dbh;
        }
    }
?>