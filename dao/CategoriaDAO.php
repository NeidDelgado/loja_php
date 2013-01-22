<?php

class CategoriaDAO extends Categoria {
    
    public static function getCategoria($id){
        
    }
    
    public static function getCategorias(){
        $conexao = new ConexaoDAO();
        
        $sqlText = "SELECT * FROM categorias";
        $resultado = $conexao->query($sqlText)->fetchAll();
        
        
        return $resultado;
    }
    
    /**
     * 
     * @param Categoria $categoria
     */
    public static function saveCategoria(Categoria $categoria){
        $conexao = new ConexaoDAO();
        
        $sqlText = "INSERT INTO categorias (nome, descricao, categoria_id, url_imagem, data_criacao, data_alteracao) VALUES (:nome, :descricao, :categoria_id, :url_imagem, :data_criacao, :data_alteracao)";
        $exec = $conexao->prepare($sqlText);
        $exec->bindValue(':nome', $categoria->getNome());
        $exec->bindValue(':descricao', $categoria->getDescricao());
        $exec->bindValue(':categoria_id', $categoria->getCategoriaId());
        $exec->bindValue(':url_imagem', $categoria->getUrlImagem());
        $exec->bindValue(':data_criacao', $categoria->getDataCriacao());
        $exec->bindValue(':data_alteracao', $categoria->getDataAlteracao());
        
        $resultado = $exec->execute();
        
        return $resultado;
    }
    
    public static function deleteCategoria($id){
        $conexao = new ConexaoDAO();
      
         // selecionar todas os produtos 
        $sql2 ="SELECT *FROM produtos WHERE id =:id";
        $resulta = $conexao->query($sql2)->fetchAll();
        return $resulta;  
        
           header("Location: index.php?login=false");
            die();
        
        $sqlText = "DELETE FROM categorias WHERE id = :id";
        
        $exec = $conexao->prepare($sqlText);
        $exec->bindValue(':id', $id);
        
        $resultado = $exec->execute();
        return $resultado;
    }
    
    
    public static function editarCategoria(Categoria $categoria){
        $conexao = new ConexaoDAO();
        
        $sqlText ="UPDATE categorias SET nome=:nome, descricao=:descricao,  categoria_id=:categoria_id, url_imagem=:url_imagem, data_alteracao=:data_alteracao WHERE id = '{$id}'";
        $exec = $conexao->prepare($sqlText);
        $exec->bindValue(':nome', $categoria->getNome());
        $exec->bindValue(':descricao', $categoria->getDescricao());
        $exec->bindValue(':categoria_id', $categoria->getCategoriaId());
        $exec->bindValue(':url_imagem', $categoria->getUrlImagem());
        $exec->bindValue(':data_alteracao', $categoria->getDataAlteracao());
        
        $resultado = $exec->execute();
        
        return $resultado;
    }
    
}