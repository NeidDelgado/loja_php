<?php
    require_once '../init.php';
    
    if (!$isLogged){
        header("Location: login.php");
    }
    
    require_once 'header.php';
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
<div class="content">
    <h1>Categorias</h1>
    
    <?php
        if (isset($_GET['status']) && $_GET['status'] == "dok"){
            echo "<div class='msg_ok'>Categoria eliminada.</div>";
        }
        
         if (isset($_GET['status']) && $_GET['status'] == "derro"){
            echo "<div class='msg_error'>Não foi possivél eliminar a Categoria.</div>";
        }
    ?>
    
    <a href="categoria.php?action=novo">Nova Categoria</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $categorias = CategoriaDAO::getCategorias();
                foreach ($categorias as $categoria) {
                    echo "<tr>
                        <td>{$categoria['id']}</td>
                        <td>{$categoria['nome']}</td>
                        <td>{$categoria['descricao']}</td>
                            
                        <td>
                            <a href='categoria.php?action=ver&id=" . $categoria['id'] . "' title='Ver Categoria'><img src='../img/icons/lupa16.png'></a>
                            <a href='categoria.php?action=editar&id=" . $categoria['id'] . "' title='Editar Categoria'><img src='../img/icons/page_edit16.png'></a>
                            <a href='categoria.php?action=eliminar&id=" . $categoria['id'] . "' title='Eliminar Categoria' onclick='return confirmaR()'><img src='../img/icons/page_delete16.png'></a>                           
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
