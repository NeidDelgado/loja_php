<?php

   require_once '../init.php';
    
    if (!$isLogged){
        header("Location: login.php");
    }
    require_once 'header.php';
?>
   <script>  
        function confirmaR(){
            if(confirm("Deseja Eliminar o Cliente?"))       
        {
        return true;
        }
        return false;

        }
    </script>
<div class="content">
    <h1>Produtos</h1>
    
    <?php
        if (isset($_GET['status']) && $_GET['status'] == "dok"){
            echo "<div class='msg_ok'>cliente eliminado.</div>";
        }
        
         if (isset($_GET['status']) && $_GET['status'] == "derro"){
            echo "<div class='msg_error'>Não foi possivél eliminar o cliente.</div>";
        }
    ?>
    
    <a href="cliente.php?action=novo">Novo cliente</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Primeiro Nome</th>
                <th>Ultimo Nome</th>
                <th>E-mail</th>
                <th>Estado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $clientes = ClienteDAO::getClientes();
                foreach ($clientes as $cliente) {
                    $estado = "";
                        if ($cliente['estado'] == 1){
                            $estado = "Novo";
                        } 
                        elseif ($cliente['estado']==2) {
                            $estado="Activo";
                        }
                        elseif ($cliente['estado']==3) {
                          $estado="Desactivada"; 
                        }
                        echo "<tr>
                        <td>{$cliente['id']}</td>
                        <td>{$cliente['primeiro_nome']}</td>
                        <td>{$cliente['ultimo_nome']}</td>
                        <td>{$cliente['email']}</td>
                        <td>{$estado}</td>
                     
                        <td>
                            <a href='cliente.php?action=ver&id=" . $cliente['id'] . "' title='Ver Cliente'><img src='../img/icons/lupa16.png'></a>
                            <a href='cliente.php?action=editar&id=" . $cliente['id'] . "' title='Editar Cliente'><img src='../img/icons/page_edit16.png'></a>
                            <a href='cliente.php?action=eliminar&id=" . $cliente['id'] . "' title='Eliminar Cliente'  onclick='return confirmaR()'><img src='../img/icons/page_delete16.png'></a>                           
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