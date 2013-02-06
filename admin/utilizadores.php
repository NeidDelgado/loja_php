<?php

   require_once '../init.php';
    
    if (!$isLogged){
        header("Location: login.php");
    }
    require_once 'header.php';
?>

<div class="content">
    <h1>Produtos</h1>
    
    <?php
        if (isset($_GET['status']) && $_GET['status'] == "dok"){
            echo "<div class='msg_ok'>utilizador eliminado.</div>";
        }
        
         if (isset($_GET['status']) && $_GET['status'] == "derro"){
            echo "<div class='msg_error'>Não foi possivél eliminar o utilizador.</div>";
        }
    ?>
    
    <a href="utilizador.php?action=novo">Novo utilizador</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Primeiro Nome</th>
                <th>Ultimo Nome</th>
                <th>E-mail</th>
                <th>Estado</th>
                <th>Nivel de Acesso</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $utilizadores = UtilizadorDAO::getUtilizadores();
                foreach ($utilizadores as $utilizador) {
                    $estado = "";
                        if ($utilizador['estado'] == 1){
                            $estado = "Novo";
                        } 
                        elseif ($utilizador['estado']==2) {
                            $estado="Activo";
                        }
                        elseif ($utilizador['estado']==3) {
                          $estado="Desactivada"; 
                        }
                        $nivel_acesso = "";
                        if ($utilizador['nivel_acesso'] == 1){
                            $nivel_acesso = "Administrador";
                        } 
                        elseif ($utilizador['nivel_acesso']==2) {
                            $nivel_acesso="Utilizador";
                        }
                    echo "<tr>
                        <td>{$utilizador['id']}</td>
                        <td>{$utilizador['primeiro_nome']}</td>
                        <td>{$utilizador['ultimo_nome']}</td>
                        <td>{$utilizador['email']}</td>
                        <td>{$estado}</td>
                        <td>{$nivel_acesso}</td>
                     
                        <td>
                            <a href='utilizador.php?action=ver&id=" . $utilizador['id'] . "' title='Ver Utilizador'><img src='../img/icons/lupa16.png'></a>
                            <a href='utilizador.php?action=editar&id=" . $utilizador['id'] . "' title='Editar Utilizador'><img src='../img/icons/page_edit16.png'></a>
                            <a href='utilizador.php?action=eliminar&id=" . $utilizador['id'] . "' title='Eliminar Utilizador'><img src='../img/icons/page_delete16.png'></a>                           
                        </td>
                    </tr>";
                }
            ?>
        </tbody>
    </table>
</div>
<?php
    require_once 'footer.php';
?>