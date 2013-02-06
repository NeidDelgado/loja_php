<?php

class ProdutoDAO extends Produto {
    /**
     * Retorna um Produto
     * 
     * @param integer $id     * 
     * @return Produto
     */
    public static function getProduto($id){
        $conexao = new ConexaoDAO();
        
        $sqlText = "SELECT * FROM produtos WHERE id = {$id}";
        $produ = $conexao->query($sqlText)->fetch();
        
        return $produ;
        
    }
    
    /**
     * Retorna todos os produtos
     * 
     * @return array
     */
    public static function getProdutos(){
        $conexao = new ConexaoDAO();
        
        $sqlText = "SELECT * FROM produtos";
        $resultado = $conexao->query($sqlText)->fetchAll();
        
        
        return $resultado;
    }
    
    /**
     * 
     * @param Produtos $produto
     */
    public static function saveProduto(Produto $produto){
        $conexao = new ConexaoDAO();
        
        $sqlText = "INSERT INTO produtos (codigo_barra, titulo, descricao, preco_venda, preco_custo, existencias, url_imagem, data_criacao, data_actualizacao)
        VALUES (:codigo_barra, :titulo, :descricao, :preco_venda, :preco_custo, :existencias, :url_imagem, :data_criacao, :data_actualizacao)";
        $cadastrar = $conexao->prepare($sqlText);
        $cadastrar->bindValue(':codigo_barra', $produto->getCodigoBarra ());
        $cadastrar->bindValue(':titulo', $produto->getTitulo());
        $cadastrar->bindValue(':descricao', $produto->getDescricao());
        $cadastrar->bindValue(':preco_venda', $produto->getPrecoVenda());
        $cadastrar->bindValue(':preco_custo', $produto->getPrecoCusto());
        $cadastrar->bindValue(':existencias', $produto->getExistencias());
        $cadastrar->bindValue(':url_imagem', $produto->getUrlImagem());
        $cadastrar->bindValue(':data_criacao',$produto->getDataCriacao());
        $cadastrar->bindValue(':data_actualizacao',$produto->getDataActualizacao());
      
        $resultado = $cadastrar->execute();
       
        return $resultado;
    }
    
    public static function deleteProduto($id){
        $conexao = new ConexaoDAO();
         
            $produ = self::getProduto($id);
            $img = PASTA_IMG_PRODUTOS . $produ['url_imagem'];            
           
            $sqlText = "DELETE FROM produtos WHERE id = :id";
            $exec = $conexao->prepare($sqlText);
            $exec->bindValue(":id", $id);
            
            $resultado = $exec->execute();
            if ($resultado){
                if ($produ['url_imagem'] != "sem_imagem.png"){
                    unlink($img);
                }
                return $resultado;
            }
       
        return false;
    }   
    
    public static function editarProduto(Produto $produto){
        $conexao = new ConexaoDAO();
        
        $sqlText ="UPDATE produtos SET codigo_barra=:codigo_barra, titulo=:titulo, descricao=:descricao, preco_venda=:preco_venda, preco_custo=:preco_custo, existencias=:existencias, url_imagem=:url_imagem, data_criacao=:data_criacao, data_actualizacao=:data_actualizacao WHERE id = :id";
        
        $exec = $conexao->prepare($sqlText);
        $exec->bindValue(':codigo_barra', $produto->getCodigoBarra ());
        $exec->bindValue(':titulo', $produto->getTitulo());
        $exec->bindValue(':descricao', $produto->getDescricao());
        $exec->bindValue(':preco_venda', $produto->getPrecoVenda());
        $exec->bindValue(':preco_custo', $produto->getPrecoCusto());
        $exec->bindValue(':existencias', $produto->getExistencias());
        $exec->bindValue(':url_imagem', $produto->getUrlImagem());
        $exec->bindValue(':data_criacao',$produto->getDataCriacao());
        $exec->bindValue(':data_actualizacao',$produto->getDataActualizacao());
        $exec->bindValue(':id',$produto->getId());
        
        $resultado = $exec->execute();
        
        return $resultado;
    }
    
}