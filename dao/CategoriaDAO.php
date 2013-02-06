<?php

class CategoriaDAO extends Categoria {
    /**
     * Retorna uma categoria
     * 
     * @param integer $id     * 
     * @return Categoria
     */
    public static function getCategoria($id){
        $conexao = new ConexaoDAO();
        
        $sqlText = "SELECT * FROM categorias WHERE id = {$id}";
        $cat = $conexao->query($sqlText)->fetch(PDO::FETCH_OBJ);
        
        return $cat;
        
    }
    /**
     * Retorna todas as categorias
     * 
     * @return array
     */
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
        
        $sqlText = "INSERT INTO categorias (nome, descricao, categoria_id, url_imagem, data_criacao, data_alteracao) 
            VALUES (:nome, :descricao, :categoria_id, :url_imagem, :data_criacao, :data_alteracao)";
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
        
        // Verificar se não existe produtos na categoria em questão
        $sqlText = "SELECT * FROM produtos WHERE id_categoria = {$id}";
        $cat = $conexao->query($sqlText)->fetchAll();
        if (empty($cat)){   
            $cat = self::getCategoria($id);
            $img = PASTA_IMG_CATEGORIA . $cat['url_imagem'];            
           
            $sqlText = "DELETE FROM categorias WHERE id = :id";
            $exec = $conexao->prepare($sqlText);
            $exec->bindValue(":id", $id);
            
            $resultado = $exec->execute();
            if ($resultado){
                if ($cat['url_imagem'] != "sem_imagem.png"){
                    unlink($img);
                }
                return $resultado;
            }
        }
        
        return false;

    }
    
    /**
     * Editar Categoria
     * 
     * @param Categoria $categoria Categoria a ser editada
     * @return bool
     */
    public static function editarCategoria(Categoria $categoria){
        $conexao = new ConexaoDAO();
        
        $sqlText ="UPDATE categorias SET nome=:nome, descricao=:descricao,  categoria_id=:categoria_id, url_imagem=:url_imagem, data_alteracao=:data_alteracao WHERE id = :id";
        $exec = $conexao->prepare($sqlText);
        $exec->bindValue(':nome', $categoria->getNome());
        $exec->bindValue(':descricao', $categoria->getDescricao());
        $exec->bindValue(':categoria_id', $categoria->getCategoriaId());
        $exec->bindValue(':url_imagem', $categoria->getUrlImagem());
        $exec->bindValue(':data_alteracao', $categoria->getDataAlteracao());
        $exec->bindValue(':id', $categoria->getId());
        
        $resultado = $exec->execute();
        
        return $resultado;
    }
    
}