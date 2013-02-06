<?php
require_once '../init.php';
    
    if (!$isLogged){
        header("Location: login.php");
    }
    
    require_once 'header.php';
    
    if (isset($_GET['action'])){
        $action = strtolower(trim($_GET['action']));
        if ($action != 'novo' && $action != 'editar' && $action != 'ver'  && $action != 'eliminar'){
            header("Location: utilizadores.php");
        }
    } else {
        header("Location: utilizadores.php");
    }
?>

<div class="content">
    <?php
        if (isset($_POST['gravar_novo'])){
            $string = Helper::randString(10);
            
            $extPermitidas = array('png', 'jpg', 'jpeg');
            $tiposPermitidos = array('image/jpeg', 'image/png', 'image/pjpeg');
            $nome_imagem = $_FILES['imagem']['name'];
            $arrExt = explode('.', $nome_imagem);
            $ext = end($arrExt);
            
            $primeiro_nomep = trim($_POST['primeiro_nome']);
            $ultimo_nomep = trim($_POST['ultimo_nome']);
            $email_p = trim($_POST['email']);
            $password_p = hash('sha512', trim($_POST['password']));
            $nivel_acessop = trim($_POST['nivel_acesso']);
            $token = hash('md5', $string);
            $data_criacaop = date('Y-m-d H:i:s');
            $data_alteracaop = date('Y-m-d H:i:s');

                if (!in_array($_FILES['imagem']['type'], $tiposPermitidos) && !in_array($ext, $extPermitidas)){
                $msgError = "Imagem inválida.<br>Extenções permitidas: png, jpeg, jpg";
            } elseif ( empty($primeiro_nomep) && empty($ultimo_nomep) && empty($email_p) && empty($password_p)){
                $msgError = "Todos os campos são obrigatórios.";
            } else {
                $new_file_name = date('YmdHis')."_".rand(100, 999).".".$ext; // Novo nome do ficheiro...
                $data_actual = date('Y-m-d H:i:s');
                if (move_uploaded_file($_FILES['imagem']['tmp_name'], PASTA_IMG_UTILIZADORES . $new_file_name)){
                  
                   $utilizador = new Utilizador();
                   $utilizador->setPrimeiroNome($primeiro_nomep);
                   $utilizador->setUltimoNome($ultimo_nomep);
                   $utilizador->setEmail($email_p);
                   $utilizador->setPassword($password_p);
                   $utilizador->setNivelAcesso($nivel_acessop);
                   $utilizador->setToken($token);
                   $utilizador->setEstado(1);
                   $utilizador->setDataCriacao($data_criacaop);
                   $utilizador->setDataAlteracao($data_alteracaop);

                   $resultado = UtilizadorDAO::saveUtilizador($utilizador);
                   if ($resultado){
                       $msgOk = "utilizador criado com sucesso.";
                   } else {
                        $msgError = "Ocorreu um erro ao tentar criar o utilizador.";
                   }
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
                    <legend>Novo Utilizador</legend>
                    <p>
                        <label>Primeiro Nome:</label>
                        <input type="text" name="primeiro_nome" placeholder="primeiro nome do utilizador">
                    </p>
                    <p>
                        <label>Ultimo Nome:</label>
                        <input type="text" name="ultimo_nome" placeholder="sub-nome do utilizador">
                    </p>
                    <p>
                        <label>Email:</label>
                        <input type="email" name="email" placeholder="email do utilizador">
                    </p>
                    <p>
                        <label>Password:</label>
                        <input type="password" name="password">
                    </p>
                    <p>
                        <label>Nivel de Acesso:</label>
                        <select name="nivel_acesso">
                            <option value="1">Administrador</option>
                            <option value="2" selected="selected">Utilizador</option>
                        </select>
                    </p>
                    <p>
                        <label>Imagem:</label>
                        <input type="file" name="imagem">
                    </p>
                    <p>
                        <input type="submit" name="gravar_novo" value="Gravar" style="width: 100px;">
                    </p>
                </fieldset>
            </form>
            <?php
        } else if ($action == "eliminar"){
            $id = trim($_GET['id']);
            $utilizador = UtilizadorDAO::deleteUtilizador($id);
            
            if ($utilizador){                
                header("Location: utilizadores.php?status=dok");
            } else {
                header("Location: utilizadores.php?status=derro");
            }
        } else if ($action == "editar"){
            $id = trim($_GET['id']);
            $utiliza = UtilizadorDAO::getUtilizador($id);
            
            if (!$utiliza){
                header("Location: utilizadores.php");
            }
             if (isset($_POST['gravar']) && $_POST['gravar'] == "Actualizar"){
                $string = Helper::randString(10);  
                
                $primeiro_nom = trim($_POST['primeiro_nome']);
                $ultimo_nom = trim($_POST['ultimo_nome']);
                $email_n = trim($_POST['email']);
                $nivel_acesso = trim($_POST['nivel_acesso']);
                $estado = trim($_POST['estado']);
                $token = hash('md5', $string);
                $data_criacao = date('Y-m-d H:i:s');
                $data_alteracao = date('Y-m-d H:i:s');
                
                $novo_utilizador = new Utilizador();
                $novo_utilizador->getId();
                $novo_utilizador->setPrimeiroNome($primeiro_nom);
                $novo_utilizador->setUltimoNome($ultimo_nom);
                $novo_utilizador->setEmail($email_n);
                $novo_utilizador->setNivelAcesso($nivel_acesso);
                $novo_utilizador->setToken($token);
                $novo_utilizador->setEstado($estado);
                $novo_utilizador-> setDataCriacao($data_criacao);
                $novo_utilizador->setDataAlteracao($data_alteracao);
                
                if ($_FILES['imagem']['error'] == 0){
                    $extPermitidas = array('png', 'jpg', 'jpeg');
                    $tiposPermitidos = array('image/jpeg', 'image/png', 'image/pjpeg');
                    $nome_imagem = $_FILES['imagem']['name'];
                    $arrExt = explode('.', $nome_imagem);
                    $ext = end($arrExt);
                    
                    if (!in_array($_FILES['imagem']['type'], $tiposPermitidos) && !in_array($ext, $extPermitidas)){
                        $msgError = "Imagem inválida.<br>Extenções permitidas: png, jpeg, jpg";
                    }
                   elseif ( empty($primeiro_nom) && empty($ultimo_nom) && empty($email_n) ){
                        $msgError = "Todos os campos são obrigatórios.";
                    } else {
                        $new_file_name = date('YmdHis')."_".rand(100, 999).".".$ext; // Novo nome do ficheiro...
                    $data_actual = date('Y-m-d H:i:s');
                    move_uploaded_file($_FILES['imagem']['tmp_name'], PASTA_IMG_UTILIZADORES. $new_file_name);
                    $novo_utilizador->setUrlImagem($new_file_name);
                      var_dump($utiliza);
                    if ($utiliza['url_imagem']  != "sem_imagem.png"){
                        unlink(PASTA_IMG_UTILIZADORES . $utiliza['url_imagem']) ;
                        var_dump(PASTA_IMG_UTILIZADORES . $utiliza['url_imagem']);
                      
                    }
                    } 
                    }else {
                        $novo_utilizador->setUrlImagem($utiliza['url_imagem']);
                    } 
                        
                $resultado = UtilizadorDAO::editarUtilizador($novo_utilizador);
                if ($resultado){
                       $msgOk = "utilizador actualizado com sucesso.";
                } else {
                        $msgError = "Ocorreu um erro ao tentar actualizar o utilizador.";
                }
            }
              if (isset($msgError)){
                echo "<div class='msg_error'>{$msgError}</div>";
            }
            
            if (isset($msgOk)){
                echo "<div class='msg_ok'>{$msgOk}</div>";
            }
            
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Actualizar Utilizador</legend>
                    <p>
                        <label>Primeiro Nome:</label>
                        <input type="text" name="primeiro_nome" placeholder="primeiro nome do utilizador" value="<?php echo $utiliza['primeiro_nome']; ?>">
                    </p>
                    <p>
                        <label>Ultimo Nome:</label>
                        <input type="text" name="ultimo_nome" placeholder="sub-nome do utilizador" value="<?php echo $utiliza['ultimo_nome']; ?>">
                    </p>
                    <p>
                        <label>Email:</label>
                        <input type="email" name="email" placeholder="email do utilizador" value="<?php echo $utiliza['email']; ?>">
                    </p>
                    <p>
                        <label>Nivel de Acesso:</label>
                        <select name="nivel_acesso">
                            <option value="1">Administrador</option>
                            <option value="2" selected="selected">Utilizador</option>
                        </select>
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
                        <label>Imagem:</label>
                        <input type="file" name="imagem">
                    </p>
                    <p>
                        <input type="submit" name="gravar" value="Actualizar" style="width: 100px;">
                    </p>
                </fieldset>
            </form>
            <?php
        } else if ($action == "ver"){
            $id = trim($_GET['id']);
            
            $utilizador = UtilizadorDAO::getUtilizador($id);
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
      
            echo '<label class= "titulo">Primeiro Nome:';
            echo '<br><label class= "texto" > '.$utilizador['primeiro_nome'];
            echo '<br><br><label class= "titulo">ULTIMO NOME:';
            echo '<br><label class= "texto" > '.$utilizador['ultimo_nome'];
            echo '<br><br><label class= "titulo">EMAIL:';
            echo '<br><label class= "texto"> '. $utilizador["email"];
            echo '<br><br><label class= "titulo">IMAGEM:';
            echo '<br><label class= "texto"><img src=" ' . PASTA_IMG_UTILIZADORES2 . $utilizador['url_imagem'] . '">';
            echo '<br><br><label class= "titulo">ESTADO:';
            echo '<br><label class= "texto"> '. $estado;
            echo '<br><br><label class= "titulo">NIVEL DE ACESSO:';
            echo '<br><label class= "texto"> '. $nivel_acesso;
            echo '<br><br><label class= "titulo">DATA DE CRIAÇÃO:';
            echo '<br><label class= "texto"> '. $utilizador["data_criacao"];
            echo '<br><br><label class= "titulo">DATA DE ACTUALIZAÇÃO:';
            echo '<br><label class= "texto"> '. $utilizador["data_alteracao"];
            echo "<br><br><label class= 'titulo'><a href='utilizador.php?action=editar&id=" . $utilizador['id'] . "' title='Editar Utilizador'><img src='../img/icons/page_edit16.png'></a>";
            echo " <a href='utilizador.php?action=eliminar&id=" . $utilizador['id'] . "' title='Eliminar utilizador'><img src='../img/icons/page_delete16.png'></a> ";
             
        } else {
             header("Location: utilizadores.php");
        }
    ?>
</div>
<?php
    require_once 'footer.php';
?>