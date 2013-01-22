<?php
    require_once '../init.php';
    
    if (!$isLogged){
        header("Location: login.php");
    }
    
    require_once 'header.php';
?>

<div class="content">
    Conteúdo
</div>

<?php
    require_once 'footer.php';
?>