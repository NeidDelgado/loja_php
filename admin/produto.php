<?php
 require_once '../init.php';
    
    if (!$isLogged){
        header("Location: login.php");
    }
    
    require_once 'header.php';
    
    if (isset($_GET['action'])){
        $action = strtolower(trim($_GET['action']));
        if ($action != 'novo' && $action != 'editar' && $action != 'ver'  && $action != 'eliminar'){
            header("Location: produtos.php");
        }
    } else {
        header("Location: produtos.php");
    }
?>

<div class="content">
    <?php
        if (isset($_POST['gravar'])){
            
            $extPermitidas = array('png', 'jpg', 'jpeg');
            $tiposPermitidos = array('image/jpeg', 'image/png', 'image/pjpeg');
            $nome_imagem = $_FILES['imagem']['name'];
            $arrExt = explode('.', $nome_imagem);
            $ext = end($arrExt);
            $_FILES['tamanho'] = 1024 * 1024 * 10;
            
            $codigo_produto = trim($_POST['codigo_barra']);
            $titu_produto = trim($_POST['titulo']);
            $desc_produto = trim($_POST['descricao']);
            $venda_produto = trim($_POST['preco_venda']);
            $custo_produto = trim($_POST['preco_custo']);
            $exist_produto = trim($_POST['existencias']);
            $data_actual = date('Y-m-d H:i:s');
            
            if (!in_array($_FILES['imagem']['type'], $tiposPermitidos) && !in_array($ext, $extPermitidas)){
                $msgError = "Imagem inválida.<br>Extenções permitidas: png, jpeg, jpg";
            } elseif (empty($codigo_produto) && empty($titu_produto) && empty($desc_produto) && empty($venda_produto) && empty($custo_produto) && empty($exist_produto) ){
                $msgError = "Todos os campos são obrigatórios.";
            } else {
                $new_file_name = date('YmdHis')."_".rand(100, 999).".".$ext; // Novo nome do ficheiro...
               
                if (move_uploaded_file($_FILES['imagem']['tmp_name'], PASTA_IMG_PRODUTOS . $new_file_name)){
                    $produto = new Produto();
                    $produto->setCodigoBarra($codigo_produto);
                    $produto->setTitulo($titu_produto);
                    $produto->setDescricao($desc_produto);
                    $produto->setPrecoVenda($venda_produto);
                    $produto->setPrecoCusto($custo_produto);
                    $produto->setExistencias($exist_produto);
                    $produto->setUrlImagem($new_file_name);
                    $produto->setDataCriacao($data_actual);
                    $produto->setDataActualizacao($data_actual);
                   
                    $resultado = ProdutoDAO::saveProduto($produto);
                    
                   if ($resultado){
                       $msgOk = "produto criado com sucesso.";
                   } else {
                       $msgError = "Ocorreu um erro ao tentar criar o produto.";
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
            <form action="" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend>Novo Produto</legend>
                    <p>
                        <label>Código de Barra</label>
                        <input type="text" name="codigo_barra" placeholder="código do produto">
                    </p>
                    <p>
                        <label>Nome:</label>
                        <input type="text" name="titulo" placeholder="titulo do produto">
                    </p>
                    <p>
                        <label>Descriação:</label>
                        <input type="text" name="descricao" placeholder="Descrição do produto">
                    </p>
                    <p>
                        <label>Preco de Venda:</label>
                        <input type="text" name="preco_venda" placeholder="preço de venda do produto">
                    </p>
                    <p>
                        <label>Preco de Custo:</label>
                        <input type="text" name="preco_custo" placeholder="preço de custo do produto">
                    </p>
                    <p>
                        <label>Existencias:</label>
                        <input type="text" name="existencias" placeholder="número de produto">
                    </p>
                    <p>
                        <label>Imagem:</label>
                        <input type="file" name="imagem">
                    </p>
                    <p>
                        <input type="submit" name="gravar" value="Gravar" style="width: 100px;">
                    </p>
                </fieldset>
            </form>
            <?php
        } else if ($action == "eliminar"){
            $id = trim($_GET['id']);
            $produto = ProdutoDAO::deleteProduto($id);
            
            if ($produto){                
                header("Location: produtos.php?status=dok");
            } else {
                header("Location: produtos.php?status=derro");
            }
        } else if ($action == "editar"){
            $id = trim($_GET['id']);
            $produ = ProdutoDAO::getProduto($id);
            
            if (!$produ){
                header("Location: produtos.php");
            }
             if (isset($_POST['gravar']) && $_POST['gravar'] == "Actualizar"){
                $codigo_p = trim($_POST['codigo_barra']);
                $titulo_p = trim($_POST['titulo']);
                $descricao_p = trim($_POST['descricao']);
                $venda_p = trim($_POST['preco_venda']);
                $custo_p = trim($_POST['preco_custo']);
                $existencia_p = trim($_POST['existencias']);
                $data_actualizacao = date('Y-m-d H:i:s');
                $data_criacao  = date('Y-m-d H:i:s');
                
                $novo_produto = new Produto();
                $novo_produto->getId();
                $novo_produto->setCodigoBarra($codigo_p);
                $novo_produto->setTitulo($titulo_p);
                $novo_produto->setDescricao($descricao_p);
                $novo_produto->setPrecoVenda($venda_p);
                $novo_produto->setPrecoCusto($custo_p);
                $novo_produto->setExistencias($existencia_p);
                $novo_produto->setUrlImagem($new_file_name);
                $novo_produto->setDataCriacao($data_criacao);
                $novo_produto->setDataActualizacao($data_actualizacao);
                
                if ($_FILES['imagem']['error'] == 0){
                    $extPermitidas = array('png', 'jpg', 'jpeg');
                    $tiposPermitidos = array('image/jpeg', 'image/png', 'image/pjpeg');
                    $nome_imagem = $_FILES['imagem']['name'];
                    $arrExt = explode('.', $nome_imagem);
                    $ext = end($arrExt);
                   
                    if (!in_array($_FILES['imagem']['type'], $tiposPermitidos) && !in_array($ext, $extPermitidas)){
                        $msgError = "Imagem inválida.<br>Extenções permitidas: png, jpeg, jpg";
                    }
                   elseif (empty($codigo_p) && empty($titulo_p) && empty($descricao_p) && empty($venda_p) && empty($custo_p) && empty($existencia_p)){
                        $msgError = "Todos os campos são obrigatórios.";
                    } else {
                        $new_file_name = date('YmdHis')."_".rand(100, 999).".".$ext; // Novo nome do ficheiro...
                    $data_actual = date('Y-m-d H:i:s');
                    move_uploaded_file($_FILES['imagem']['tmp_name'], PASTA_IMG_PRODUTOS . $new_file_name);
                  
                    if ($produ['url_imagem']  != "sem_imagem.png"){
                        unlink(PASTA_IMG_PRODUTOS . $produ['url_imagem']) ;
                    }
                    } 
                    }else {
                        $novo_produto->setUrlImagem($produ['url_imagem']);
                    }
                    
                $resultado = ProdutoDAO::editarProduto($novo_produto);
                if ($resultado){
                       $msgOk = "Produto actualizado com sucesso.";
                } else {
                        $msgError = "Ocorreu um erro ao tentar actualizar o Produto.";
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
                    <legend>Actualizar Produto</legend>
                    <p>
                        <label>Código de Barra</label>
                        <input type="text" name="codigo_barra" placeholder="código do produto" value="<?php echo $produ['codigo_barra']; ?>">
                    </p>
                    <p>
                        <label>Nome:</label>
                        <input type="text" name="titulo" placeholder="titulo do produto" value="<?php echo $produ['titulo']; ?>">
                    </p>
                    <p>
                        <label>Descriação:</label>
                        <input type="text" name="descricao" placeholder="Descrição do produto" value="<?php echo $produ['descricao']; ?>">
                    </p>
                    <p>
                        <label>Preco de Venda:</label>
                        <input type="text" name="preco_venda" placeholder="preço de venda do produto" value="<?php echo $produ['preco_venda']; ?>">
                    </p>
                    <p>
                        <label>Preco de Custo:</label>
                        <input type="text" name="preco_custo" placeholder="preço de custo do produto" value="<?php echo $produ['preco_custo']; ?>">
                    </p>
                    <p>
                        <label>Existencias:</label>
                        <input type="text" name="existencias" placeholder="número de produto" value="<?php echo $produ['existencias']; ?>">
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
            ?>
            <script>  
                function confirmaR(){
                    if(confirm("Deseja Eliminar o Produto?"))       
                {
                return true;
                }
                return false;

                }
           </script>
           <?php
            $id = trim($_GET['id']);
            
            $produto = ProdutoDAO::getProduto($id);
            echo '<label class= "titulo">CÓDIGO DE BARRA:';
            echo '<br><label class= "texto" > '.$produto['codigo_barra'];
            echo '<br><br><label class= "titulo">NOME:';
            echo '<br><label class= "texto" > '.$produto['titulo'];
            echo '<br><br><label class= "titulo">DESCRIÇÃO:';
            echo '<br><label class= "texto"> '. $produto["descricao"];
            echo '<br><br><label class= "titulo">PREÇO DE VENDA:';
            echo '<br><label class= "texto" > '.$produto['preco_venda'];
            echo '<br><br><label class= "titulo">PREÇO DE CUSTO:';
            echo '<br><label class= "texto" > '.$produto['preco_custo'];
            echo '<br><br><label class= "titulo">Nº DE EXISTÊNCIA:';
            echo '<br><label class= "texto"> '. $produto["existencias"];
            echo '<br><br><label class= "titulo">IMAGEM:';
            echo '<br><label class= "texto"><img src=" ' . PASTA_IMG_PRODUTOS2 . $produto['url_imagem'] . '">';
            echo '<br><br><label class= "titulo">DATA DE CRIAÇÃO:';
            echo '<br><label class= "texto"> '. $produto["data_criacao"];
            echo '<br><br><label class= "titulo">DATA DE ACTUALIZAÇÃO:';
            echo '<br><label class= "texto"> '. $produto["data_actualizacao"];
            echo "<br><br><label class= 'titulo'><a href='produto.php?action=editar&id=" . $produto['id'] . "' title='Editar Produto'><img src='../img/icons/page_edit16.png'></a>";
            echo " <a href='produto.php?action=eliminar&id=" . $produto['id'] . "' title='Eliminar Produto' onclick='return confirmaR()'><img src='../img/icons/page_delete16.png'></a> ";
             
        } else {
             header("Location: produtos.php");
        }
    ?>
</div>
<?php
    require_once 'footer.php';
?>