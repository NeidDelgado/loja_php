<?php
require_once '../init.php';
    
    if (!$isLogged){
        header("Location: login.php");
    }
    
    require_once 'header.php';
    
    if (isset($_GET['action'])){
        $action = strtolower(trim($_GET['action']));
        if ($action != 'novo' && $action != 'editar' && $action != 'ver'  && $action != 'eliminar'){
            header("Location: clientes.php");
        }
    } else {
        header("Location: clientes.php");
    }
?>

<div class="content">
    <?php
        if (isset($_POST['gravar_novo'])){
             if ( empty($_POST['primeiro_nome']) && empty($_POST['ultimo_nome']) && empty($_POST['email']) && empty($_POST['password'])){
                $msgError = "Todos os campos são obrigatórios.";
            } else {
                $minha_string = Helper::randString(10);
                
                $primeiro_nome = trim($_POST['primeiro_nome']);
                $ultimo_nome = trim($_POST['ultimo_nome']);
                $email = trim($_POST['email']);
                $password = hash('sha512', trim($_POST['password']));
                $token = hash('md5', $minha_string);
                $data_criacao = date('Y-m-d H:i:s');
                $data_alteracao = date('Y-m-d H:i:s');

                $cliente = new Cliente();
                $cliente->setPrimeiroNome($primeiro_nome);
                $cliente->setUltimoNome($ultimo_nome);
                $cliente->setEmail($email);
                $cliente->setPassword($password);
                $cliente->setToken($token);
                $cliente->setEstado(1);
                $cliente->setDataCriacao($data_criacao);
                $cliente->setDataAlteracao($data_alteracao);

                $resultado = ClienteDAO::saveCliente($cliente);
                if ($resultado){
                    $msgOk = "cliente criado com sucesso.";
                } else {
                     $msgError = "Ocorreu um erro ao tentar criar o cliente.";
                }
             }
        }
        
        if ($action == 'novo'){
            if (isset($msgError)){
                echo "<div class='msg_error'>{$msgError}</div>";
            }
            
            if (isset($msgOk)){
                echo "<div class='msg_ok'>{$msgOk}</div>";
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Novo Cliente</legend>
                    <p>
                        <label>Primeiro Nome:</label>
                        <input type="text" name="primeiro_nome" placeholder="primeiro nome do Cliente">
                    </p>
                    <p>
                        <label>Ultimo Nome:</label>
                        <input type="text" name="ultimo_nome" placeholder="sub-nome do Cliente">
                    </p>
                    <p>
                        <label>Email:</label>
                        <input type="email" name="email" placeholder="email do Cliente">
                    </p>
                    <p>
                        <label>Password:</label>
                        <input type="password" name="password">
                    </p>
                    <p>
                        <input type="submit" name="gravar_novo" value="Gravar" style="width: 100px;">
                    </p>
                </fieldset>
            </form>
            <?php
        } else if ($action == "eliminar"){
            $id = trim($_GET['id']);
            $cliente = ClienteDAO::deleteCliente($id);
            
            if ($cliente){                
                header("Location: clientes.php?status=dok");
            } else {
                header("Location: clientes.php?status=derro");
            }
        } else if ($action == "editar"){
            $id = trim($_GET['id']);
            $cli = ClienteDAO::getCliente($id);
            
            if (!$cli){
                header("Location: clientes.php");
            }
             if (isset($_POST['editar'])){
                if ( empty($_POST['primeiro_nome']) && empty($_POST['ultimo_nome']) && empty($_POST['email']) && empty($_POST['password'])){
                    $msgError = "Todos os campos são obrigatórios.";
                } else {
                    $minha_string = Helper::randString(10);

                    $primeiro_nom = trim($_POST['primeiro_nome']);
                    $ultimo_nom = trim($_POST['ultimo_nome']);
                    $email_n = trim($_POST['email']);
                    $password_n = hash('sha512', trim($_POST['password']));
                    $token = hash('md5', $minha_string);
                    $estado = trim($_POST['estado']);
                    $data_criacao = date('Y-m-d H:i:s');
                    $data_alteracao = date('Y-m-d H:i:s');

                    $novo_cliente = new Cliente();
                    $novo_cliente->setId($id);
                    $novo_cliente->setPrimeiroNome($primeiro_nom);
                    $novo_cliente->setUltimoNome($ultimo_nom);
                    $novo_cliente->setEmail($email_n);
                    $novo_cliente->setPassword($password_n);
                    $novo_cliente->setToken($token);
                    $novo_cliente->setEstado($estado);
                    $novo_cliente->setDataCriacao($data_criacao);
                    $novo_cliente->setDataAlteracao($data_alteracao);

                    $resultado = ClienteDAO::editarCliente($novo_cliente);
                
                    if ($resultado){
                           $msgOk = "Cliente actualizado com sucesso.";
                    } else {
                            $msgError = "Ocorreu um erro ao tentar actualizar o Cliente.";
                    } 
                }
             }  if (isset($msgError)){
                echo "<div class='msg_error'>{$msgError}</div>";
            }
            if (isset($msgOk)){
                echo "<div class='msg_ok'>{$msgOk}</div>";
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Actualizar Cliente</legend>
                    <p>
                        <label>Primeiro Nome:</label>
                        <input type="text" name="primeiro_nome" placeholder="primeiro nome do Cliente" value="<?php echo $cli['primeiro_nome']; ?>">
                    </p>
                    <p>
                        <label>Ultimo Nome:</label>
                        <input type="text" name="ultimo_nome" placeholder="sub-nome do Cliente" value="<?php echo $cli['ultimo_nome']; ?>">
                    </p>
                    <p>
                        <label>Email:</label>
                        <input type="email" name="email" placeholder="email do Cliente" value="<?php echo $cli['email']; ?>">
                    </p>
                    <p>
                        <label>Nova Password:</label>
                        <input type="password" name="password">
                    </p>
                    <p>
                        <label >Estado:</label>
                        <select name="estado" >
                        <option value="1">Novo</option>
                        <option value="2">Activo</option>
                        <option value="3">Desactivado</option> 
                        </select>
                    </p>
                    <p>
                        <input type="submit" name="editar" value="Gravar" style="width: 100px;">
                    </p>
                </fieldset>
            </form>
              
               <?php
        } else if ($action == "ver"){
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
           <?php
            $id = trim($_GET['id']);
            
            $cliente = ClienteDAO::getCliente($id);
        
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
            echo '<label class= "titulo">Primeiro Nome:';
            echo '<br><label class= "texto" > '.$cliente['primeiro_nome'];
            echo '<br><br><label class= "titulo">ULTIMO NOME:';
            echo '<br><label class= "texto" > '.$cliente['ultimo_nome'];
            echo '<br><br><label class= "titulo">EMAIL:';
            echo '<br><label class= "texto"> '. $cliente["email"];
            echo '<br><br><label class= "titulo">ESTADO:';
            echo '<br><label class= "texto"> '. $estado;
            echo '<br><br><label class= "titulo">DATA DE CRIAÇÃO:';
            echo '<br><label class= "texto"> '. $cliente["data_criacao"];
            echo '<br><br><label class= "titulo">DATA DE ACTUALIZAÇÃO:';
            echo '<br><label class= "texto"> '. $cliente["data_alteracao"];
            echo "<br><br><label class= 'titulo'><a href='cliente.php?action=editar&id=" . $cliente['id'] . "' title='Editar cliente'><img src='../img/icons/page_edit16.png'></a>";
            echo " <a href='liente.php?action=eliminar&id=" . $cliente['id'] . "' title='Eliminar cliente'  onclick='return confirmaR()'><img src='../img/icons/page_delete16.png'></a> ";
             
        } else {
             header("Location: clientes.php");
        }
    ?>
</div>
<?php
    require_once 'footer.php';
?>