<?php
    require_once '../init.php';
    
    require_once 'header.php';
    
    
    if ($isLogged){
        header("Location: index.php");
        return;
    }    
    
    // Validar Formulário
    if (isset($_POST['btnEntrar']) && $_POST['btnEntrar'] == "Entrar"){
        
        if (empty($_POST['email']) || empty($_POST['senha'])){
            $errorMsg = "Ocorreu um erro: Todos os campos são obrigatórios";    
        } else {
            $email = trim($_POST['email']);
            $senha = hash("sha512", trim($_POST['senha']));
            
            $utilizador = new Utilizador();
            $utilizador->setEmail($email);
            $utilizador->setPassword($senha);
            
            $login = UtilizadorDAO::login($utilizador);
            if ($login){
                Helper::setSession($login['id'], $login['nivel_acesso'], true);
                
                header("Location: index.php");
            }
            
            $errorMsg = "O E-mail e/ou a Palavra-passe estão incorrectos.";                     
        }
    }
?>

<div class="content">
    <?php
        if (isset($errorMsg)){
            echo "<div class='msg_error'>{$errorMsg}</div>";
        }
    ?>
    <form action="" method="post" name="loginForm" id="loginForm">
        <p>
            <label>E-mail:</label>
            <input type="email" name="email" placeholder="Digite o seu E-mail">
        </p>
        <p>
        <label>Palavra-passe:</label>
        <input type="password" name="senha" placeholder="Digite a sua senha">
        </p>
        
        <p>
            <input type="submit" value="Entrar" name="btnEntrar">
        </p>
    </form>
</div>

<?php
    require_once 'footer.php';
?>