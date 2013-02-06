<?php
    require_once '../init.php';
    
    if (!$isLogged){
        header("Location: login.php");
    }
    require_once 'header.php';
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
<div class="content">
    <h1>Produtos</h1>
  
    
    <?php
        if (isset($_GET['status']) && $_GET['status'] == "dok"){
            echo "<div class='msg_ok'>Produto eliminado.</div>";
        }
        
         if (isset($_GET['status']) && $_GET['status'] == "derro"){
            echo "<div class='msg_error'>Não foi possivél eliminar o Produto.</div>";
        }
    ?>
    
    <a href="produto.php?action=novo">Novo Produto</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código de Barra</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preco de Venda</th>
                <th>Preco de Custo</th>
                <th>Nº de existências</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $produtos = ProdutoDAO::getProdutos();
                foreach ($produtos as $produto) {
                    echo "<tr>
                        <td>{$produto['id']}</td>
                        <td>{$produto['codigo_barra']}</td>
                        <td>{$produto['titulo']}</td>
                        <td>{$produto['descricao']}</td>
                        <td>{$produto['preco_venda']}</td>
                        <td>{$produto['preco_custo']}</td>
                        <td>{$produto['existencias']}</td>
                     
                        <td>
                            <a href='produto.php?action=ver&id=" . $produto['id'] . "' title='Ver Produto'><img src='../img/icons/lupa16.png'></a>
                            <a href='produto.php?action=editar&id=" . $produto['id'] . "' title='Editar Produto'><img src='../img/icons/page_edit16.png'></a>
                            <a href='produto.php?action=eliminar&id=" . $produto['id'] . "' title='Eliminar Produto' onclick='return confirmaR()'><img src='../img/icons/page_delete16.png'></a>                           
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