<?php
    require_once '../init.php';
    
    if (!$isLogged){
        header("Location: login.php");
    }
    
    require_once 'header.php';
   
    
    if (isset($_GET['action'])){
        $action = strtolower(trim($_GET['action']));
        if ($action != 'novo' && $action != 'editar' && $action != 'ver'  && $action != 'eliminar'){
            header("Location: categorias.php");
        }
    } else {
        header("Location: categorias.php");
    }
?>

<div class="content">
    <?php
        if (isset($_POST['gravar_novo'])){
            
            $extPermitidas = array('png', 'jpg', 'jpeg');
            $tiposPermitidos = array('image/jpeg', 'image/png', 'image/pjpeg');
            $nome_imagem = $_FILES['imagem']['name'];
            $arrExt = explode('.', $nome_imagem);
            $ext = end($arrExt);
            
            $nome_categoria = trim($_POST['nome']);
            $desc_categoria = trim($_POST['descricao']);
            
            if (!in_array($_FILES['imagem']['type'], $tiposPermitidos) && !in_array($ext, $extPermitidas)){
                $msgError = "Imagem inválida.<br>Extenções permitidas: png, jpeg, jpg";
            } elseif (empty($nome_categoria) && empty($desc_categoria)){
                $msgError = "Todos os campos são obrigatórios.";
            } else {
                $new_file_name = date('YmdHis')."_".rand(100, 999).".".$ext; // Novo nome do ficheiro...
                $data_actual = date('Y-m-d H:i:s');
                if (move_uploaded_file($_FILES['imagem']['tmp_name'], PASTA_IMG_CATEGORIA . $new_file_name)){
                   $categoria = new Categoria();
                   $categoria->setNome($nome_categoria);
                   $categoria->setDescricao($desc_categoria);
                   $categoria->setUrlImagem($new_file_name);
                   $categoria->setDataCriacao($data_actual);
                   $categoria->setDataAlteracao($data_actual);
                   
                   $resultado = CategoriaDAO::saveCategoria($categoria);
                   if ($resultado){
                       $msgOk = "Categoria criada com sucesso.";
                   } else {
                        $msgError = "Ocorreu um erro ao tentar criar a categoria.";
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
                    <legend>Nova Categoria</legend>
                    <p>
                        <label>Nome:</label>
                        <input type="text" name="nome" placeholder="Nome da Categoria">
                    </p>
                    <p>
                        <label>Descriação:</label>
                        <input type="text" name="descricao" placeholder="Descrição da Categoria">
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
        }
    ?>
    
    <?php
     if ($action == 'eliminar'){
         
        $msg = "A categoria não pode ser eliminada!";
        if (isset($_GET['categoria']) == 'false'){
        echo '<label style="margin-left: 50px; font-size: 12px; color: red; font-weight: bold;">'
        .$msg.'</label>';
        }
     }
    ?>  
</div>

<?php
    require_once 'footer.php';
?>