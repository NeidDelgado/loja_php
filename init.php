<?php
    session_start();
    
    require_once 'config.php';
    require_once 'lib/helper.php';
    
    function __autoload($class){
        $tipoClass = substr($class, -3);
        if (strtoupper($tipoClass) == "DAO"){
            require_once "dao/{$class}.php";
        } else {
            require_once "classes/{$class}.class.php";
        }
    }
    
    // Verificar Sessão
    $isLogged = Helper::verificarSessao();
    
