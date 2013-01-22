<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>..::  Requinte ::..</title>
        <title>..:: Àrea de Administração ::..</title>
        
        <link rel="stylesheet" type="text/css" href="../css/style_admin.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                Cabeçalho
                
                <?php
                    if (isset($_SESSION['nivel_acesso']) == 1){
                        ?>
                        <ul class="menu_principal">
                            <li><a href="index.php">Painel Inicial</a></li>
                            <li><a href="categorias.php">Categorias</a></li>
                            <li><a href="index.php">Produtos</a></li>
                            <li><a href="index.php">Vendas</a></li>
                            <li><a href="index.php">Clientes</a></li>
                            <li><a href="index.php">Utilizadores</a></li>
                            <li><a href="logout.php">Sair</a></li>
                        </ul>                 
                        <?php                        
                    } else if(isset($_SESSION['nivel_acesso']) == 2){
                        ?>
                        <ul class="menu_principal">
                            <li><a href="index.php">Painel Inicial</a></li>
                            <li><a href="index.php">Produtos</a></li>
                            <li><a href="index.php">Vendas</a></li>
                            <li><a href="index.php">Clientes</a></li>
                            <li><a href="logout.php">Sair</a></li>
                        </ul>                 
                        <?php
                    }
                ?>
                              
            </div>         
            
            
            