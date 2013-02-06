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
        } else if ($action == "eliminar"){
            $id = trim($_GET['id']);
            $categoria = CategoriaDAO::deleteCategoria($id);
            
            if ($categoria){                
                header("Location: categorias.php?status=dok");
            } else {
                header("Location: categorias.php?status=derro");
            }
        } else if ($action == "editar"){
            $id = trim($_GET['id']);
            $cat = CategoriaDAO::getCategoria($id);
            
            if (!$cat){
                header("Location: categorias.php");
            }
             if (isset($_POST['gravar']) && $_POST['gravar'] == "Actualizar"){
                $n_nome = trim($_POST['nome']);
                $n_descricao = trim($_POST['descricao']);
                $data_alteracao = date('Y-m-d H:i:s');
                $data_criacao  = date('Y-m-d H:i:s');
                
                $nova_categoria = new Categoria();
                $nova_categoria->setId($id);
                $nova_categoria->setNome($n_nome);
                $nova_categoria->setDescricao($n_descricao);
                $nova_categoria->setDataCriacao($data_criacao);
                $nova_categoria->setDataAlteracao($data_alteracao);
                
                 if ($_FILES['imagem']['error'] == 0){
                    $extPermitidas = array('png', 'jpg', 'jpeg');
                    $tiposPermitidos = array('image/jpeg', 'image/png', 'image/pjpeg');
                    $nome_imagem = $_FILES['imagem']['name'];
                    $arrExt = explode('.', $nome_imagem);
                    $ext = end($arrExt);
                    
                    if (!in_array($_FILES['imagem']['type'], $tiposPermitidos) && !in_array($ext, $extPermitidas)){
                        $msgError = "Imagem inválida.<br>Extenções permitidas: png, jpeg, jpg";
                    }
                    elseif (empty($n_nome) && empty($n_descricao)){
                        $msgError = "Todos os campos são obrigatórios.";
                    } else {
                        $new_file_name = date('YmdHis')."_".rand(100, 999).".".$ext; // Novo nome do ficheiro...
                    $data_actual = date('Y-m-d H:i:s');
                    move_uploaded_file($_FILES['imagem']['tmp_name'], PASTA_IMG_CATEGORIA . $new_file_name);
                    $nova_categoria->setUrlImagem($new_file_name);
                    
                    if ($cat['url_imagem']  != "sem_imagem.png"){
                        unlink(PASTA_IMG_CATEGORIA . $cat['url_imagem']) ;
                    }
                    } 
                    }else {
                        $nova_categoria->setUrlImagem($cat['url_imagem']);
                    }
                    
                $resultado = CategoriaDAO::editarCategoria($nova_categoria);
                if ($resultado){
                       $msgOk = "Categoria actualizada com sucesso.";
                } else {
                        $msgError = "Ocorreu um erro ao tentar actualizar a categoria.";
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
                    <legend>Actualizar Categoria</legend>
                    <p>
                        <label>Nome:</label>
                        <input type="text" name="nome" placeholder="Nome da Categoria" value="<?php echo $cat['nome']; ?>">
                    </p>
                    <p>
                        <label>Descriação:</label>
                        <input type="text" name="descricao" placeholder="Descrição da Categoria" value="<?php echo $cat['descricao']; ?>">
                    </p>
                        <label>Imagem:</label>
                        <input type="file" name="imagem" >
                    </p>
                    <p>
                        <input type="submit" name="gravar" value="Actualizar" style="width: 100px;">
                    </p>
                </fieldset>
            </form>
            
            <?php
        } else if ($action == "ver"){
            ?>
            <script>  
                function confirmaR(){
                    if(confirm("Deseja Eliminar a Categoria?"))       
                {
                return true;
                }
                return false;

                }
           </script>
           <?php
            $id = trim($_GET['id']);
            
            $categoria = CategoriaDAO::getCategoria($id);
            echo '<label class= "titulo">TITULO:';
            echo '<br><label class= "texto" > '.$categoria['nome'];
            echo '<br><br><label class= "titulo">DESCRIÇÃO:';
            echo '<br><label class= "texto"> '. $categoria["descricao"];
            echo '<br><br><label class= "titulo">IMAGEM:';
            echo '<br><label class= "texto"><img src=" ' . PASTA_IMG_CATEGORIA2 . $categoria['url_imagem'] . '">';
            echo '<br><br><label class= "titulo">DATA DE CRIAÇÃO:';
            echo '<br><label class= "texto"> '. $categoria["data_criacao"];
            echo '<br><br><label class= "titulo">DATA DE ALTERAÇÃO:';
            echo '<br><label class= "texto"> '. $categoria["data_alteracao"];
            echo "<br><br><label class= 'titulo'><a href='categoria.php?action=editar&id=" . $categoria['id'] . "' title='Editar Categoria'><img src='../img/icons/page_edit16.png'></a>";
            echo " <a href='categoria.php?action=eliminar&id=" . $categoria['id'] . "' title='Eliminar Categoria' onclick='return confirmaR()'><img src='../img/icons/page_delete16.png'></a> ";
               
        } else {
             header("Location: categorias.php");
        }
    ?>
</div>

<?php
    require_once 'footer.php';
?>